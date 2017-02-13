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
		global $bdd;
		
		$village = unserialize($_SESSION["village"]);
		$reponse = $bdd->query('SELECT * from village where villageId ='.$village->getVillageId());
		$donnees = $reponse->fetch();
		
		$tpsEcoule = time() - $donnees["dernMaj"];
		
		$boisTot = $village->getBois() + ($tpsEcoule * 1);
		$pierreTot = $village->getPierre() + ($tpsEcoule * 2);
		$metalTot = $village->getMetal() + ($tpsEcoule * 3);
		
		$village->setBois($boisTot);
		$village->setPierre($pierreTot);
		$village->setMetal($metalTot);
		
		$_SESSION["village"] = serialize($village);
		
		$bdd->query('UPDATE village set bois='.$boisTot.', pierre='.$pierreTot.', metal='.$metalTot.', dernMaj='. time() .' where villageId='.$village->getVillageId());
	}
}


?>