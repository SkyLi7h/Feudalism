<?php

class joueur
{
	private $joueurId;
	private $email;
	private $pseudo;
	private $pass;
	private $ors;
	
	public function __construct($joueurId, $email, $pseudo, $pass, $ors)
	{
		$this->joueurId = $joueurId;
		$this->email = $email;
		$this->pseudo = $pseudo;
		$this->pass = $pass;
		$this->ors = $ors;		
	}
	
	public function getEmail()
	{
		return $this->email;
	}
}


?>