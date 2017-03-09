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
	
	if($pseudo == "" || strlen($pseudo) < 5 || strlen($pseudo) > 20)
	{
		echo 3;
	}
	else if($mdp == "" || strlen($mdp) < 5 || strlen($mdp) > 20)
	{
		echo 4;
	}
	else if($mdp != $mdpConf)
	{
		echo 2;
	}
	else if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
	{
		echo 5;
	}
	else if($joueurDao->isExist($pseudo, $mail))
	{
		echo 1;
	}
	else
	{		
		$joueurDao->inscription($pseudo, md5($mdp), $mail);
		$idTiles = $villageDao->addVillage($bdd->lastInsertId(), $pseudo);
		echo 0;
	}	


?>