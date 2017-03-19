<!doctype html>

<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <Title><?php echo $NAME_APPLICATION;?> - <?php echo $_SESSION['mod']; ?></Title>
	  <meta name ="description" content ="<?php echo $DESCRIPTION;?>">
	  <meta name="author" content="<?php echo $AUTEUR;?>">
	  <meta name="keywords" content="<?php echo $MOTSCLES;?>">
	  <meta name="news_keywords" content="<?php echo $MOTSCLES;?>" />
	  <script src="template/<?php echo $TEMPLATE; ?>/js/jquery/external/jquery/jquery.js"></script>
	  <script src="template/<?php echo $TEMPLATE; ?>/js/jquery/jquery-ui.js"></script>
	  <link href="template/<?php echo $TEMPLATE; ?>/js/jquery/jquery-ui.css" rel="stylesheet">
	  <link rel="stylesheet" type="text/css" href="template/<?php echo $TEMPLATE; ?>/style/style.css?v=0.02" media="screen" />
	  <link rel="shortcut icon" href="template/<?php echo $TEMPLATE; ?>/images/favicon.ico" type="image/x-icon">
	  <link rel="icon" href="template/<?php echo $TEMPLATE; ?>/images/favicon.ico" type="image/x-icon">
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
			
			var constrAutorise = true;
			var recrutAutorise = true;
			var enReload = false;
		</script>
		
		<?php 
				if(isset($_SESSION["joueur"]))
				{
					$village = unserialize($_SESSION["village"]); 
					$joueur = unserialize($_SESSION["joueur"]);
					
					//Maj des ressources dans la session
					$gainSecondeBois = ($BATIMENTS["Scierie"]["gain"][$village->getScierie()]/3600);
					$gainSecondePierre = ($BATIMENTS["Carriere"]["gain"][$village->getCarriere()]/3600);
					$gainSecondeMetal = ($BATIMENTS["Mine"]["gain"][$village->getMine()]/3600);
					
					$nbMessageNonLus = $bdd->query("SELECT COUNT(*) FROM message WHERE joueurDest=". $joueur->getJoueurId() ." AND lu=0")->fetchColumn();
					$nbAttaques = $bdd->query("SELECT COUNT(*) FROM deplacement WHERE idVillageDest=". $village->getVillageId() ." AND type='combat'")->fetchColumn();
}
?>
			
		<div class="page">
			
			<div class="hautLayout">
				<div class="contentHautLayout">
					<?php if(isset($_SESSION["joueur"])) {?>						
						<img width="25px" src="template/<?php echo $TEMPLATE; ?>/images/ressources/wood.png"><span id="bois"><?php echo floor($village->getBois());?></span>
						<img width="25px" src="template/<?php echo $TEMPLATE; ?>/images/ressources/stone.png"><span id="pierre"><?php echo floor($village->getPierre());?></span>
						<img width="25px" src="template/<?php echo $TEMPLATE; ?>/images/ressources/iron.png"><span id="metal"><?php echo floor($village->getMetal());?></span>
						<a href="index.php?mod=message"><span id ="notifMessage" <?php if($nbMessageNonLus > 0){?> style="color:orange;" <?php }; ?>><img id ="notifMessageImg" width="20px" src="template/<?php echo $TEMPLATE; ?>/images/message.png"><?php echo $nbMessageNonLus; ?><?php if($nbMessageNonLus > 1){?> messages <?php }else{ ?> message <?php }; ?></span></a>
					<?php }?>											
				</div>
				<div id="bouttonForum">
					<a href="https://forum.lastimperium.com" target="_blank"><button class="ui-button ui-widget ui-corner-all">Forum</button></a>
				</div>		
				<div id="bouttonDev">
					<a href="https://dev.lastimperium.com" target="_blank"><button class="ui-button ui-widget ui-corner-all">Dev</button></a>
				</div>				
				<?php if(isset($_SESSION["joueur"])) {?>
				<div id="bouttonDeconnexion">
						<button onClick="deconnexion()" class="ui-button ui-widget ui-corner-all"></span><span class="ui-icon ui-icon-power"></span></span>Déconnexion</button>
				</div>
				<div id="bouttonAide">
					<a href="index.php?mod=aide"><button class="ui-button ui-widget ui-corner-all"></span>Aide</button></a>
				</div>
				<?php }?>
			</div>		
			
			<div class="logo">
				<a href="index.php?mod=index"><img src="template/<?php echo $TEMPLATE; ?>/images/logo2.png"/></a>
			</div>	
			<?php if(isset($_SESSION["joueur"])) {?>
			
						
				<div class="notifBat">
					<div style="width: 80%; margin: auto; margin-top: 10px; margin-bottom: 15px; height: 17px; position: relative;" id="progressbarbat"><div style="position: absolute; top: 3px; left:0; width:100%; height:100%; font-size: 11px; text-align: center;" id="infosBat">Aucun bâtiment en construction</div></div>
				</div>	
				
				<div class="notifUnit">
					<div style="width: 80%; margin: auto; margin-top: 10px; margin-bottom: 15px; height: 17px; position: relative;" id="progressbarunit"><div style="position: absolute; top: 3px; left:0; width:100%; height:100%; font-size: 11px; text-align: center;" id="infosUnite">Aucune unité en recrutement</div></div>
				</div>			

			<?php }?>
			<div class="townHautLayout"><img src="template/<?php echo $TEMPLATE; ?>/images/top/town.png"></div>
			<div class="mainLayout">	
			<?php if(isset($_SESSION["joueur"]))
				{
				?>
					<div class="menuBoucliers">	
												
							<img class="knight2" src="template/<?php echo $TEMPLATE; ?>/images/bottom/knight2.png">												
							<a href="index.php?mod=village">
							<div class="bouclierConstruction">
								<img class="imgBouclier hiddenMenu" src="template/<?php echo $TEMPLATE; ?>/images/redStripe.png">							
								<span class="txtBouclier hiddenMenu">Village</span>
							</div>	
							</a>
							<a href="index.php?mod=carte">
							<div class="bouclierCarte">
								<img class="imgBouclier hiddenMenu" src="template/<?php echo $TEMPLATE; ?>/images/redStripe.png">
								<span class="txtBouclier hiddenMenu">Carte</span>
							</div>	
							</a>
							<a href="index.php?mod=unites">
							<div class="bouclierArmee">
								<img class="imgBouclier hiddenMenu" src="template/<?php echo $TEMPLATE; ?>/images/redStripe.png">
								<span class="txtBouclier hiddenMenu">Armée</span>
							</div>
							</a>
							<div class="bouclierHeros">
								<img class="imgBouclier hiddenMenu" src="template/<?php echo $TEMPLATE; ?>/images/redStripe.png">
								<span class="txtBouclier hiddenMenu">Héros</span>
							</div>
							<div class="bouclierMarche">
								<img class="imgBouclier hiddenMenu" src="template/<?php echo $TEMPLATE; ?>/images/redStripe.png">
								<span class="txtBouclier hiddenMenu">Marché</span>
							</div>
							<div class="bouclierAlliance">
								<img class="imgBouclier hiddenMenu" src="template/<?php echo $TEMPLATE; ?>/images/redStripe.png">
								<span class="txtBouclier hiddenMenu">Alliance</span>
							</div>
							<div class="bouclierProfil">
								<img class="imgBouclier hiddenMenu" src="template/<?php echo $TEMPLATE; ?>/images/redStripe.png">
								<span class="txtBouclier hiddenMenu">Profil</span>
							</div>
							<div class="versionMenu">
								<?php echo $VERSION; ?>
							</div>
						</div>
					<?php } ?>
				<div class="bordureHorHaut"></div>
				<div class="rubanHautLayout"><img src="template/<?php echo $TEMPLATE; ?>/images/rubanPrinc.png"></div>
				<?php if(isset($_SESSION["joueur"])) {?>			
				<div class="selectVillageLayout">
					<select name="village" id="selectVillage">
						<?php
							foreach ($listVillagesJoueur as $villageList)
							{
								$selected = "";
								if($village->getVillageId() == $villageList["villageId"])
								{
									$selected = "selected";
								}															
								echo '<option '. $selected .' value="'. $villageList["villageId"] .'">'. $villageList["nom"] .'</option>';
								
							}
						?>
					</select>				
				</div>
				
			    <script>						
					$( "#selectVillage" ).selectmenu({
						width: 150
					});
					
					$('#selectVillage').on('selectmenuchange', function() {						
							var villageId = this.value;
							var xhrConnexion = new XMLHttpRequest();
							
							xhrConnexion.open('POST', 'utils/changeVillage.php');
							xhrConnexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
							xhrConnexion.send('villageId=' + villageId);
							
							xhrConnexion.addEventListener('readystatechange', function() {

							if (xhrConnexion.readyState === XMLHttpRequest.DONE && xhrConnexion.status === 200) {
								
								if(xhrConnexion.responseText == 0)
								{
									document.location.href="index.php";
								}
							}

							});
					});
				</script>
				
				
				
				<?php } ?>
				<div class="bordureHorBas"></div>					
				<div class="bordureVerGauche"></div>					
				<div class="bordureVerDroite"></div>	
				<div class="angleBordureHautGauche"></div>
				<div class="angleBordureHautDroit"></div>
				<div class="angleBordureBasGauche"></div>
				<div class="angleBordureBasDroit"></div>
				
						<?php if(isset($_SESSION["joueur"])) {
							
							$constrAutorise = true;
							
							if(count($listBatEnConstr) > 0)
							{
								$constrAutorise = false;
								$tempsFinBat = $listBatEnConstr[0][3] + $listBatEnConstr[0][2];
								$tempsRestBat = $tempsFinBat - time();
								$pourcTpsRestBat = ($tempsRestBat / $listBatEnConstr[0][2]) * 100;
							}	

							$recrutAutorise = true;
							
							if(count($listUnitEnRecrut) > 0)
							{
								$recrutAutorise = false;
								$tempsFinUnite = ($UNITES[$listUnitEnRecrut[0][1]]["cout"]["temps"] * $listUnitEnRecrut[0][2]) + $listUnitEnRecrut[0][3];
								$tempsRestUnite = $tempsFinUnite - time();
								$pourcTpsRestUnite = ($tempsRestUnite / ($UNITES[$listUnitEnRecrut[0][1]]["cout"]["temps"] * $listUnitEnRecrut[0][2])) * 100;
							}	
							
							?>											
						
						
						<?php }?>
				
				<?php
	if(count($listBatEnConstr) > 0)
	{
		?>
		<script>
			var tpsConstructionBat = <?php echo $listBatEnConstr[0][2]; ?>;
			var tpsDebBat = <?php echo $listBatEnConstr[0][3]; ?>;
			var batEnConstruction = "<?php echo $listBatEnConstr[0][1]; ?>";
			
			var tempsFinBat = tpsDebBat + tpsConstructionBat;
			
			var maintenant = new Date().getTime() / 1000;
			
			var tempsRestBat = tempsFinBat - maintenant;

			var pourcTpsRestBat = (tempsRestBat / tpsConstructionBat) * 100;
			
			var infosBat = document.getElementById("infosBat").innerHTML = batEnConstruction + " - " + pourcTpsRestBat;
			
			
			
			function majTempsConstr()
			{
				
				var maintenant = new Date().getTime() / 1000;
			
				var tempsRestBat = tempsFinBat - maintenant;
			
				var txtTpsRestBat = new Date(tempsRestBat * 1000).toISOString().substr(11, 8);
				
				if(tempsRestBat <= 0)
				{
					enReload = true;
					location.reload();
				}
				else
				{
					var infosBat = document.getElementById("infosBat").innerHTML = batEnConstruction + " - " + txtTpsRestBat;
					
					var pourcTpsRestBat = Math.round((tempsRestBat / tpsConstructionBat) * 100);
				
					$( function() {
					$( "#progressbarbat" ).progressbar({
					  value: 100 - pourcTpsRestBat
					});
				  } );
					
				}
				
				
				
			}
</script>

			<?php
	}
	else	
	{
		?>
		<script>
			$( function() {
					$( "#progressbarbat" ).progressbar({
					  value: 0
					});
				  } );		
		</script>
		
		<?php
		
	}
	
	if(count($listUnitEnRecrut) > 0)
	{
		?>
<script>
			var tpsRecrutUnite = <?php echo ($UNITES[$listUnitEnRecrut[0][1]]["cout"]["temps"] * $listUnitEnRecrut[0][2]) ?>;
			var tpsDebUnite = <?php echo $listUnitEnRecrut[0][3]; ?>;
			var uniteEnRecrut = "(<?php echo $listUnitEnRecrut[0][2]; ?>)" + " <?php echo $UNITES[$listUnitEnRecrut[0][1]]["nom"]; ?>";
			
			var tempsFinUnite = tpsDebUnite + tpsRecrutUnite;
			
			var maintenant = new Date().getTime() / 1000;
			
			var tempsRestUnite = tempsFinUnite - maintenant;

			var pourcTpsRestUnite = (tempsRestUnite / tpsRecrutUnite) * 100;
			
			var infosBat = document.getElementById("infosUnite").innerHTML = uniteEnRecrut + " - " + pourcTpsRestUnite;
			
			function majTempsRecrut()
			{
				
				var maintenant = new Date().getTime() / 1000;
			
				var tempsRestUnite = tempsFinUnite - maintenant;
			
				var txtTpsRestUnite = new Date(tempsRestUnite * 1000).toISOString().substr(11, 8);
				
				if(tempsRestUnite <= 0)
				{
					enReload = true;
					location.reload();
				}
				else
				{
					var infosBat = document.getElementById("infosUnite").innerHTML = uniteEnRecrut + " - " + txtTpsRestUnite;
				
					var pourcTpsRestUnite = Math.round((tempsRestUnite / tpsRecrutUnite) * 100);
				
					$( function() {
					$( "#progressbarunit" ).progressbar({
					  value: 100 - pourcTpsRestUnite
					});
				  } );
				}
				
				
			}
			
</script>
		<?php
			}
			else	
		{
		?>
		<script>
			$( function() {
					$( "#progressbarunit" ).progressbar({
					  value: 0
					});
				  } );		
		</script>
		
		<?php
		
	}	
			if(count($listUnitEnRecrut) > 0 || count($listBatEnConstr) > 0)
			{
		?>
		<?php if(!$constrAutorise) { ?>
		<script>
			constrAutorise = false;
		</script>
		
		<?php } ?>
		
		<?php if(!$recrutAutorise) { ?>
		<script>
			recrutAutorise = false;
		</script>
		
		<?php } ?>

		<script>
			
			
			
			function majTemps()
			{
				if(!constrAutorise)
					majTempsConstr();
				
				if(!recrutAutorise)
					majTempsRecrut();				
				
				if(!enReload)
					setTimeout(majTemps, 1000);
			}
			
				 
			majTemps();
		</script>
		<?php
			}
		?>
	
				
				<div class="include">
					<?php if($MAINTENANCE){
						?>
						<div class="ui-widget">
							<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
								<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
								<strong>Attention ! </strong> Jeu en maintenance, consultez le forum ou la partie Dev pour plus d'infos !</p>
							</div>
						</div>			
					<?php } ?>
					
					<div style="font-size: 13px; text-align: center; display:block; margin-top:10px;" id="msgInfos">
						<div class="ui-widget">
							<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
								<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
								<p id='msgInfosTxt'><b>Last imperium</b> est en cours de <b>développement</b> ! Des bugs et remises à zéro sont à prévoir !</p>
							</div>
						</div>
					</div>
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
		<div class="footer">
			lastimperium.com &copy;2017 <?php echo $VERSION; ?> - <a id="lienCguFooter" href="index.php?mod=cgu" target="_blank"><u>CGU</u></a>
		</div>
	</body>
</html>