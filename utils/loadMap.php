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
	
	$villageCarte = new villageDao();
	
	$x = strip_tags(trim($_POST["x"]));
	$y = strip_tags(trim($_POST["y"]));
		
	$xMin = $x - 5;
	$xMax = $x + 5;
	$yMin = $y - 5;
	$yMax = $y + 5;

	$carteDonnees = $bdd->query('SELECT * FROM carte WHERE x BETWEEN '. $xMin  .' AND '. $xMax  .' AND y BETWEEN '. $yMin  .' AND '. $yMax .' order by y ASC');
	
	$carte = "<table cellspacing='0' id='tableCarte'>";
	
	for($yHtml = 0; $yHtml < 11; $yHtml++)
	{
		$carte .= "<tr>";
		for($xHtml = 0; $xHtml < 11; $xHtml++)
		{
			$onClick = "";
			$donnees = $carteDonnees->fetch();
	
			
			
			if($donnees["type"] == "plaine")		
				$img = "template/".$TEMPLATE."/images/carte/plaine.png";
			if($donnees["type"] == "montagne")		
				$img = "template/".$TEMPLATE."/images/carte/moutain.png";
			if($donnees["type"] == "foret")		
				$img = "template/".$TEMPLATE."/images/carte/forest.png";
			if($donnees["type"] == "village")	
				$img = "template/".$TEMPLATE."/images/carte/village.png";
												
			if($donnees["type"] == "village")
			{
				$village = $villageCarte->getVillageById($donnees["villageId"]);
				$onClick = "onclick='afficherVillage(". $village->getJoueurId() .",". $village->getVillageId() .",\"".$village->getNom()."\");'";
				$titre = $village->getNom() . " x: " . $donnees["x"] . " y: " . $donnees["y"];
			}
			else
			{
				$titre = $donnees["type"] . " x: " . $donnees["x"] . " y: " . $donnees["y"];
			}
			
			$carte .= "<td ". $onClick ." style='background-image:url(". $img ."); -webkit-background-size: cover; background-size: cover;' title='". $titre ."' id='tooltip'></td>";
		}
		$carte .= "</tr>";
	}	
	$carte .= "</table>";
	
	echo $carte;

?>