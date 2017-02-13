<?php

	$business = new indexBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	

	$village = unserialize($_SESSION["village"]);

	//time();
?>

<div id="bois"><?php echo $village->getBois();?></div>

<script>
	var scierie = <?php echo $village->getScierie();?>;
	var boisH = 3600;
	
	var boisS = boisH/3600;
	var bois = <?php echo $village->getBois();?>
	
	function setBois()
	{
		element = document.getElementById("bois");
		bois += boisS;
		element.innerHTML = Math.round(bois);
	}
	
	setInterval("setBois()", 1000);	
</script>