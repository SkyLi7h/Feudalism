<?php
	//Fichier de configuration
	$NAME_APPLICATION = "Last imperium"; //Nom du site
	$VERSION = "A0.1"; //Version du projet
	$TEMPLATE = "testTemplate"; //Nom du template utilisé
	$MOD_START = "accueil"; //Module afficher à l'arrivée
	$DEBUG = false; //DEBUG MODE
	$TPSMAXCO = 10; //5 minutes
	$VITESSE = 1;
	$MAINTENANCE = false;
	
	//Base de données
	$DB_ACCESS = "MYSQL"; //Type d'accès aux données
	$HOST = "localhost";
	$DBNAME = "apmqlasti808566_lastimperium";
	$LOGIN = "apmqlasti808566_lastimperium";
	$PASS = "19Nino552886!!";
	
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
	
	
		//Scierie
		$TABCOUTSCIERIE = [];
			$TABCOUTSCIERIE["multiplicateur"] = 1.9;
			$TABCOUTSCIERIE["bois"] = 50;
			$TABCOUTSCIERIE["pierre"] = 120;
			$TABCOUTSCIERIE["metal"] = 90;
			$TABCOUTSCIERIE["temps"] = 90/$VITESSE;
		//Carriere
		$TABCOUTCARRIERE = [];
			$TABCOUTCARRIERE["multiplicateur"] = 1.9;
			$TABCOUTCARRIERE["bois"] = 90;
			$TABCOUTCARRIERE["pierre"] = 50;
			$TABCOUTCARRIERE["metal"] = 120;		
			$TABCOUTCARRIERE["temps"] = 90/$VITESSE;		
		//Mine
		$TABCOUTCARRIERE = [];
			$TABCOUTMINE["multiplicateur"] = 1.9;
			$TABCOUTMINE["bois"] = 120;
			$TABCOUTMINE["pierre"] = 90;
			$TABCOUTMINE["metal"] = 50;
			$TABCOUTMINE["temps"] = 90/$VITESSE;
		
	
	
?>
