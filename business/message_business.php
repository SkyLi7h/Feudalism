<?php

class messageBusiness
{	
	public function getAllMessages($joueurId)
		{
			global $bdd;

			$reponse = $bdd->query('SELECT * FROM message WHERE joueurDest = '. $joueurId);
		
			return $reponse;
		}
}





?>