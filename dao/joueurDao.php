<?php

class joueurDao
{
	public function connexion($pseudo, $mdp)
	{
		global $bdd;
		$reponse = $bdd->query('SELECT * FROM joueur where pseudo="'.$pseudo.'"');
		
		if($donnees = $reponse->fetch())
		{
			if($donnees["pass"] != $mdp)
			{
				return null; //Mdp incorrect
			}
			
			return new joueur($donnees["joueurId"], $donnees["mail"], $donnees["pseudo"], $donnees["pass"], $donnees["or"]); //Ok on retourne le joueur
		}
		else
		{
			return null; //Joueur introuvable
		}	
	}	
	
	public function getJoueur($id)
	{
		global $bdd;
		
		$reponse = $bdd->query('SELECT * FROM joueur');
		$donnees = $reponse->fetch();	

		return $donnees["pseudo"];
	}
	
	public function isExist($pseudo, $mail)
	{
		global $bdd;
		
		$reponse = $bdd->query('SELECT * FROM joueur where pseudo="'.$pseudo.'" or mail="'.$mail.'"');
		$donnees = $reponse->fetch();	

		if($donnees != null)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function inscription($pseudo, $mdp, $mail)
	{
		global $bdd;
		$bdd->query("INSERT INTO joueur(mail, pseudo, pass) VALUES('". $mail ."', '". $pseudo ."', '". $mdp ."')");
	}
}


?>