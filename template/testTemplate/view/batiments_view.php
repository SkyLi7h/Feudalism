<?php

	$business = new batimentsBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	

	$village = unserialize($_SESSION["village"]);
?>

<script>
	function upBatiment(batiment)
	{
		var xhr = new XMLHttpRequest();
		
		xhr.open('POST', 'utils/upBatiment.php');
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('bat=' + batiment);
		
		xhr.addEventListener('readystatechange', function() 
		{

			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) 
			{
				console.log(xhr.responseText);
			}

		});
	}

</script>

<div id="nomBatiment">Scierie</div>
<div id="niveauBatiment">niveau : <?php echo $village->getScierie(); ?></div>
<div id="niveauBatiment">Gain par heure : <?php echo floor($gainSecondeBois*3600); ?></div>
<div><button onclick="upBatiment('scierie')">Up</button></div>