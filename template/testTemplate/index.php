<!doctype html>

<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <Title><?php echo $NAME_APPLICATION;?> - <?php echo $_SESSION['mod']; ?></Title>
	  <meta name="description" content="Feudalism template">
	  <meta name="author" content="Ferrer Lucas">
	  <script src="template/<?php echo $TEMPLATE; ?>/js/jquery/external/jquery/jquery.js"></script>
	  <script src="template/<?php echo $TEMPLATE; ?>/js/jquery/jquery-ui.js"></script>
	  <link href="template/<?php echo $TEMPLATE; ?>/js/jquery/jquery-ui.css" rel="stylesheet">
	  <link rel="stylesheet" type="text/css" href="template/<?php echo $TEMPLATE; ?>/style/style.css" media="screen" />
	</head>	
	<body>
		<script>
			function deconnexion()
			{
				var xhr = new XMLHttpRequest();
				
				xhr.open('GET', 'utils/deconnexion.php', true);
				xhr.send();
				
				xhr.addEventListener('readystatechange', function() {

				if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) 
				{					
					document.location.href="index.php";
				}

			});
			}
		</script>
		<div class="page">
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
			
			<div class="logo">
				<img src="template/<?php echo $TEMPLATE; ?>/images/logo2.png"/>
			</div>				
			
			<div class="mainLayout">
				<div class="bordureHorHaut"></div>
				<div class="rubanHautLayout"><img src="template/<?php echo $TEMPLATE; ?>/images/rubanPrinc.png"></div>
				<div class="bordureHorBas"></div>					
				<div class="bordureVerGauche"></div>					
				<div class="bordureVerDroite"></div>	
				<div class="angleBordureHautGauche"></div>
				<div class="angleBordureHautDroit"></div>
				<div class="angleBordureBasGauche"></div>
				<div class="angleBordureBasDroit"></div>
				<div id="bouttonForum">
					<a href="http://forum.lastimperium.com" target="_blank"><button class="ui-button ui-widget ui-corner-all"><span class="ui-icon ui-icon-arrowreturn-1-e"></span>Forum</button></a>
				</div>		
				<div id="bouttonDev">
					<a href="http://dev.lastimperium.com" target="_blank"><button class="ui-button ui-widget ui-corner-all"></span><span class="ui-icon ui-icon-arrowreturn-1-e"></span>Dev</button></a>
				</div>
				<?php if(isset($_SESSION["joueur"])) {?>
					<div id="bouttonDeconnexion">
						<button onClick="deconnexion()" class="ui-button ui-widget ui-corner-all"></span><span class="ui-icon ui-icon-power"></span></span>Déconnexion</button>
					</div>
				<?php }?>
				
				<div class="include">
					<?php if($MAINTENANCE){
							session_unset();
							$_SESSION["mod"] = $MOD_START;
						?>
						<div class="ui-widget">
							<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
								<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
								<strong>Attention ! </strong> Jeu en maintenant, consultez le forum ou la partie Dev pour plus d'infos !</p>
							</div>
						</div>			
					<?php } ?>
					<?php		
						//Definition de la vue et de la business utilisée
						$viewClass = $_SESSION['mod']."_view.php";
						$businessClass = $_SESSION['mod']."_business.php";
													
						//Message si debug
						if($DEBUG)
							$debug->show("Lancement du template $TEMPLATE");

						//Verif
						if(file_exists( "./business/".$_SESSION['mod']."_business.php" ) && file_exists( ".view/".$_SESSION['mod']."_view.php" ))
						{
							?>
								<div class="ui-widget">
									<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
										<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
										<strong>Erreur:</strong> Cette page n'éxiste pas !</p>
									</div>
								</div>
							
							<?php
						}
						else
						{
							//include de la vue et de la business
							include_once "./business/".$_SESSION['mod']."_business.php";		
							include_once "view/".$_SESSION['mod']."_view.php";							
						}
	
						
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
		</div>
	</body>
	<div class="footer">
		lastimperium.com &copy; 2016-2017 vDev0.1
	</div>
</html>