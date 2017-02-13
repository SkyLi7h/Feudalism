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
	
	$joueurDao = new joueurDao();
	$result = $joueurDao->connexion($_POST["pseudo"], $_POST["pass"]);
	
	if($result == null)
	{
		echo "Mauvais pseudo ou mot de passe"; //Pas bon
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