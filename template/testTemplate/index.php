<!doctype html>

<html lang="fr">
	<head>
	  <meta charset="utf-8">
	  <Title><?php echo $NAME_APPLICATION;?></Title>
	  <meta name="description" content="Feudalism template">
	  <meta name="author" content="Ferrer Lucas">
	  <link rel="stylesheet" type="text/css" href="template/<?php echo $TEMPLATE; ?>/style/style.css" media="screen" />
	</header>	
	<body>
	
		<body>
		<div class="hautLayout">
			
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
</html>