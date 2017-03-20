<?php

	$business = new carteBusiness();
	$villageCarte = new villageDao();
 	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
	$reponseCoordCarte = $bdd->query('SELECT * from carte where villageId ='.$village->getVillageId());
	$donneesCoordCarte = $reponseCoordCarte->fetch();
	
	$carte = $business->getCarte($donneesCoordCarte["x"], $donneesCoordCarte["y"]);
	
?>
	<script>
	
	var x = <?php echo $donneesCoordCarte["x"]; ?>;
	var y = <?php echo $donneesCoordCarte["y"]; ?>;
	
	var carteX = <?php echo $CARTEX; ?>;
	var carteY = <?php echo $CARTEY; ?>;
				
	var minX = x-5;
	var minY = y-5;
	var maxY = y+5;
	var maxX = x+5;
	
	
	function verifXY()
	{
		
		if(x < 1)
			x = 1;
		
		if(x > carteX -5)
			x = carteX -5;
		
		if(y < 1)
			y = 1;
		
		if(y > carteY - 5)
			y = carteY - 5;
		
		
		if(minX < 1)
		{
			reste = 1 - minX;
			minX = 1;
			maxX += reste;
		}
		
		if(minY < 1)
		{
			reste = 1 - minY;
			minY = 1;
			maxY += reste;
		}

		if(maxX > carteX)
		{
			reste = maxX - carteX;
			maxX = carteX;
			minX -= reste;
		}
		
		if(maxY > carteY)
		{
			reste = maxY - carteY;
			maxY = carteY;
			minY -= reste;
		}
	}
	
	verifXY();

	var carte = [];
	
	var loadEnCours = false;
		
	function loadMapBd()
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
	}
				
		function chargerCarte()
				{
					var tableCarte = "<table cellspacing='0' id='tableCarte'>";
					var img;
					var onClick = "";
					
					for(var y = minY; y <= maxY; y++)
					{
						tableCarte += "<tr>";
						ligne = carte[y];
						

						for(var x = minX; x <= maxX; x++)
						{
							onClick = "";							
							
							if(carte[y][x]["type"] == "plaine")		
								img = "template/<?php echo $TEMPLATE;?>/images/carte/plaine.png";
							if(carte[y][x]["type"] == "montagne")		
								img = "template/<?php echo $TEMPLATE;?>/images/carte/moutain.png";
							if(carte[y][x]["type"] == "foret")		
								img = "template/<?php echo $TEMPLATE;?>/images/carte/forest.png";
							if(carte[y][x]["type"] == "village")	
								img = "template/<?php echo $TEMPLATE;?>/images/carte/village.png";
												
							if(carte[y][x]["type"] == "village")
							{
								onClick = "onclick='afficherVillage("+ carte[y][x]["joueurId"] +","+ carte[y][x]["villageId"] +",\""+ carte[y][x]["nom"] +"\");'";
							}
							
							carte[y][x]["nom"] = carte[y][x]["nom"] + " x: " + x + " y: " + y;
							
							tableCarte += "<td "+ onClick +" style='background-image:url("+ img +"); -webkit-background-size: cover; background-size: cover;' title='"+ carte[y][x]["nom"] +"' id='tooltip'></td>";
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
					  
					  loadEnCours = false;
					  					
					
				}


				
				function moveUpMap()
				{				
					if(!loadEnCours)
					{
						if((y-5) > 1)
						{
							loadEnCours = true;
							y -= 1;
							minY = y-5;
							maxY = y+5;							
							verifXY();
							loadMapBd();
						}
					}					
				}
				
				function moveDownMap()
				{
					if(!loadEnCours)
					{
						if((y + 5) < carteY)
						{
							loadEnCours = true;
							y += 1;
							minY = y-5;
							maxY = y+5;						
							verifXY();
							loadMapBd();
						}
					}
				}
				
				function moveLeftMap()
				{
					if(!loadEnCours)
					{
						if((x-5) > 1)
						{	
							loadEnCours = true;
							x -= 1;
							minX = x-5;
							maxX = x+5;					
							verifXY();
							loadMapBd();
							console.log(x + " " + y);
						}
					}
				}
				
				function moveRightMap()
				{
						
					if(!loadEnCours)
					{
						
						if((x + 5) < carteX)
						{
							loadEnCours = true;
							x += 1;
							minX = x-5;
							maxX = x+5;															
							verifXY();
							loadMapBd();
						}					
					}
					
				}
				

	</script>

<div id="dialog" title="">
  <div id="layoutButtonDialog">
	<div id="piller">
		<a href="index.php?mod=piller" id="lienPiller"><button class="ui-button ui-widget ui-corner-all">Piller</button></a>
	</div>
  </div>
  <div id="layoutButtonDialog">
	<div id="envoyerSoutien">
		<a href="index.php?mod=envSoutien" id="lienEnvSoutien"><button class="ui-button ui-widget ui-corner-all">Envoyer du soutien</button></a>
	</div>
  </div>
  <div id="layoutButtonDialog">
	<div id="bouttonEnvoyerInfos">
		<a href="index.php?mod=infosVillage" id="lienViwInfosVi"><button class="ui-button ui-widget ui-corner-all">Infos du village</button></a>
	</div>
  </div>
  <div id="layoutButtonDialog">
	<div id="bouttonEnvoyerInfos">
		<a href="index.php?mod=infosJoueur" id="lienViwInfosJo"><button class="ui-button ui-widget ui-corner-all">Infos du joueur</button></a>
	</div>
  </div>
</div>

	
<div id="divMapLayout">
	<div id="arrowUpMap" onclick="moveUpMap();"></div>
	<div id="arrowDownMap" onclick="moveDownMap();"></div>
	<div id="arrowLeftMap" onclick="moveLeftMap();"></div>
	<div id="arrowRightMap" onclick="moveRightMap();"></div>
	<div id="divMap"></div>
</div>

<script>
	loadMapBd();

	function afficherVillage(joueurId, villageId, nom)
	{
		$('#dialog').dialog('option', 'title', nom);
		$('#dialog').dialog('option', 'width', "400px");
		document.getElementById("lienPiller").href = "index.php?mod=piller&id=" + villageId;
		document.getElementById("lienEnvSoutien").href = "index.php?mod=envSoutien&id=" + villageId;
		document.getElementById("lienViwInfosVi").href = "index.php?mod=infosVillage&id=" + villageId;
		document.getElementById("lienViwInfosJo").href = "index.php?mod=infosJoueur&id=" + joueurId;
		$( "#dialog" ).dialog( "open" );
	}
	
	$( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 400
      },
      hide: {
        effect: "blind",
        duration: 400
      }
    });

</script>


