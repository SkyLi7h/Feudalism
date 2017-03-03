<?php
	session_start();
	if (! @include_once("../config.php")) 
		throw new Exception ("config.php est introuvable !");
	
	if($DB_ACCESS == "MYSQL")
	{
		if (! @include_once("../dao/bddAccess.php")) 
			throw new Exception ("dao/bddAccess.php est introuvable !");
		
		$bddAccess = new bdd();
		$bdd = $bddAccess->connexion($HOST, $DBNAME, $LOGIN, $PASS);
	}
	
	require_once "../dao/joueurDao.php";	
	require_once "../dao/villageDao.php";
	require_once "../entity/joueur.php";
	require_once "../entity/village.php";
	require_once "../utils/utilsInGame.php";
	
	//Maj Ressource
	$utilsinGame = new utilsInGame();
	$utilsinGame->rechargementDonneesResBat();
	///
	
	$village = unserialize($_SESSION["village"]);
	$unite = $_POST["unite"];
	$nb = $_POST["nb"];
	
	$unitAConstruire = $UNITES[$unite];
	
	$coutBois = $unitAConstruire["cout"]["bois"] * $nb;
	$coutPierre = $unitAConstruire["cout"]["pierre"] * $nb;
	$coutMetal = $unitAConstruire["cout"]["metal"] * $nb;
	$temps = $unitAConstruire["cout"]["temps"] * $nb;

	if($village->getBois() >= $coutBois && $village->getPierre() >= $coutPierre && $village->getMetal() >= $coutMetal)
	{
		$village->setBois($village->getBois() - $coutBois);
		$village->setPierre($village->getPierre() - $coutPierre);
		$village->setMetal($village->getMetal() - $coutMetal);
					
		$villageDao = new villageDao();

	}
	else
	{
		echo 1;
	}

	


?>