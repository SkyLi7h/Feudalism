<?php

	$business = new indexBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	

	$village = unserialize($_SESSION["village"]);

?>

<div class="patchNoteTitre">
	 Patch notes
</div>

<div class="patchNoteLayout">

	<div class="patchNoteRelease">
		VDev 0.1
	</div>
	
	<div class="patchNoteDate">
		le 10/03/2017 10:30
	</div>
	
	<div class="patchNoteInfos">
		<h4>Terminé : </h4>
		<ul>
			<li>Structure, framework du jeu terminé.</li>
			<li>Module de connexion/inscription terminé.</li>
			<li>Gestion des ressources terminée.</li>
			<li>Gestion de la construction des bâtiments terminée.</li>
			<li>Gestion du recrutement des unités terminée.</li>
			<li>Gestion de la carte terminée.</li>
		</ul>
		
		<h4>Actuellement en dev : </h4>
		<ul>
			<li>Améliorations, corrections et ajouts au template.</li>
			<li>Module de déplacement des unités.</li>
			<li>Module de combat.</li>
			<li>Amélioration du module de village (Possibilité d'avoir plusieurs villages).</li>
			<li>Ajout d'unités.</li>
			<li>Ajout de bâtiments.</li>
		</ul>
		
		<h4>Nouveauté : </h4>
		<ul>
			<li>Ajout du module de patch notes.</li>
			<li>Correction de bugs dans le module carte.</li>
			<li>Correction de bugs au niveau du template.</li>
		</ul>
	</div>
</div>