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
	
	$joueurDao = new joueurDao();
	$villageDao = new villageDao();
	
	if($joueurDao->isExist($_POST["pseudo"], $_POST["mail"]))
	{
		echo 1;
	}
	else
	{
		//A AMELIORER POUR LES VERIF + MD5		
		$joueurDao->inscription($_POST["pseudo"], $_POST["pass"], $_POST["mail"]);
		$idTiles = $villageDao->addVillage($bdd->lastInsertId(), $_POST["pseudo"]);
		return 0;
	}	


?>