<?php

class joueurDao
{
	public function getPseudoFirstJoueur()
	{
		global $bdd;
		
		$reponse = $bdd->query('SELECT * FROM joueur');
		$donnees = $reponse->fetch();	

		return $donnees["pseudo"];
	}
}


?>