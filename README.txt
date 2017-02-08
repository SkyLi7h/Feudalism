///////Configuration///////

Consultez le fichier config.php � la racine !

///////CREATION DE MODULE///////

Pour cr�er un nouveau module, il vous faut cr�er une nouvelle view et une classe business qui s'y rapporte.
	-La view se situe dans le template utilis� dans le dossier "view".
	-La business se situe dans le dossier business � la racine du site.

\Attention/
	Le nom entre la vue et la business doivent �tre coh�rents !
		Exemple : view -> MonModule_view.php
			  business -> MonModule_business.php

View => Ne contient que le code pour l'affichage au sein du template.
Business => Une classe avec la logique utilis�e pour l'affichage au sein de la view

///////DAO///////

Ce dossier contient, par fichier PHP, une classe acc�dant � des donn�es sp�cifiques dans la base de donn�es.
Exemple:
	JoueurDAO.php -> Une classe avec m�thode ( get, set, del, .. ) acc�dant aux donn�es des joueurs dans la BDD.

///////Entity///////

Ce dossier contient tout les mod�les, c'est � dire les classes � partir desquels les objets pourront �tre instanci�s.

///////Organisation///////
Les fichiers DAO et Entity dont vous avez besoin ne doivent �tre appell�s que dans la business.
La view n'appelle que la classe business n�cessaire.

///////Ajouter un lien vers votre nouveau module///////
Le lien est simple -> <a href='../project/index.php?mod=MonModule'>MonModule</a> depuis une autre view.

