<?php

	$business = new messageBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	

	$listMessages = $business->getAllMessages($joueur->getJoueurId());
?>
<table class="tableListMessages">
	<tr>
		<th><input type="checkbox" name="checkbox" id="checkbox"></th>
		<th>Date</th>
		<th>Expéditeur</th>
		<th>Sujet</th>
	</tr>

<?php
	if($listMessages)
	{
		while($message = $listMessages->fetch())
		{
			$joueurOri = $bdd->query('SELECT * FROM joueur WHERE joueurId = '. $message["joueurOri"]);
			$joueurOri = $joueurOri->fetch();
?>
		<a href="index.php?mod=openMessage&id=<?php echo $message['messageId']?>;"><tr <?php if($message["lu"]){?>class="ligneMessage"<?php }else { ?> class="ligneMessageGras" <?php } ?>>
			<td class="colAction"><input type="checkbox" name="checkbox" id="checkbox"></td>
			<td class="colDate"><?php echo date('d/m/Y H:i:s', $message["temps"]);?></td>
			<td class="colPseudo"><?php echo $joueurOri["pseudo"];?></td>
			<td class="colSujet"><?php echo $message["sujet"];?></td>
		</tr></a>


<?php
		}
	}
?>

</table>