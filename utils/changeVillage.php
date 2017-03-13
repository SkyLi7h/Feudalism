<?php
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
	
	$villageId = strip_tags(trim($_POST["villageId"]));
	
	$villageDao = new villageDao();
	$result = $villageDao->getVillageById($villageId);
	
	session_start();
	
	$village = unserialize($_SESSION["village"]); 
	$joueur = unserialize($_SESSION["joueur"]);
	
	if($result == null || $result->getJoueurId() != $joueur->getJoueurId())
	{
		echo 1; //Pas bon
	}
	else
	{
		$_SESSION["village"] = serialize($result);//Mise en session du joueur
		$_SESSION["mod"] = "index";//Page de retour après connexion
		$_SESSION["dernAction"] = time();//Mise en session du temps de la dernière action
		echo 0; //ok
	}


?>