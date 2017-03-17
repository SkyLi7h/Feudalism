<?php

class pillerBusiness
{	
	public function getVillage($id)
		{
			global $bdd;

			$reponse = $bdd->query('SELECT * FROM village WHERE villageId = '. $id)->fetch();
		
			return $reponse;
		}
}





?>