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
	
	$x = strip_tags(trim($_GET["x"]));
	$y = strip_tags(trim($_GET["y"]));
	
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

		$reponse = $bdd->query('SELECT * FROM carte WHERE x BETWEEN '. $xMin  .' AND '. $xMax  .' AND y BETWEEN '. $yMin  .' AND '. $yMax);


?>