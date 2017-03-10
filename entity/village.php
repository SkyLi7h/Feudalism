<?php

class village
{
	private $villageId;
	private $joueur;
	private $nom;
	private $habitant;
	
	//Batiments
	private $chateau;
	private $caserne;
	private $mine;
	private $scierie;
	private $carriere;
	
	//Ressources
	private $metal;
	private $bois;
	private $pierre;
	
	//Unites
	private $paysans;
	private $lancePierre;
	private $guerrier;
	private $archer;
	private $hache;
	private $piquier;
	private $hommeDeMain;
	private $chevalier;
	private $catapulte;
	
	
	
	public function __construct($villageId, $joueur, $nom, $habitant, $chateau, $caserne, $mine, $scierie, $carriere, $metal, $bois, $pierre, $paysans, $lancePierre, $guerrier, $archer, $hache, $piquier, $hommeDeMain, $chevalier, $catapulte)
	{
		$this->villageId = $villageId;
		$this->joueur = $joueur;
		$this->nom = $nom;
		$this->habitant = $habitant;
		$this->chateau = $chateau;
		$this->caserne = $caserne;
		$this->mine = $mine;
		$this->scierie = $scierie;
		$this->carriere = $carriere;
		$this->metal = $metal;
		$this->bois = $bois;
		$this->pierre = $pierre;	
		$this->paysans = $paysans;
		$this->lancePierre = $lancePierre;	
		$this->guerrier = $guerrier;
		$this->archer = $archer;
		$this->hache = $hache;
		$this->piquier = $piquier;
		$this->hommeDeMain = $hommeDeMain;
		$this->chevalier = $chevalier;
		$this->catapulte = $catapulte;
	}
	
	public function GetNiveauByName($nom)
	{
		switch($nom)
		{
			case "Scierie":
				return $this->getScierie();
			case "Carriere":
				return $this->getCarriere();
			case "Mine":
				return $this->getMine();
			case "Château":
				return $this->getChateau();
			case "Caserne":
				return $this->getCaserne();
		}
	}
	
	public function GetNbByName($nom)
	{
		switch($nom)
		{
			case "Paysans":
				return $this->getPaysans();
			case "Lance-pierre":
				return $this->getLancePierre();
			case "Guerrier":
				return $this->getGuerrier();
			case "Archer":
				return $this->getArcher();
			case "Hache":
				return $this->getHache();
			case "Piquier":
				return $this->getPiquier();
			case "Homme De Main":
				return $this->getHommeDeMain();
			case "Chevalier":
				return $this->getChevalier();
			case "Catapulte":
				return $this->getCatapulte();
		}
	}
	
	public function getJoueurId()
	{
		return $this->joueur;
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
	
	public function upCarriere()
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
	
	public function upChateau()
	{
		$this->chateau++;
	}
	
	public function getChateau()
	{
		return $this->chateau;
	}
	
	public function setChateau($c)
	{
		$this->chateau = $c;
	}
	
	public function upCaserne()
	{
		$this->caserne++;
	}
	
	public function getCaserne()
	{
		return $this->caserne;
	}
	public function setCaserne($c)
	{
		$this->caserne = $c;
	}
	
	public function getPaysans()
	{
		return $this->paysans;
	}
	
	public function setPaysans($nb)
	{
		$this->paysans = $nb;
	}
	
	public function addPaysans($nb)
	{
		$this->paysans += $nb;
	}
	
	public function getLancePierre()
	{
		return $this->lancePierre;
	}
	
	public function setLancePierre($nb)
	{
		$this->lancePierre = $nb;
	}
	
	public function addLancePierre($nb)
	{
		$this->lancePierre += $nb;
	}
	
	public function getGuerrier()
	{
		return $this->guerrier;
	}
	
	public function setGuerrier($nb)
	{
		$this->guerrier = $nb;
	}
	
	public function addGuerrier($nb)
	{
		$this->guerrier += $nb;
	}
	public function getArcher()
	{
		return $this->archer;
	}
	
	public function setArcher($nb)
	{
		$this->archer = $nb;
	}
	
	public function addArcher($nb)
	{
		$this->archer += $nb;
	}
	
	public function getHache()
	{
		return $this->hache;
	}
	
	public function setHache($nb)
	{
		$this->hache = $nb;
	}
	
	public function addHache($nb)
	{
		$this->hache += $nb;
	}
	public function getPiquier()
	{
		return $this->piquier;
	}
	
	public function setPiquier($nb)
	{
		$this->piquier = $nb;
	}
	
	public function addPiquier($nb)
	{
		$this->piquier += $nb;
	}
	
	public function getHommeDeMain()
	{
		return $this->hommeDeMain;
	}
	
	public function setHommeDeMain($nb)
	{
		$this->hommeDeMain = $nb;
	}
	
	public function addHommeDeMain($nb)
	{
		$this->hommeDeMain += $nb;
	}
	
	public function getChevalier()
	{
		return $this->chevalier;
	}
	
	public function setChevalier($nb)
	{
		$this->chevalier = $nb;
	}
	
	public function addChevalier($nb)
	{
		$this->chevalier += $nb;
	}
	
	public function getCatapulte()
	{
		return $this->catapulte;
	}
	
	public function setCatapulte($nb)
	{
		$this->catapulte = $nb;
	}
	
	public function addCatapulte($nb)
	{
		$this->catapulte += $nb;
	}
}


?>