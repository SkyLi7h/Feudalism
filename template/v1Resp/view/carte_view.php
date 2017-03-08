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
	
	var x = <?php echo $donneesCoordCarte["x"]; ?>;
	var y = <?php echo $donneesCoordCarte["y"]; ?>;
	
				
	var minX = x-5;
	var minY = y-5;
	var maxY = y+6;
	var maxX = x+6;
	
	var carte = [];
	
	var loadEnCours = false;
		
	function loadMapBd()
	{	
		if(!loadEnCours)
		{
			loadEnCours = true;
			var xhrConnexion = new XMLHttpRequest();	
			
			xhrConnexion.open('POST', 'utils/loadMap.php');
			xhrConnexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhrConnexion.send('x=' + x + '&y=' + y);
			
			xhrConnexion.addEventListener('readystatechange', function() {

			if (xhrConnexion.readyState === XMLHttpRequest.DONE && xhrConnexion.status === 200) {	
					
					carte = JSON.parse(xhrConnexion.responseText);
					
					chargerCarte();
			}

			});
			
			loadEnCours = false;
		}
			
	}
				
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
					
					$( function() {
						var tooltips = $( "[title]" ).tooltip({
						  position: {
							my: "left top",
							at: "right+5 top-5",
							collision: "none"
						  }
						});
					  } );
					
				}

				var carteX = <?php echo $CARTEX; ?>;
				var carteY = <?php echo $CARTEY; ?>;
				
				function moveUpMap()
				{				
					
					if(minY >= 2)
					{
						y -= 1;
						minY = y-5;
						maxY = y+6;
						loadMapBd();
					}
					
				}
				
				function moveDownMap()
				{
					if(maxY <= carteY-1)
					{
						y += 1;
						minY = y-5;
						maxY = y+6;
						loadMapBd();
					}
				}
				
				function moveLeftMap()
				{
					if(minX >= 2)
					{
						x -= 1;
						minX = x-5;
						maxX = x+6;
						loadMapBd();
					}
				}
				
				function moveRightMap()
				{
					if(maxX <= carteX-1)
					{
						x += 1;
						minX = x-5;
						maxX = x+6;
						loadMapBd();
					}
				}
				

	</script>

<div id="arrowUpMap" onclick="moveUpMap();"></div>
<div id="arrowDownMap" onclick="moveDownMap();"></div>
<div id="arrowLeftMap" onclick="moveLeftMap();"></div>
<div id="arrowRightMap" onclick="moveRightMap();"></div>
	
<div id="divMap"></div>

<script>
	loadMapBd();
</script>


