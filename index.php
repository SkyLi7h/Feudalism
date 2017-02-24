<?php
	session_start();
	//Fenêtre principale de l'application. Appel du fichier de configuration et du template.
	//A NE PAS TOUCHER
	//session_destroy();
	
	//Appel du fichier de configuration
	if (! @include_once("config.php")) 
		throw new Exception ("config.php est introuvable !");
	
	//Classes toujours utiles en général
		///
		
		
	//Appel du fichier de debug si besoin
	if($DEBUG)
	{
		if (! @include_once("debug.php")) 
			throw new Exception ("business/debug.php est introuvable !");
		
		$debug = new debugAppli();
		$debug->show("Version $VERSION");
		$debug->show("$NAME_APPLICATION tourne avec le template $TEMPLATE et avec des transactions $DB_ACCESS");	
	}
	
	//Appel du fichier de base de données + connexion
	if($DB_ACCESS == "MYSQL")
	{
		if (! @include_once("dao/bddAccess.php")) 
			throw new Exception ("dao/bddAccess.php est introuvable !");
		
		$bddAccess = new bdd();
		$bdd = $bddAccess->connexion($HOST, $DBNAME, $LOGIN, $PASS);
	}
		
	//Si le joueur est connecté..
	if(isset($_SESSION["joueur"]))
	{	
		//Utils
		require_once "utils/utilsInGame.php";
		$utilsinGame = new utilsInGame();
		//Verif si pas timeout
		if($_SESSION["dernAction"] + $TPSMAXCO < time())
		{
			$utilsinGame->logout();
		}
		else
		{
			$_SESSION["dernAction"] = time();
		
			//Classes toujours utiles en jeu
			require_once "dao/joueurDao.php";
			require_once "dao/villageDao.php";
			require_once "entity/joueur.php";
			require_once "entity/village.php";
			
			$utilsinGame->rechargementDonneesResBat();
		}
		
		if(isset($_GET["mod"]))
		{		
			$_SESSION["mod"] = $_GET["mod"];	
		}				
	}
	else
	{
		$_SESSION["mod"] = $MOD_START;
	}
	
	
	//Appel du template utilisé
	if (! @include_once("template/$TEMPLATE/index.php")) 
			throw new Exception ("template/$TEMPLATE/index.php est introuvable !");

?>