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
	
	$pseudo = strip_tags(trim($_POST["pseudo"]));
	$mdp = strip_tags(trim($_POST["pass"]));
	$mdpConf = strip_tags(trim($_POST["passConf"]));
	$mail =  strip_tags(trim($_POST["mail"]));
	
	if($mdp != $mdpConf)
	{
		echo 2;
	}
	else if($joueurDao->isExist($pseudo, $mail))
	{
		echo 1;
	}
	else
	{
		//A AMELIORER POUR LES VERIF + MD5		
		$joueurDao->inscription($pseudo, $mdp, $mail);
		$idTiles = $villageDao->addVillage($bdd->lastInsertId(), $pseudo);
		echo 0;
	}	


?>