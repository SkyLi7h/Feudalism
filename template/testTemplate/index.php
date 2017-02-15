<!doctype html>

<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <Title><?php echo $NAME_APPLICATION;?> - <?php echo $_SESSION['mod']; ?></Title>
	  <meta name="description" content="Feudalism template">
	  <meta name="author" content="Ferrer Lucas">
	  <link rel="stylesheet" type="text/css" href="template/<?php echo $TEMPLATE; ?>/style/style.css" media="screen" />
	</header>	
	<body>
		<?php 
			if(isset($_SESSION["joueur"]))
			{
				$village = unserialize($_SESSION["village"]); 
				$gainSecondeBois =  (($BOISGAINHEURE*POW($MULTIPLICATEUR, $village->getScierie()))/3600);
				$gainSecondePierre =  (($PIERREGAINHEURE*POW($MULTIPLICATEUR, $village->getCarriere()))/3600);
				$gainSecondeMetal =  (($METALGAINHEURE*POW($MULTIPLICATEUR, $village->getMine()))/3600);
			}				
		?>
		<body>
		<div class="hautLayout">
			<?php if(isset($_SESSION["joueur"])) {?>
				<center>
				<span id="bois"><?php echo floor($village->getBois());?></span>
				<span id="pierre"><?php echo floor($village->getPierre());?></span>
				<span id="metal"><?php echo floor($village->getMetal());?></span>
				</center>
			<?php }?>
		</div>
		<div class="mainLayout">
			<div class="bordureHorHaut"></div>
			<div class="rubanHautLayout"><img src="template/<?php echo $TEMPLATE; ?>/images/rubanPrinc.png"></div>
			<div class="bordureHorBas"></div>					
			<div class="bordureVerGauche"></div>					
			<div class="bordureVerDroite"></div>	
			<div class="include">
				<?php		
					//Definition de la vue et de la business utilisée
					$viewClass = $_SESSION['mod']."_view.php";
					$businessClass = $_SESSION['mod']."_business.php";
												
					//Message si debug
					if($DEBUG)
						$debug->show("Lancement du template $TEMPLATE");

					//include de la vue et de la business
					include_once "./business/".$_SESSION['mod']."_business.php";		
					include_once "view/".$_SESSION['mod']."_view.php";
				?>
			</div>
		</div>
		<div class="rubanBasLayout"><img src="template/<?php echo $TEMPLATE; ?>/images/rubanBas.png"></div>
		
		<?php 
			if(isset($_SESSION["joueur"]))
			{
		?>
		<script>
	
			var boisS = <?php echo $gainSecondeBois;?>;
			var bois = <?php echo $village->getBois();?>;
			
			var pierreS = <?php echo $gainSecondePierre;?>;
			var pierre = <?php echo $village->getPierre();?>;
			
			var metalS = <?php echo $gainSecondeMetal;?>;
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
			<?php } ?>
</html>