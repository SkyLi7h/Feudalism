<?php

require_once "DAO/joueurDao.php";

class index
{
	public function affichePseudo()
	{		
		$joueurDAO = new joueurDao();
		echo $joueurDAO->getPseudoFirstJoueur();
	}
}





?>