<?php

	$business = new indexBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
	$village = $business->getVillageById(1);
	
	echo $village->getNom();

	//time();
?>

<div id="bois">0</div>

<script>
	var scierie = <?php echo $village->getScierie();?>;
	var boisH = 400;
	
	var boisS = boisH/3600;
	var bois = 0;
	
	function setBois()
	{
		element = document.getElementById("bois");
		bois += boisS;
		element.innerHTML = Math.round(bois);
	}
	
	setInterval("setBois()", 1000);
	
</script>