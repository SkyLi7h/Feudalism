<?php
	//Fichier de configuration
	$NAME_APPLICATION = "Last imperium"; //Nom du site
	$VERSION = "A0.1"; //Version du projet
	$TEMPLATE = "v1"; //Nom du template utilisé
	$MOD_START = "accueil"; //Module afficher à l'arrivée
	$DESCRIPTION = "Jeu de stratégie - role play multijoueur par navigateur";
	$AUTEUR = "FERRER LUCAS";
	$MOTSCLES = "jeu, jeux, navigateur, stratégie, role-play, mmorpg, gratuit, game, combat, guerre, alliance, humain, orc, elfe, multijoueur";
	$DEBUG = false; //DEBUG MODE
	$TPSMAXCO = 60*5; //5 minutes
	$VITESSE = 1;
	$MAINTENANCE = false;
	
	//Base de données
	$DB_ACCESS = "MYSQL"; //Type d'accès aux données
	$HOST = "localhost";
	$DBNAME = "lastimperium";
	$LOGIN = "root";
	$PASS = "";
	
	//Config ressources
	$MULTIPLICATEUR = 1.3;
		//Or
		$ORDEB = 0;
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
