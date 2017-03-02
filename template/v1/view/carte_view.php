<?php

	$business = new carteBusiness();
	$villageCarte = new villageDao();
 	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	

	$village = unserialize($_SESSION["village"]);
	
	$reponseCoordCarte = $bdd->query('SELECT * from carte where villageId ='.$village->getVillageId());
	$donneesCoordCarte = $reponseCoordCarte->fetch();
	
	if(isset($_GET["x"]) && isset($_GET["y"]))
	{
		$donneesCoordCarte["x"] += $_GET["x"];
		$donneesCoordCarte["y"] += $_GET["y"];
	}
	
	$carte = $business->getCarte($donneesCoordCarte["x"], $donneesCoordCarte["y"]);
	
?>
	<script>
		var carte = [];	
			
		function chargerCarte()
				{
					var tableCarte = "<table cellspacing='0' id='tableCarte'>";
					var img;
					
					for(var y = minY; y < maxY; y++)
					{
						tableCarte += "<tr>";
						ligne = carte[y];
						

						for(var x = minX; x < maxX; x++)
						{
							if(carte[y][x]["type"] == "plaine")		
								img = "template/<?php echo $TEMPLATE;?>/images/carte/plaine.png";
							if(carte[y][x]["type"] == "montagne")		
								img = "template/<?php echo $TEMPLATE;?>/images/carte/moutain.png";
							if(carte[y][x]["type"] == "foret")		
								img = "template/<?php echo $TEMPLATE;?>/images/carte/forest.png";
							if(carte[y][x]["type"] == "village")	
								img = "template/<?php echo $TEMPLATE;?>/images/carte/village.png";
														
							tableCarte += "<td style='background-image:url("+ img +"); -webkit-background-size: cover; background-size: cover;' title='"+ carte[y][x]["nom"] +"' id='tooltip'></td>";
						}
						
						tableCarte += "</tr>";					
					}
					
					
					tableCarte += "</table>";
					document.getElementById("divMap").innerHTML = tableCarte;
					
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
				
<?php	
	$minX =99999;
	$minY =99999;
	$maxX = 0;
	$maxY = 0;
	while($donnees = $carte->fetch())
	{
		if($donnees["y"] < $minY)
		{
			$minY = $donnees["y"];
		}
		if($donnees["x"] < $minX)
		{
			$minX = $donnees["x"];
		}
		
		if($donnees["y"] > $maxY)
		{
			$maxY = $donnees["y"];
		}
		if($donnees["x"] > $maxX)
		{
			$maxX = $donnees["x"];
		}
		?>
				if(carte[<?php echo  $donnees["y"];?>] == null)
					carte[<?php echo  $donnees["y"];?>] = [];
				
				carte[<?php echo  $donnees["y"];?>][<?php echo  $donnees["x"];?>] = [];
					carte[<?php echo  $donnees["y"];?>][<?php echo  $donnees["x"];?>]["type"] = ["<?php echo  $donnees["type"];?>"];
					<?php
						if($donnees["type"] == "village")
						{
							$village = $villageCarte->getVillageById($donnees["villageId"]);
					?>
						carte[<?php echo  $donnees["y"];?>][<?php echo  $donnees["x"];?>]["nom"] = ["<?php echo  $village->getNom();?>"];
					<?php
						}
						else
						{
					?>
						carte[<?php echo  $donnees["y"];?>][<?php echo  $donnees["x"];?>]["nom"] = ["<?php echo  $donnees["type"];?>"];
					<?php
						}
	}
?>
	var minX = <?php echo $minX;?>;
	var minY = <?php echo $minY;?>;
	var maxY = <?php echo $maxY;?>;
	var maxX = <?php echo $maxX;?>;
	</script>

<div id="divMap"></div>

<script>
	chargerCarte();
</script>


