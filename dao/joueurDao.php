<?php

class joueurDao
{
	public function connexion($pseudo, $mdp)
	{
		global $bdd;
		$reponse = $bdd->query('SELECT * FROM joueur where pseudo="'.$pseudo.'"');
		$donnees = $reponse->fetch();
		
		if($donnees["pass"] != $mdp)
		{
			return 1;
		}
		
		return new joueur($donnees["joueurId"], $donnees["mail"], $donnees["pseudo"], $donnees["pass"], $donnees["or"]);	
	}	
	
	public function getPseudoFirstJoueur()
	{
		global $bdd;
		
		$reponse = $bdd->query('SELECT * FROM joueur');
		$donnees = $reponse->fetch();	

		return $donnees["pseudo"];
	}
	
	public function getJoueur($id)
	{
		global $bdd;
		
		$reponse = $bdd->query('SELECT * FROM joueur');
		$donnees = $reponse->fetch();	

		return $donnees["pseudo"];
	}
}


?>