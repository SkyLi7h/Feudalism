<?php

	$business = new villageBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
	$gainSecondeBoisSuiv = ($BATIMENTS["Scierie"]["gain"][$village->getScierie()+1]/3600);
	$gainSecondePierreSuiv = ($BATIMENTS["Carriere"]["gain"][$village->getCarriere()+1]/3600);
	$gainSecondeMetalSuiv = ($BATIMENTS["Mine"]["gain"][$village->getMine()+1]/3600);
					
	$gainSecondeBatSuiv = [];
	$gainSecondeBatSuiv["Scierie"] = $gainSecondeBoisSuiv;
	$gainSecondeBatSuiv["Carriere"] = $gainSecondePierreSuiv;
	$gainSecondeBatSuiv["Mine"] = $gainSecondeMetalSuiv;
					
	$gainSecondeBat = [];
	$gainSecondeBat["Scierie"] = $gainSecondeBois;
	$gainSecondeBat["Carriere"] = $gainSecondePierre;
	$gainSecondeBat["Mine"] = $gainSecondeMetal;
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
	

</script>


<div id="tabs" style="color:black;">
  <ul>
    <li><a href="#tabBatiment">Bâtiments</a></li>
    <li><a href="#tabs-2">Unités</a></li>
  </ul>
  <div id="tabBatiment">
	<?php

	foreach ($BATIMENTS as $batiment)
	{
	
		if($village->GetNiveauByName($batiment["nom"]) == $batiment["maxNiveau"])
		{
			$boutonConstruire = '<div id="buildBatimentInsuf">Niveau max</div>';
			
			echo '<div class="layoutBatiment">';
				echo'<div id="nomBatiment">'.$batiment["nom"].'</div>';
				echo'<div id="niveauBatiment">niveau : '. $village->GetNiveauByName($batiment["nom"]) .'</div>';
				if($batiment["type"] == "Ressource")
				{
					echo'<div id="gainBatiment">Gain par heure : '. floor($gainSecondeBat[$batiment["nom"]]*3600) .'</div>';
				}	
				echo'<div id="imgBatiment"><img src="template/'. $TEMPLATE .'/images/buildings/'.$batiment["img"].'"></div>';
				echo'<div id="descBatiment">'.$batiment["description"].'</div>';		
				echo $boutonConstruire;
			echo '</div>';
			
		}
		else
		{
			$coutBois = $batiment["cout"][$village->GetNiveauByName($batiment["nom"])]["bois"];
			$coutPierre = $batiment["cout"][$village->GetNiveauByName($batiment["nom"])]["pierre"];
			$coutMetal = $batiment["cout"][$village->GetNiveauByName($batiment["nom"])]["metal"];
			$temps = $batiment["cout"][$village->GetNiveauByName($batiment["nom"])]["temps"];
			
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
			
			echo '<div class="layoutBatiment">';
				echo'<div id="nomBatiment">'.$batiment["nom"].'</div>';
				echo'<div id="niveauBatiment">niveau : '. $village->GetNiveauByName($batiment["nom"]) .' -> <b><span style="color: green;">'. ($village->GetNiveauByName($batiment["nom"])+1) .'</span></b></div>';
				if($batiment["type"] == "Ressource")
				{
					echo'<div id="gainBatiment">Gain par heure : '. floor($gainSecondeBat[$batiment["nom"]]*3600) .' -> <b><span style="color: green;"> '. floor($gainSecondeBatSuiv[$batiment["nom"]]*3600) .'</span></b></div>';
				}	
				echo'<div id="imgBatiment"><img src="template/'. $TEMPLATE .'/images/buildings/'.$batiment["img"].'"></div>';
				echo'<div id="descBatiment">'.$batiment["description"].'</div>';		
				echo $boutonConstruire;
				echo'<div id="coutBatiment"> <img width="25px" src="template/'. $TEMPLATE .'/images/ressources/wood.png"> <span style="color: '. $couleurBois .';"> '. floor($coutBois) .'</span>  <img width="25px" src="template/'. $TEMPLATE .'/images/ressources/stone.png"> <span style="color: '. $couleurPierre .';">'. floor($coutPierre) .'</span> <img width="25px" src="template/'. $TEMPLATE .'/images/ressources/iron.png"> <span style="color: '. $couleurMetal .';">'. floor($coutMetal) .'</span> <img width="16px" src="template/'. $TEMPLATE .'/images/sablier.png"> '. gmdate('H:i:s', floor($temps)) .' </div>';
			echo '</div>';
		}
	}
?>
  </div>
  <div id="tabs-2">
  <div class="recapUniteLayout">
	  <table class="recapUnite">
		<tr>
			<td>Unité :</td>
			<?php
				foreach ($UNITES as $unite)
					{
						echo '<td id="tooltip" title="'. $unite["nom"] .'"><img width="15px" src="template/'. $TEMPLATE .'/images/unites/'.$unite["img"].'"></td>';
					}
			?>
		</tr>
		<tr>
			<td>Nombre :</td>
			<?php
				foreach ($UNITES as $unite)
					{
						echo "<td>" . $village->GetNbByName($unite["nom"]) . "</td>";
					}
			?>
		</tr>

	</table>
