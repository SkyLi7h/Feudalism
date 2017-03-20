<?php
	session_start();
	if (! @include_once("../config.php")) 
		throw new Exception ("config.php est introuvable !");
	
	if($DB_ACCESS == "MYSQL")
	{
		if (! @include_once("../dao/bddAccess.php")) 
			throw new Exception ("dao/bddAccess.php est introuvable !");
		
		$bddAccess = new bdd();
		$bdd = $bddAccess->connexion($HOST, $DBNAME, $LOGIN, $PASS);
	}
	
	require_once "../entity/joueur.php";
	require_once "../entity/village.php";
	
	$village = unserialize($_SESSION["village"]);
	
	$paysans = $_POST["paysans"];
	$lancePierre = $_POST["lancePierre"];
	$guerrier = $_POST["guerrier"];
	$archer = $_POST["archer"];
	$hache = $_POST["hache"];
	$piquier = $_POST["piquier"];
	$hommeDeMain = $_POST["hommeDeMain"];
	$chevalier = $_POST["chevalier"];
	$catapulte = $_POST["catapulte"];
	$villageDestId = $_POST["villageDestId"];
	
	if($paysans > $village->getPaysans())
	{
		echo "paysans";
	}
	else if($lancePierre > $village->getLancePierre())
	{
		echo "lancePierre";
	}
	else if($guerrier > $village->getGuerrier())
	{
		echo "guerrier";
	}
	else if($archer > $village->getArcher())
	{
		echo "archer";
	}
	else if($hache > $village->getHache())
	{
		echo "hache";
	}
	else if($piquier > $village->getPiquier())
	{
		echo "piquier";
	}
	else if($hommeDeMain > $village->getHommeDeMain())
	{
		echo "homme de main";
	}
	else if($chevalier > $village->getChevalier())
	{
		echo "chevalier";
	}
	else if($catapulte > $village->getCatapulte())
	{
		echo "catapulte";
	}
	else
	{	
		$distance = calculDistance($village->getVillageId(), $villageDestId);
		$tempsArrive = time() + ($distance * $TEMPSDEPCASE);
		$bdd->query("INSERT INTO deplacement(type, idVillageOri, idVillageDest, tpsArrive, paysans, lancePierre, guerrier, archer, hache, piquier, hommeDeMain, chevalier, catapulte) VALUES('combat', ". $village->getVillageId() .", ". $villageDestId .", ". $tempsArrive .", ". $paysans .", ". $lancePierre .", ". $guerrier .", ". $archer .", ". $hache .", ". $piquier .", ". $hommeDeMain .", ". $chevalier .", ". $catapulte .")");
		$bdd->query('UPDATE village set paysans=paysans-'. $paysans.', lancePierre=lancePierre-'.$lancePierre.', guerrier=guerrier-'.$guerrier.', archer=archer-'.$archer.', hache=hache-'.$hache.', piquier=piquier-'.$piquier.', hommeDeMain=hommeDeMain-'.$hommeDeMain.', chevalier=chevalier-'.$chevalier.', catapulte=catapulte-'.$catapulte.' where villageId='.$village->getVillageId());
		echo 0;
	}
	
	
	function calculDistance($ori, $dest)
	{
		GLOBAL $bdd, $UNITES;
		$villageOri = $bdd->query('SELECT * FROM carte where villageId='.$ori);
		$villageOri = $villageOri->fetch();
		
		$villageDest = $bdd->query('SELECT * FROM carte where villageId='.$dest);
		$villageDest = $villageDest->fetch();
		
		$distX = $villageOri["x"] - $villageDest["x"];
		$distY = $villageOri["y"] - $villageDest["y"];

		$distance = sqrt( $distX*$distX + $distY*$distY );

		return $distance;
	}


?>