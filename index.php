<?php
	//Fenêtre principale de l'application. Appel du fichier de configuration et du template.
	//A NE PAS TOUCHER
	
	session_start();
	
	//Classes toujours utiles en général
		///
		
	//Si le joueur est connecté..
	if(isset($_SESSION["idJoueur"]))
	{
		if($_SESSION["dernAction"] + $TPSMAXCO > time())
			
			//Classes toujours utiles en jeu
			require_once "dao/villageDao.php";
			require_once "utils/utilsInGame.php";
			
			//Mise en session du modèle utilisé		
			$_SESSION['mod'] = $_GET["mod"];	
	}
	else
	{
		//Mise en session du modèle utilisé
		if(isset($_GET["mod"]))
		{		
			$_SESSION['mod'] = $_GET["mod"];	
		}
		if(!isset($_SESSION['mod']))
		{
			$_SESSION['mod'] = $MOD_START;
		}
	}
	
	
	
	//Appel du fichier de configuration
	if (! @include_once("config.php")) 
		throw new Exception ("config.php est introuvable !");
	
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
		if (! @include_once("DAO/bddAccess.php")) 
			throw new Exception ("DAO/bddAccess.php est introuvable !");
		
		$bddAccess = new bdd();
		$bdd = $bddAccess->connexion($HOST, $DBNAME, $LOGIN, $PASS);
	}
	
	
	//Appel du template utilisé
	if (! @include_once("template/$TEMPLATE/index.php")) 
			throw new Exception ("template/$TEMPLATE/index.php est introuvable !");

?>