<?php

	$business = new batimentsBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	

	$village = unserialize($_SESSION["village"]);
	$constrAutorise = true;
	if(count($listBatEnConstr) > 0)
	{
		$constrAutorise = false;
		$tempsFin = $listBatEnConstr[0][3] + $listBatEnConstr[0][2];
		$tempsRest = $tempsFin - time();
		$pourcTpsRest = ($tempsRest / $listBatEnConstr[0][2]) * 100;
	}
?>

<script>
	<?php
		if(count($listBatEnConstr) == 0)
		{
	?>
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
						location.reload();
					}

				});
			}
	
	<?php
		}
	?>
	
	 $( function() {
    $( "#progressbar" ).progressbar({
      value: <?php echo (100 - $pourcTpsRest); ?>
    });
  } );
</script>

<?php
	if(count($listBatEnConstr) > 0)
	{
?>
<div style="width: 80%; margin: auto; margin-top: 10px; margin-bottom: 15px; height: 20px;" id="progressbar"><div style="position: absolute; top:45px; left:0; width:100%; height:100%; font-size: 12px; text-align: center;" id="infos"><?php echo $listBatEnConstr[0][1] . " - " . gmdate('H:i:s', floor($tempsRest)) ?></div></div>

<?php
	}

	foreach ($BATIMENTS as $batiment)
	{
	
		$coutBois = $batiment["bois"] * (pow($batiment["multiplicateur"],$village->GetNiveauByName($batiment["nom"])-1));
		$coutPierre = $batiment["pierre"] * (pow($batiment["multiplicateur"],$village->GetNiveauByName($batiment["nom"])-1));
		$coutMetal = $batiment["metal"] * (pow($batiment["multiplicateur"],$village->GetNiveauByName($batiment["nom"])-1));
		$temps = $batiment["temps"] * (pow($batiment["multiplicateur"],$village->GetNiveauByName($batiment["nom"])-1));
		
		$boisSuf = true;
		$pierreSuf = true;
		$metalSuf = true;
		$couleurBois = "";
		$couleurPierre = "";
		$couleurMetal = "";
		$boutonConstruire = '<div onclick="upBatiment(\'' . $batiment["nom"] . '\')" id="buildBatiment">Construire</div>';
		
		if($village->getBois() < $coutBois)
		{
			$boisSuf = false;
			$couleurBois = "red";
			
		}
		if($village->getPierre() < $coutPierre)
		{
			$pierreSuf = false;
			$couleurPierre = "red";
		}
		if($village->getMetal() < $coutMetal)
		{
			$metalSuf = false;
			$couleurMetal = "red";
		}
		
		if(!$boisSuf  || !$pierreSuf  || !$metalSuf)
		{
			$boutonConstruire = '<div id="buildBatimentInsuf">Construire</div>';
		}
		
		if(!$constrAutorise)
		{
			$boutonConstruire = '<div id="buildBatimentInsuf">Construire</div>';
		}
		
		
		echo 
		'
			<div class="layoutBatiment">
				<div id="nomBatiment">'.$batiment["nom"].'</div>
				<div id="niveauBatiment">niveau : '. $village->GetNiveauByName($batiment["nom"]) .' -> <b><span style="color: green;">'. ($village->GetNiveauByName($batiment["nom"])+1) .'</span></b></div>
				<div id="gainBatiment">Gain par heure : '. floor($gainSecondeBat[$batiment[nom]]*3600) .' -> <b><span style="color: green;"> '. floor($gainSecondeBatSuiv[$batiment[nom]]*3600) .'</span></b></div>
				<div id="imgBatiment"><img src="template/'. $TEMPLATE .'/images/buildings/'.$batiment["img"].'"></div>
				<div id="descBatiment">'.$batiment["description"].'</div>				
				'. $boutonConstruire .'
				<div id="coutBatiment"> <img width="25px" src="template/'. $TEMPLATE .'/images/ressources/wood.png"> <span style="color: '. $couleurBois .';"> '. floor($coutBois) .'</span>  <img width="25px" src="template/'. $TEMPLATE .'/images/ressources/stone.png"> <span style="color: '. $couleurPierre .';">'. floor($coutPierre) .'</span> <img width="25px" src="template/'. $TEMPLATE .'/images/ressources/iron.png"> <span style="color: '. $couleurMetal .';">'. floor($coutMetal) .'</span> <img width="16px" src="template/'. $TEMPLATE .'/images/sablier.png"> '. gmdate('H:i:s', floor($temps)) .' </div>
			</div>
		';
	}
?>


