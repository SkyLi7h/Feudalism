<?php

class messageBusiness
{	
	public function getMessage($id)
		{
			global $bdd;

			$reponse = $bdd->query('SELECT * FROM message WHERE messageId = '. $id)->fetch();
		
			return $reponse;
		}
		
	public function setLu($lu, $id)
		{
			global $bdd;

			$bdd->query('UPDATE message SET lu='. $lu .' WHERE messageId = '. $id)->fetch();
		}
}





?>