<?php
	//Fichier de configuration
	$NAME_APPLICATION = "test"; //Nom du site
	$VERSION = "A0.1"; //Version du projet
	$TEMPLATE = "testTemplate"; //Nom du template utilisé
	$MOD_START = "accueil"; //Module afficher à l'arrivée
	$DEBUG = false; //DEBUG MODE
	$TPSMAXCO = 60 * 5; //5 minutes
	$VITESSE = 1;
	
	//Base de données
	$DB_ACCESS = "MYSQL"; //Type d'accès aux données
	$HOST = "localhost";
	$DBNAME = "feudalism";
	$LOGIN = "root";
	$PASS = "19Nino552886!";
	
	//Config ressources
	$MULTIPLICATEUR = 1.3;
		//Or
		$ORDEB = 1000;
		//Bois
		$BOISDEB = 500;
		$BOISGAINHEURE = 150 * $VITESSE;
		//Pierre
		$PIERREDEB = 500;
		$PIERREGAINHEURE = 150 * $VITESSE;
		//Metal
		$METALDEB = 500;
		$METALGAINHEURE = 150 * $VITESSE;
		
	//Config batiments
		//Scierie
		$TABCOUTSCIERIE = [];
			$TABCOUTSCIERIE["bois"] = 100;
			$TABCOUTSCIERIE["pierre"] = 100;
			$TABCOUTSCIERIE["metal"] = 100;
		//Carriere
		$TABCOUTCARRIERE = [];
			$TABCOUTCARRIERE["bois"] = 100;
			$TABCOUTCARRIERE["pierre"] = 100;
			$TABCOUTCARRIERE["metal"] = 100;		
		//Mine
		$TABCOUTCARRIERE = [];
			$TABCOUTMINE["bois"] = 100;
			$TABCOUTMINE["pierre"] = 100;
			$TABCOUTMINE["metal"] = 100;
		
	
	
?>
