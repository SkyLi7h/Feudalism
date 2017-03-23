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
	
	var mx = <?php echo $donneesCoordCarte["x"]; ?>;
	var my = <?php echo $donneesCoordCarte["y"]; ?>;
	
	var x = <?php echo $donneesCoordCarte["x"]; ?>;
	var y = <?php echo $donneesCoordCarte["y"]; ?>;
	
	var carteX = <?php echo $CARTEX; ?>;
	var carteY = <?php echo $CARTEY; ?>;
	
	
	function verifPos()
	{
		if(x-5 < 0)
		{
			x = 6;
		}
		
		if(x+5 > carteX)
		{
			x = carteX - 5;
		}
		
		if(y-5 < 0)
		{
			y = 6;
		}
		
		if(y+5 > carteY)
		{
			y = carteY - 5;
		}
	}
	
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
				document.getElementById("divMap").innerHTML = xhrConnexion.responseText;
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
	
		});		
	}


				
	function moveUpMap()
	{				
		if(!loadEnCours)
		{
			loadEnCours = true;
			y -= 3;							
			verifPos();
			loadMapBd();
		}					
	}

	function moveDownMap()
	{
		if(!loadEnCours)
		{
			loadEnCours = true;
			y += 3;					
			verifPos();
			loadMapBd();
		}
	}

	function moveLeftMap()
	{
		if(!loadEnCours)
		{
			loadEnCours = true;
			x -= 3;				
			verifPos();
			loadMapBd();
		}
	}

	function moveRightMap()
	{
			
		if(!loadEnCours)
		{						
			loadEnCours = true;
			x += 3;														
			verifPos();
			loadMapBd();				
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
	verifPos();
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


