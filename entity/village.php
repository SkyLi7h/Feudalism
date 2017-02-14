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
	private $metal;
	private $bois;
	private $pierre;
	
	public function __construct($villageId, $joueur, $nom, $habitant, $x, $y, $chateau, $caserne, $ferme, $mine, $scierie, $carriere, $metal, $bois, $pierre)
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
		$this->metal = $metal;
		$this->bois = $bois;
		$this->pierre = $pierre;		
	}
	
	public function getVillageId()
	{
		return $this->villageId;
	}
	
	public function getNom()
	{
		return $this->nom;
	}
	
	public function upScierie()
	{
		$this->scierie++;
	}
	
	public function getScierie()
	{
		return $this->scierie;
	}
	
	public function setScierie($s)
	{
		$this->scierie = $s;
	}
	
	public function getBois()
	{
		return $this->bois;
	}

	public function setBois($bois)
	{
		$this->bois = $bois;
	}
	
	public function getCarriere()
	{
		return $this->carriere;
	}
	
	public function setCarriere($c)
	{
		$this->carriere = $c;
	}
	
	public function upCarrier()
	{
		$this->carriere++;
	}
	
	public function getPierre()
	{
		return $this->pierre;
	}

	public function setPierre($pierre)
	{
		$this->pierre = $pierre;
	}
	
	public function upMine()
	{
		$this->mine++;
	}
	
	public function getMine()
	{
		return $this->mine;
	}
	
	public function setMine($m)
	{
		$this->mine = $m;
	}
	
	public function getMetal()
	{
		return $this->metal;
	}

	public function setMetal($metal)
	{
		$this->metal = $metal;
	}
}


?>