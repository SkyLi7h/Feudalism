<?php

class messageBusiness
{	
	public function getAllMessages($joueurId)
		{
			global $bdd;

			$reponse = $bdd->query('SELECT * FROM message WHERE joueurDest = '. $joueurId);
		
			return $reponse;
		}
		
			
	public function setAllLu($joueurId)
		{
			global $bdd;

			$bdd->query('UPDATE message SET lu=1 WHERE joueurDest = '. $joueurId)->fetch();
		}
}





?>