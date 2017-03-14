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
		VDev 0.2
	</div>
	
	<div class="patchNoteDate">
		le 14/03/2017 10:40
	</div>
	
	<div class="patchNoteInfos">
		<h4>Terminé : </h4>
		<ul>
			<li>Structure, framework du jeu terminé.</li>
			<li>Module patchnotes implémenté.</li>
			<li>Module de connexion/inscription terminé.</li>
			<li>Gestion des ressources terminée.</li>
			<li>Gestion des villages terminée.</li>
			<li>Les bâtiments :
				<ul>
					<li>Gestion de la construction des bâtiments terminée.</li>
					<li>Bâtiments ressources implémentés.</li>
					<li>Bâtiment caserne implémenté.</li>
					<li>Bâtiment Chateau implémenté.</li>
				</ul>		
			</li>	
			<li>Les unités :
				<ul>
					<li>Gestion du recrutement des unités terminée.</li>
					<li>Pré-requis pour les unités terminés.</li>
					<li>Toutes les unités ajoutées.</li>
				</ul>		
			</li>	
			<li>La carte :
					<ul>
						<li>Gestion de la carte terminée.</li>
						<li>Déplacement sur la carte terminée.</li>
					</ul>		
			</li>
		</ul>
		
		<h4>Actuellement en dev : </h4>
		<ul>
			<li>Améliorations, corrections et ajouts au template.</li>
			<li>Module de déplacement des unités. (85%)</li>
			<li>Module de combat. (70%)</li>			
			<li>Ajout de bâtiments.</li>
			<li>Amélioration du serveur de jeu en backend (gérer déplacements, combats, ...) </li>
		</ul>
		
		<h4>Nouveauté : </h4>
		<ul>
			<li>Ajout d'unités.</li>
			<li>Déplacement sur la carte implémenté.</li>
			<li>Gestion des villages ( possibilité d'en posséder plusieurs ) implémentée.</li>
			<li>Création du serveur de jeu backend.</li>
		</ul>
	</div>
</div>
</div>