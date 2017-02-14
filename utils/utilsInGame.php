<?php
class utilsInGame
{	
	//Deconnexion
	public function logout()
	{
		global $MOD_START;
		$_SESSION = array();
		$_SESSION["mod"] = $MOD_START;
	}	
	
	//Maj des ressources et batiments dans la bdd à chaque rechargement de page
	public function rechargementDonneesResBat()
	{
		global $bdd, $MULTIPLICATEUR, $BOISGAINHEURE, $PIERREGAINHEURE, $METALGAINHEURE;
		
		$village = unserialize($_SESSION["village"]);
		
		//Recup donnée villages et maj si modif manuelle depuis panel ou bdd
		$reponseVillage = $bdd->query('SELECT * from village where villageId ='.$village->getVillageId());
		$donneesVillage = $reponseVillage->fetch();
		
		/////A Enlever (peut-être) si prod car + de sécu/////////////////////////////
		$village->setScierie($donneesVillage["scierie"]);
		$village->setCarriere($donneesVillage["carriere"]);
		$village->setMine($donneesVillage["mine"]);
		
		$village->setBois($donneesVillage["bois"]);
		$village->setPierre($donneesVillage["pierre"]);
		$village->setMetal($donneesVillage["metal"]);
		//////////////////////////////////////////////////////////////////////////////
		
		
		//Recup données de construction
		$reponseConstruction = $bdd->query('SELECT * from construction where villageId ='.$village->getVillageId());
		while($donneesConstruction = $reponseConstruction->fetch())
		{
			if($donneesConstruction["tempsDeb"] + $donneesConstruction["temps"] <= time())
			{
				switch ($donneesConstruction["batiment"]) 
				{
					case "scierie":
						$village->upScierie();
						break;
					case "carriere":
						$village->upCarriere();
						break;
					case "mine":
						$village->upMine();
						break;					
				}
				
				$bdd->query('DELETE from construction where constructionId ='.$donneesConstruction["constructionId"]);
			}
			
			
		}
		
		//Tps ecoulé depuis la dernière maj des ressources en secondes
		$tpsEcoule = time() - $donneesVillage["dernMaj"];
		
		//Maj des ressources dans la session
		$boisTot = $village->getBois() + ((($BOISGAINHEURE*POW($MULTIPLICATEUR,$village->getScierie()))/3600)*$tpsEcoule);
		$pierreTot = $village->getPierre() + ((($PIERREGAINHEURE*POW($MULTIPLICATEUR,$village->getCarriere()))/3600)*$tpsEcoule);
		$metalTot = $village->getMetal() + ((($METALGAINHEURE*POW($MULTIPLICATEUR,$village->getMine()))/3600)*$tpsEcoule);
		
		$village->setBois($boisTot);
		$village->setPierre($pierreTot);
		$village->setMetal($metalTot);
		
		//Mise en session du village modfié
		$_SESSION["village"] = serialize($village);
		
		//Maj du village dans la bdd
		$bdd->query('UPDATE village set bois='.$boisTot.', pierre='.$pierreTot.', metal='.$metalTot.', scierie='.$village->getScierie().', carriere='.$village->getCarriere().', mine='.$village->getMine().', dernMaj='. time() .' where villageId='.$village->getVillageId());
	}
}


?>