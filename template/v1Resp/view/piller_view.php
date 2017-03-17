<?php

	$business = new pillerBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
	$villageDest = $business->getVillage($_GET["id"]);
?>

<div class="titrePiller">Piller <?php echo $villageDest["nom"]; ?></div>
<table class="sendUnitPillage">
	<tr>
		<td>Unité :</td>
		<?php
			foreach ($UNITES as $unite)
				{
					echo '<td id="tooltip" title="'. $unite["nom"] .'"><img width="15px" src="template/'. $TEMPLATE .'/images/unites/'.$unite["img"].'"></td>';
				}
		?>
	</tr>
	<tr>
		<td>Nombre :</td>
		<?php
			foreach ($UNITES as $unite)
				{
					echo "<td>" . $village->GetNbByName($unite["nom"]) . "</td>";
				}
		?>
	</tr>
	<tr>
		<td>Envoyer :</td>
		<?php
			foreach ($UNITES as $unite)
				{
					echo "<td><input value='0' min='0' max='". $village->GetNbByName($unite["nom"]) ."' type='number' id='".$unite['nom']."'></input></td>";
				}
		?>
	</tr>

</table>

<center><button onclick="piller()" class="ui-button ui-widget ui-corner-all">Piller</button></center>

