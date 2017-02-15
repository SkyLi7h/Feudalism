<?php
	if (! @include_once("../config.php")) 
		throw new Exception ("config.php est introuvable !");
	
	if($DB_ACCESS == "MYSQL")
	{
		if (! @include_once("../DAO/bddAccess.php")) 
			throw new Exception ("DAO/bddAccess.php est introuvable !");
		
		$bddAccess = new bdd();
		$bdd = $bddAccess->connexion($HOST, $DBNAME, $LOGIN, $PASS);
	}
	
	require_once "../dao/joueurDao.php";	
	require_once "../dao/villageDao.php";
	require_once "../entity/joueur.php";
	require_once "../entity/village.php";
	require_once "../utils/utilsInGame.php";
	
	session_start();
	
	//Maj Ressource
	$utilsinGame = new utilsInGame();
	$utilsinGame->rechargementDonneesResBat();
	///
	
	$village = unserialize($_SESSION["village"]);
	$batiment = $_POST["bat"];
	
	
	
	switch($batiment)
	{
		case "scierie":
			$coutBois = $TABCOUTSCIERIE["bois"] * (pow($TABCOUTSCIERIE["multiplicateur"],$village->getScierie()-1));
			$coutPierre = $TABCOUTSCIERIE["pierre"] * (pow($TABCOUTSCIERIE["multiplicateur"],$village->getScierie()-1));
			$coutMetal = $TABCOUTSCIERIE["metal"] * (pow($TABCOUTSCIERIE["multiplicateur"],$village->getScierie()-1));
			$temps = $TABCOUTSCIERIE["temps"] * (pow($TABCOUTSCIERIE["multiplicateur"],$village->getScierie()-1));		
			break;		
	}

	if($village->getBois() >= $coutBois && $village->getPierre() >= $coutPierre && $village->getMetal() >= $coutMetal)
	{
		$village->setBois($village->getBois() - $coutBois);
		$village->setPierre($village->getPierre() - $coutPierre);
		$village->setMetal($village->getMetal() - $coutMetal);
					
		$villageDao = new villageDao();
		echo $villageDao->majRessourcesVillage($village->getBois(), $village->getPierre(), $village->getMetal(), $village->getVillageId());
		echo $villageDao->addConstruction($village->getVillageId(), $batiment, $temps);

	}
	
	$villageDao = new villageDao();

	


?>