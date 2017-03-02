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
	
	$pseudo = strip_tags(trim($_POST["pseudo"]));
	$mdp = strip_tags(trim($_POST["pass"]));
	
	$joueurDao = new joueurDao();
	$result = $joueurDao->connexion($pseudo, md5($mdp));
	
	if($result == null)
	{
		echo 1; //Pas bon
	}
	else
	{
		$villageDao = new villageDao();
		session_start();
		$_SESSION["joueur"] = serialize($result);//Mise en session du joueur
		$_SESSION["village"] = serialize($villageDao->getMinVillageConnexion($result->getJoueurId()));
		$_SESSION["mod"] = "index";//Page de retour après connexion
		$_SESSION["dernAction"] = time();//Mise en session du temps de la dernière action
		echo 0; //ok
	}


?>