<?php

class indexBusiness
{	
	public function affichePseudo()
	{		
		$joueurDAO = new joueurDao();
		echo $joueurDAO->getPseudoFirstJoueur();
	}
	
	public function getVillageById($id)
	{		
		$villageDao = new villageDao();
		$village = $villageDao->getVillageById($id);
		return $village;
	}
}





?>