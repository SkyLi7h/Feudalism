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
	
	$x = strip_tags(trim($_POST["x"]));
	$y = strip_tags(trim($_POST["y"]));
		
	$xMin = $x - 5;
	$xMax = $x + 6;
	$yMin = $y - 5;
	$yMax = $y + 6;
		
	if($xMin < 1)
	{
		$xMin = 1;
		$xMax = 11;
	}
	
	if($yMin < 1)
	{
		$yMin = 1;
		$yMax = 11;
	}
		
	if($xMax > $CARTEX)
	{
		$xMax = $CARTEX;
		$xMin = $CARTEX - 11;
	}
	
	if($yMax > $CARTEY)
	{
		$yMax = $CARTEY;
		$yMin = $CARTEY - 11;
	}

	$carteDonnees = $bdd->query('SELECT * FROM carte WHERE x BETWEEN '. $xMin  .' AND '. $xMax  .' AND y BETWEEN '. $yMin  .' AND '. $yMax);
	
	$minX =99999;
	$minY =99999;
	$maxX = 0;
	$maxY = 0;
	
	$carte = [];
	
	$villageCarte = new villageDao();
	
	while($donnees = $carteDonnees->fetch())
	{
		if($donnees["y"] < $minY)
		{
			$minY = $donnees["y"];
		}
		if($donnees["x"] < $minX)
		{
			$minX = $donnees["x"];
		}
		
		if($donnees["y"] > $maxY)
		{
			$maxY = $donnees["y"];
		}
		if($donnees["x"] > $maxX)
		{
			$maxX = $donnees["x"];
		}
		
		if(!isset($carte[$donnees["y"]]))
			$carte[$donnees["y"]] = [];
				
		$carte[$donnees["y"]][$donnees["x"]] = [];
		
		$carte[$donnees["y"]][$donnees["x"]]["type"] = $donnees["type"];
		
		if($donnees["type"] == "village")
			{
				$village = $villageCarte->getVillageById($donnees["villageId"]);
				$carte[$donnees["y"]][$donnees["x"]]["id"] = $donnees["villageId"];
				$carte[$donnees["y"]][$donnees["x"]]["nom"] = $village->getNom();
			}
		else
			{
				$carte[$donnees["y"]][$donnees["x"]]["nom"] = $donnees["type"];
			}
	}
	
	echo json_encode($carte);

?>