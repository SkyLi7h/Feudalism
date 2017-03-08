<?php
class utilsInGame
{	
	//Deconnexion
	public function logout()
	{
		global $MOD_START;
		session_unset();
		session_destroy();
		$_SESSION["mod"] = $MOD_START;
	}	
	
	//Maj des ressources et batiments dans la bdd à chaque rechargement de page
	public function rechargementDonneesResBat()
	{
		global $bdd, $BATIMENTS, $UNITES, $listBatEnConstr, $listUnitEnRecrut;
		
		$listBatEnConstr = [];
		$listUnitEnRecrut = [];
		
		$village = unserialize($_SESSION["village"]);
		
		//Recup donnée villages et maj si modif manuelle depuis panel ou bdd ou si add construction ( ressources retirées )
		$reponseVillage = $bdd->query('SELECT * from village where villageId ='.$village->getVillageId());
		$donneesVillage = $reponseVillage->fetch();
		
		$village->setScierie($donneesVillage["scierie"]);
		$village->setCarriere($donneesVillage["carriere"]);
		$village->setMine($donneesVillage["mine"]);
		$village->setChateau($donneesVillage["chateau"]);
		$village->setCaserne($donneesVillage["caserne"]);
		
		$village->setBois($donneesVillage["bois"]);
		$village->setPierre($donneesVillage["pierre"]);
		$village->setMetal($donneesVillage["metal"]);
		
		$village->setPaysans($donneesVillage["paysans"]);
		$village->setLancePierre($donneesVillage["lancePierre"]);
		
		$tpsADecompterBois = 0;
		$tpsADecompterPierre = 0;
		$tpsADecompterMine = 0;
		$batTerminé = null;
		
		//Recup données de construction
		$reponseConstruction = $bdd->query('SELECT * from construction where villageId ='.$village->getVillageId());
		while($donneesConstruction = $reponseConstruction->fetch())
		{
			if($donneesConstruction["tempsDeb"] + $donneesConstruction["temps"] <= time())
			{
				switch ($donneesConstruction["batiment"]) 
				{
					case "Scierie":
						$village->upScierie();
						$gainBoisEnPlus = (($BATIMENTS["Scierie"]["gain"][$village->getScierie()]/3600)*(time() - ($donneesConstruction["tempsDeb"] + $donneesConstruction["temps"])));
						$tpsADecompterBois = time() - ($donneesConstruction["tempsDeb"] + $donneesConstruction["temps"]);
						break;
					case "Carriere":
						$village->upCarriere();
						$gainPierreEnPlus = (($BATIMENTS["Carriere"]["gain"][$village->getCarriere()]/3600)*(time() - ($donneesConstruction["tempsDeb"] + $donneesConstruction["temps"])));
						$tpsADecompterPierre = time() - ($donneesConstruction["tempsDeb"] + $donneesConstruction["temps"]);
						break;
					case "Mine":
						$village->upMine();
						$gainMetalEnPlus = (($BATIMENTS["Mine"]["gain"][$village->getMine()]/3600)*(time() - ($donneesConstruction["tempsDeb"] + $donneesConstruction["temps"])));
						$tpsADecompterMine = time() - ($donneesConstruction["tempsDeb"] + $donneesConstruction["temps"]);
						break;	
					case "Château":
						$village->upChateau();
						break;	
					case "Caserne":
						$village->upCaserne();
						break;	
				}
				
				$bdd->query('DELETE from construction where constructionId ='.$donneesConstruction["constructionId"]);
			}
			else
			{
				array_push($listBatEnConstr, $donneesConstruction);
			}
			
			
		}
		
		//Tps ecoulé depuis la dernière maj des ressources en secondes
		$tpsEcoule = time() - $donneesVillage["dernMaj"];
		if($tpsADecompterBois != 0)
		{
			$tpsEcoule -= $tpsADecompterBois;
			$boisTot = $village->getBois() + (($BATIMENTS["Scierie"]["gain"][$village->getScierie()-1]/3600)*$tpsEcoule);
			$boisTot += $gainBoisEnPlus;
		}
		else
		{
			$boisTot = $village->getBois() + (($BATIMENTS["Scierie"]["gain"][$village->getScierie()]/3600)*$tpsEcoule);
		}
		
		if($tpsADecompterPierre != 0)
		{
			$tpsEcoule -= $tpsADecompterPierre;
			$pierreTot = $village->getPierre() + (($BATIMENTS["Carriere"]["gain"][$village->getCarriere()-1]/3600)*$tpsEcoule);
			$pierreTot += $gainPierreEnPlus;
		}
		else
		{
			$pierreTot = $village->getPierre() + (($BATIMENTS["Carriere"]["gain"][$village->getCarriere()]/3600)*$tpsEcoule);
		}
		
		if($tpsADecompterMine != 0)
		{
			$tpsEcoule -= $tpsADecompterMine;
			$metalTot = $village->getMetal() + (($BATIMENTS["Mine"]["gain"][$village->getMine()-1]/3600)*$tpsEcoule);
			$metalTot += $gainMetalEnPlus;
		}
		else
		{
			$metalTot = $village->getMetal() + (($BATIMENTS["Mine"]["gain"][$village->getMine()]/3600)*$tpsEcoule);
		}
		
		$village->setBois($boisTot);
		$village->setPierre($pierreTot);
		$village->setMetal($metalTot);
		
		
		// Recup données de recrutement
		$reponseRecrutement = $bdd->query('SELECT * from recrutement where villageId ='.$village->getVillageId());
		while($donneesRecrutement = $reponseRecrutement->fetch())
		{
			$termineA = (($donneesRecrutement["nbUnite"] * $UNITES[$donneesRecrutement["unite"]]["cout"]["temps"]) + $donneesRecrutement["tpsDeb"]);
			
			if($termineA <= time())
			{
				switch ($donneesRecrutement["unite"]) 
				{
					case "Paysans":
						$village->addPaysans($donneesRecrutement["nbUnite"]);						
						break;
					case "Lance-pierre":
						$village->addLancePierre($donneesRecrutement["nbUnite"]);		
						break;					
				}
				
				$bdd->query('DELETE from recrutement where idRecrutement ='.$donneesRecrutement["idRecrutement"]);
			}
			else
			{			
				array_push($listUnitEnRecrut, $donneesRecrutement);
			}
		}
		
		//Mise en session du village modfié
		$_SESSION["village"] = serialize($village);
		
		//Maj du village dans la bdd
		$bdd->query('UPDATE village set bois='.$boisTot.', pierre='.$pierreTot.', metal='.$metalTot.', scierie='.$village->getScierie().', carriere='.$village->getCarriere().', mine='.$village->getMine().', chateau='.$village->getChateau().', caserne='.$village->getCaserne().', paysans='.$village->getPaysans().', lancePierre='.$village->getLancePierre().', dernMaj='. time() .' where villageId='.$village->getVillageId());
		
	}
}


?>