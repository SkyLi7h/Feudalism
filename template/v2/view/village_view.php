<?php

	$business = new villageBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
?>

<div class="layoutVillage">

	<div class="chateau">
		<a href="index.php?mod=batiments">
			<div class="batVillageContent">
				<div class="niveauBatCarte">
					<?php echo $village->getChateau(); ?>
				</div>
			</div>
		</a>
	</div>
	
	<div class="caserne">
		<a href="index.php?mod=unites">
			<div class="batVillageContent">
				<div class="niveauBatCarte">
					<?php echo $village->getCaserne(); ?>
				</div>
			</div>
		</a>
	</div>
	
	<div class="mine">
		<a href="index.php?mod=batiments">
			<div class="batVillageContent">
				<div class="niveauBatCarte">
					<?php echo $village->getMine(); ?>
				</div>
			</div>
		</a>
	</div>

	<div class="scierie">
		<a href="index.php?mod=batiments">
			<div class="batVillageContent">
				<div class="niveauBatCarte">
					<?php echo $village->getScierie(); ?>
				</div>
			</div>
		</a>
	</div>
	
	<div class="carriere">
		<a href="index.php?mod=batiments">
			<div class="batVillageContent">
				<div class="niveauBatCarte">
					<?php echo $village->getCarriere(); ?>
				</div>
			</div>
		</a>
	</div>
	<?php echo '<img style="margin-left: -20px;" src="template/'. $TEMPLATE .'/images/mapVillage.png">'; ?>

</div>






