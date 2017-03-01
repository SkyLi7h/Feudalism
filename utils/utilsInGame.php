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
		global $bdd, $BATIMENTS;
		
		$village = unserialize($_SESSION["village"]);
		
		//Recup donnée villages et maj si modif manuelle depuis panel ou bdd ou si add construction ( ressources retirées )
		$reponseVillage = $bdd->query('SELECT * from village where villageId ='.$village->getVillageId());
		$donneesVillage = $reponseVillage->fetch();
		
		$village->setScierie($donneesVillage["scierie"]);
		$village->setCarriere($donneesVillage["carriere"]);
		$village->setMine($donneesVillage["mine"]);
		
		$village->setBois($donneesVillage["bois"]);
		$village->setPierre($donneesVillage["pierre"]);
		$village->setMetal($donneesVillage["metal"]);
		
		$listBatEnConstr = [];
		
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
						break;
					case "Carriere":
						$village->upCarriere();
						break;
					case "Mine":
						$village->upMine();
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
		
		//Maj des ressources dans la session
		$boisTot = $village->getBois() + (($BATIMENTS["Scierie"]["gain"][$village->getScierie()]/3600)*$tpsEcoule);
		$pierreTot = $village->getPierre() + (($BATIMENTS["Carriere"]["gain"][$village->getCarriere()]/3600)*$tpsEcoule);
		$metalTot = $village->getMetal() + (($BATIMENTS["Mine"]["gain"][$village->getMine()]/3600)*$tpsEcoule);
		
		$village->setBois($boisTot);
		$village->setPierre($pierreTot);
		$village->setMetal($metalTot);
		
		//Mise en session du village modfié
		$_SESSION["village"] = serialize($village);
		
		//Maj du village dans la bdd
		$bdd->query('UPDATE village set bois='.$boisTot.', pierre='.$pierreTot.', metal='.$metalTot.', scierie='.$village->getScierie().', carriere='.$village->getCarriere().', mine='.$village->getMine().', chateau='.$village->getChateau().', caserne='.$village->getCaserne().', dernMaj='. time() .' where villageId='.$village->getVillageId());
		
		return $listBatEnConstr;
	}
}


?>