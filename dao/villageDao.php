<?php

class villageDao
{
	public function getVillageById($villageId)
	{
		global $bdd;
		
		$reponse = $bdd->query('SELECT * FROM village where villageId ='.$villageId);
		$donnees = $reponse->fetch();	
		return new village($donnees["villageId"], $donnees["joueurId"], $donnees["nom"], $donnees["habitant"], $donnees["chateau"], $donnees["caserne"], $donnees["mine"], $donnees["scierie"], $donnees["carriere"], $donnees["metal"], $donnees["bois"], $donnees["pierre"], $donnees["paysans"], $donnees["lancePierre"], $donnees["guerrier"], $donnees["archer"], $donnees["hache"], $donnees["piquier"], $donnees["hommeDeMain"], $donnees["chevalier"], $donnees["catapulte"]);
	}
	
	public function getMinVillageConnexion($joueurId)
	{
		global $bdd;
		
		$reponse = $bdd->query('SELECT * from village where joueurId ='.$joueurId.' ORDER BY villageId ASC LIMIT 1');
		$donnees = $reponse->fetch();	
		return new village($donnees["villageId"], $donnees["joueurId"], $donnees["nom"], $donnees["habitant"], $donnees["chateau"], $donnees["caserne"], $donnees["mine"], $donnees["scierie"], $donnees["carriere"], $donnees["metal"], $donnees["bois"], $donnees["pierre"], $donnees["paysans"], $donnees["lancePierre"], $donnees["guerrier"], $donnees["archer"], $donnees["hache"], $donnees["piquier"], $donnees["hommeDeMain"], $donnees["chevalier"], $donnees["catapulte"]);
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
	
	public function addVillage($joueurId, $pseudo)
	{
		global $bdd;
		$reponse = $bdd->query('SELECT * FROM carte where type = "plaine" and villageId IS NULL ORDER BY RAND() LIMIT 1 ');
		$donnees = $reponse->fetch();
		
		$idTilles = $donnees["carteId"];
		$nomVillage = "Village de " . $pseudo;
		$habitants = 100;
		$chateau = 1;
		$caserne = 0;
		$ferme = 1;
		$mine = 1;
		$scierie = 1;
		$carriere = 1;
		$metal = 500;
		$bois = 500;
		$pierre = 500;
		
		$bdd->query("INSERT INTO village(joueurId, nom, habitant, chateau, caserne, ferme, mine, scierie, carriere, metal, bois, pierre, dernMaj) VALUES(". $joueurId .", '". $nomVillage ."', ". $habitants .", ". $chateau .", ". $caserne .", ". $ferme .", ". $mine .", ". $scierie .", ". $carriere .", ". $metal .", ". $bois .", ". $pierre .", ". time() .")");		
		$bdd->query('UPDATE carte set villageId='.$bdd->lastInsertId().', type="village" where carteId='.$idTilles);
		

		
	}
	
	public function addRecrutement($villageId, $unite, $nb)
	{
		global $bdd, $UNITES;
		$bdd->query("INSERT INTO recrutement(unite, nbUnite, tpsDeb, villageId) VALUES('". $unite ."', ". $nb .", ". time() .", ". $villageId .")");
	}
}


?>