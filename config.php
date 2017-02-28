<?php
	//Fichier de configuration
	date_default_timezone_set('Europe/Paris');
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
	$DBNAME = "feudalism";
	$LOGIN = "root";
	$PASS = "19Nino552886!";
	
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
	
	
	//Bâtiments
		$BATIMENTS = [];
			$BATIMENTS["Scierie"] = [];
				$BATIMENTS["Scierie"]["nom"] = "Scierie";
				$BATIMENTS["Scierie"]["description"] = "Le bois, une ressource indispensable pour améliorer votre village !";
				$BATIMENTS["Scierie"]["img"] = "buildingTemp.png";
				$BATIMENTS["Scierie"]["multiplicateur"] = 1.9;
				$BATIMENTS["Scierie"]["bois"] = 50;
				$BATIMENTS["Scierie"]["pierre"] = 120;
				$BATIMENTS["Scierie"]["metal"] = 90;
				$BATIMENTS["Scierie"]["temps"] = 90/$VITESSE;
				$BATIMENTS["Scierie"]["prerequis"] = [];
			$BATIMENTS["Carriere"] = [];
				$BATIMENTS["Carriere"]["nom"] = "Carriere";
				$BATIMENTS["Carriere"]["description"] = "La pierre, une ressource indispensable pour améliorer votre village !";
				$BATIMENTS["Carriere"]["img"] = "buildingTemp.png";
				$BATIMENTS["Carriere"]["multiplicateur"] = 1.9;
				$BATIMENTS["Carriere"]["bois"] = 90;
				$BATIMENTS["Carriere"]["pierre"] = 50;
				$BATIMENTS["Carriere"]["metal"] = 120;
				$BATIMENTS["Carriere"]["temps"] = 90/$VITESSE;
				$BATIMENTS["Carriere"]["prerequis"] = [];
			$BATIMENTS["Mine"] = [];
				$BATIMENTS["Mine"]["nom"] = "Mine";
				$BATIMENTS["Mine"]["description"] = "Le métal, une ressource indispensable pour améliorer votre village et vos unités !";
				$BATIMENTS["Mine"]["img"] = "buildingTemp.png";
				$BATIMENTS["Mine"]["multiplicateur"] = 1.9;
				$BATIMENTS["Mine"]["bois"] = 120;
				$BATIMENTS["Mine"]["pierre"] = 90;
				$BATIMENTS["Mine"]["metal"] = 50;
				$BATIMENTS["Mine"]["temps"] = 90/$VITESSE;
				$BATIMENTS["Mine"]["prerequis"] = [];
		
	
	
?>
