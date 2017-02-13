<?php

require_once "entity/village.php";

class villageDao
{
	public function getVillageById($id)
	{
		global $bdd;
		
		$reponse = $bdd->query('SELECT * FROM village where villageId ='.$id);
		$donnees = $reponse->fetch();	
		return new village($donnees["villageId"], $donnees["joueurId"], $donnees["nom"], $donnees["habitant"], $donnees["x"], $donnees["y"], $donnees["chateau"], $donnees["caserne"], $donnees["ferme"], $donnees["mine"], $donnees["scierie"], $donnees["carriere"], $donnees["bois"], $donnees["pierre"]);
	}
}


?>