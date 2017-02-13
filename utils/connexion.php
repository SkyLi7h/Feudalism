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
	require_once "../entity/joueur.php";
	
	$joueurDao = new joueurDao();
	$joueur = $joueurDao->connexion($_POST["pseudo"], $_POST["pass"]);
	echo $joueur->getEmail();


?>