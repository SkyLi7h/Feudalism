<?php

	$business = new index();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
	$business->affichePseudo();

?>

<a href='../project/index.php?mod=test'>test</a>