<?php

	$business = new indexBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	

?>

<div class="patchNoteTitre">
	 Patch notes
</div>

<div class="patchNoteLayout">

	<div class="patchNoteRelease">
		<?php echo $VERSION;?>
	</div>
	
	<div class="patchNoteDate">
		le 20/03/2017 23:47
	</div>
	
	<div class="patchNoteInfos">
		<h4>Terminé : </h4>
		<ul>
			<li>Structure, framework du jeu terminé.</li>
			<li>Module patchnotes implémenté.</li>
			<li>Module de connexion/inscription terminé.</li>
			<li>Gestion des ressources terminée.</li>
			<li>Module carte du vilage implémenté.</li>
			<li>Gestion des villages terminée.</li>
			<li>Gestion des combats implémentés.</li>
			<li>Serveur de jeu implémenté et tourne h24 sur un vps.</li>
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
			<li>Ajout de bâtiments.</li>
			<li>Module de messagerie.</li>
			<li>Amélioration du système de rapport de combat.</li>
			<li>Correction d'un bug sur la carte.</li>
		</ul>
		
		<h4>Nouveauté : </h4>
		<ul>
			<li>Correction carte.</li>		
		</ul>
	</div>
</div>