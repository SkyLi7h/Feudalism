<?php

class villageDao
{
	public function getVillageById($villageId)
	{
		global $bdd;
		
		$reponse = $bdd->query('SELECT * FROM village where villageId ='.$villageId);
		$donnees = $reponse->fetch();	
		return new village($donnees["villageId"], $donnees["joueurId"], $donnees["nom"], $donnees["habitant"], $donnees["x"], $donnees["y"], $donnees["chateau"], $donnees["caserne"], $donnees["mine"], $donnees["scierie"], $donnees["carriere"], $donnees["metal"], $donnees["bois"], $donnees["pierre"]);
	}
	
	public function getMinVillageConnexion($joueurId)
	{
		global $bdd;
		
		$reponse = $bdd->query('SELECT * from village where joueurId ='.$joueurId.' ORDER BY villageId ASC LIMIT 1');
		$donnees = $reponse->fetch();	
		return new village($donnees["villageId"], $donnees["joueurId"], $donnees["nom"], $donnees["habitant"], $donnees["x"], $donnees["y"], $donnees["chateau"], $donnees["caserne"], $donnees["mine"], $donnees["scierie"], $donnees["carriere"], $donnees["metal"], $donnees["bois"], $donnees["pierre"]);
	}
	
	public function addConstruction($villageId, $batiment, $tempsCons)
	{
		global $bdd;
		$bdd->query("INSERT INTO construction(batiment, temps, tempsDeb, villageId) VALUES('". $batiment ."', ". $tempsCons .", ". time() .", ". $villageId .")");
	}
	
	public function majRessourcesVillage($bois, $pierre, $metal, $villageId)
	{
		global $bdd;
		$bdd->query('UPDATE village set bois='.$bois.', pierre='.$pierre.', metal='.$metal.' where villageId='.$villageId);
	}
}


?>