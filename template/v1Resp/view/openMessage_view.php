<?php

	$business = new messageBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	

	$message = $business->getMessage($_GET["id"]);
	$business->setLu(1, $_GET["id"]);
	
	$joueurOri = $bdd->query('SELECT * FROM joueur WHERE joueurId = '. $message["joueurOri"]);
	$joueurOri = $joueurOri->fetch();
?>
<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<div id="sujetMessage"><?php echo $message["sujet"]; ?></div>
<div id="oriMessage"> de <?php echo $joueurOri["pseudo"];?> le <?php echo date('d/m/Y H:i:s', $message["temps"]);?></div>
<div id="messageViewLayout"><?php echo $message["sujet"];?></div>

<center>
	<textarea id="textAreaMsg"></textarea>
</center>