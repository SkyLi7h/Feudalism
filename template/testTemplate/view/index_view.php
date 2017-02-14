<?php

	$business = new indexBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	

	$village = unserialize($_SESSION["village"]);

	//time();
?>

<div id="bois"><?php echo floor($village->getBois());?></div>
<div id="pierre"><?php echo floor($village->getPierre());?></div>
<div id="metal"><?php echo floor($village->getMetal());?></div>

<script>
	
	var boisS = <?php echo (($BOISGAINHEURE*POW($MULTIPLICATEUR, $village->getScierie()))/3600);?>;
	var bois = <?php echo $village->getBois();?>;
	
	var pierreS = <?php echo (($PIERREGAINHEURE*POW($MULTIPLICATEUR, $village->getCarriere()))/3600);?>;
	var pierre = <?php echo $village->getPierre();?>;
	
	var metalS = <?php echo (($METALGAINHEURE*POW($MULTIPLICATEUR, $village->getMine()))/3600);?>;
	var metal = <?php echo $village->getMetal();?>;
	
	function setBois()
	{
		element = document.getElementById("bois");
		bois += boisS;
		element.innerHTML = Math.floor(bois);
	}
	
	function setPierre()
	{
		element = document.getElementById("pierre");
		pierre += pierreS;
		element.innerHTML = Math.floor(pierre);
	}
	
	function setMetal()
	{
		element = document.getElementById("metal");
		metal += metalS;
		element.innerHTML = Math.floor(metal);
	}
	
	function majRessources()
	{
		setBois();
		setPierre();
		setMetal();	
	}
	
	setInterval("majRessources()", 1000);	
</script>