</div>


<?php
	foreach ($UNITES as $unite)
	{
		
			$coutBois = $unite["cout"]["bois"];
			$coutPierre = $unite["cout"]["pierre"];
			$coutMetal = $unite["cout"]["metal"];
			$temps = $unite["cout"]["temps"];
			
			$boisSuf = true;
			$pierreSuf = true;
			$metalSuf = true;
			
			$couleurBois = "";
			$couleurPierre = "";
			$couleurMetal = "";
			$boutonRecruter = '<div onclick="recruter(\'' . str_replace(' ','',$unite["nom"]) . '\')" id="RecrutUnite">Recruter</div>';
			
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
				$boutonRecruter = '<div id="RecrutUniteInsuf">Recruter</div>';
			}
			
			if(!$recrutAutorise)
			{
				$boutonRecruter = '<div id="RecrutUniteInsuf">Recruter</div>';
			}
			
		if($village->getCaserne() >= $unite["caserne"])
		{
			echo '<div class="layoutUnite">';
				echo'<div id="nomUnite">'.$unite["nom"].'</div>';
				//echo'<div id="nbUnite">Nombre actuel : ' . $village->GetNbByName($unite["nom"]) .'</div>';
				echo'<div id="imgUnite"><img width="65px" src="template/'. $TEMPLATE .'/images/unites/'.$unite["img"].'"></div>';
				echo'<div id="descUnite">'.$unite["description"].'</div>';	
				echo'<div id="nbUnitRecrut"><input placeholder="0" type="number" min="0" id="'. str_replace(' ','',$unite["nom"]) .'"></input></div>';
				echo $boutonRecruter;
				echo'<div id="coutUnite"> <img id="tooltip" title="Bois" width="25px" src="template/'. $TEMPLATE .'/images/ressources/wood.png"> <span style="color: '. $couleurBois .';"> '. floor($coutBois) .'</span>  <img id="tooltip" title="Pierre" width="25px" src="template/'. $TEMPLATE .'/images/ressources/stone.png"> <span style="color: '. $couleurPierre .';">'. floor($coutPierre) .'</span> <img id="tooltip" title="Metal" width="25px" src="template/'. $TEMPLATE .'/images/ressources/iron.png"> <span style="color: '. $couleurMetal .';">'. floor($coutMetal) .'</span> <img id="tooltip" title="Temps" width="16px" src="template/'. $TEMPLATE .'/images/sablier.png"> '. gmdate('H:i:s', floor($temps)) .' </div>';
				echo'<div id="statsUnite"> <img id="tooltip" title="Attaque" width="18px" src="template/'. $TEMPLATE .'/images/atk.png"> '.$unite["ATK"].' <img width="18px" id="tooltip" title="Défense" src="template/'. $TEMPLATE .'/images/def.png"> '.$unite["DEF"].'</div>';	
			echo '</div>';
		}
		else
		{
			echo '<div class="layoutUnite">';
				echo'<div id="nomUnite">'.$unite["nom"].'</div>';
				echo'<div id="requisUnite">Caserne de niveau ' . $unite["caserne"] . ' requis !</div>';
				echo'<div id="imgUnite"><img width="65px" src="template/'. $TEMPLATE .'/images/unites/'.$unite["img"].'"></div>';
				echo'<div id="descUnite">'.$unite["description"].'</div>';					
				echo'<div id="coutUnite"> <img id="tooltip" title="Bois" width="25px" src="template/'. $TEMPLATE .'/images/ressources/wood.png"> <span style="color: '. $couleurBois .';"> '. floor($coutBois) .'</span>  <img id="tooltip" title="Pierre" width="25px" src="template/'. $TEMPLATE .'/images/ressources/stone.png"> <span style="color: '. $couleurPierre .';">'. floor($coutPierre) .'</span> <img id="tooltip" title="Metal" width="25px" src="template/'. $TEMPLATE .'/images/ressources/iron.png"> <span style="color: '. $couleurMetal .';">'. floor($coutMetal) .'</span> <img id="tooltip" title="Temps" width="16px" src="template/'. $TEMPLATE .'/images/sablier.png"> '. gmdate('H:i:s', floor($temps)) .' </div>';
				echo'<div id="statsUnite"> <img id="tooltip" title="Attaque" width="18px" src="template/'. $TEMPLATE .'/images/atk.png"> '.$unite["ATK"].' <img width="18px" id="tooltip" title="Défense" src="template/'. $TEMPLATE .'/images/def.png"> '.$unite["DEF"].'</div>';	
			echo '</div>';
		}
	}
?>

<script>

function recruter(unite)
			{
				var nb = document.getElementById(unite).value;
				var xhr = new XMLHttpRequest();		
				xhr.open('POST', 'utils/recruter.php');
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send('unite=' + unite + '&nb=' + nb);
				
				xhr.addEventListener('readystatechange', function() 
				{
					if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) 
					{
						location.reload();
					}
				});
			}

$( function() {
				var tooltips = $( "[title]" ).tooltip({
				  position: {
					my: "left top",
					at: "right+5 top-5",
					collision: "none"
				  }
				});
			  } );
</script>
   </div>
</div>

<script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>



