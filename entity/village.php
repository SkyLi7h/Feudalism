<?php

class village
{
	private $villageId;
	private $joueur;
	private $nom;
	private $habitant;
	private $x;
	private $y;
	private $chateau;
	private $caserne;
	private $ferme;
	private $mine;
	private $scierie;
	private $carriere;
	private $bois;
	private $pierre;
	
	public function __construct($villageId, $joueur, $nom, $habitant, $x, $y, $chateau, $caserne, $ferme, $mine, $scierie, $carriere, $bois, $pierre)
	{
		$this->villageId = $villageId;
		$this->joueur = $joueur;
		$this->nom = $nom;
		$this->habitant = $habitant;
		$this->x = $x;
		$this->y = $y;
		$this->chateau = $chateau;
		$this->caserne = $caserne;
		$this->ferme = $ferme;
		$this->mine = $mine;
		$this->scierie = $scierie;
		$this->carriere = $carriere;
		$this->bois = $bois;
		$this->pierre = $pierre;		
	}
	
	public function getNom()
	{
		return $this->nom;
	}
	
	public function getScierie()
	{
		return $this->scierie;
	}
}


?>