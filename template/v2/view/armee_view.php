<?php

	$business = new armeeBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
	$listAttaquesEnt = $bdd->query("SELECT * FROM deplacement WHERE idVillageDest=". $village->getVillageId() ." AND type='combat'");

?>

<div class="layoutTitreArmee">
	Attaques entrantres
</div>

<table class="recapAttaquesEntrantes">
	<tr>
		<th>
			Origine
		</th>
		<th>
			Arrive dans
		</th>
		<?php
			foreach ($UNITES as $unite)
				{
					echo '<th id="tooltip" title="'. $unite["nom"] .'"><img width="15px" src="template/'. $TEMPLATE .'/images/unites/'.$unite["img"].'"></th>';
				}
		?>
	</tr>
	
	<?php
	if($listAttaquesEnt->rowCount() > 0)
	{
		while($attaqueEnt = $listAttaquesEnt->fetch())
		{
			$villageOri = $bdd->query('SELECT * FROM village WHERE villageId = '. $attaqueEnt['idVillageOri']);
			$villageOri = $villageOri->fetch();
			$lienVillage = "index.php?mod=infosVillage&id=". $message['idVillageOri'];
	?>
				<tr>
					<td><?php echo $villageOri["nom"];?></td>
					<td><?php echo gmdate("H:i:s", time() - $attaqueEnt["tpsArrive"]);?></td>
					<td>??</td>
					<td>??</td>
					<td>??</td>
					<td>??</td>
					<td>??</td>
					<td>??</td>
					<td>??</td>
					<td>??</td>
					<td>??</td>
				</tr>


	<?php
			}
		}
		else
		{
			?>
			<tr>
				<td colspan="11">Rien à voir</td>
			</tr>
			<?php
		}
	?>
	
</table>


<?php
	$listAttaquesSor = $bdd->query("SELECT * FROM deplacement WHERE idVillageOri=". $village->getVillageId() ." AND type='combat'");
?>
<div class="layoutTitreArmee">
	Attaques sortantes
</div>

<table class="recapAttaquesSortantes">
	<tr>
		<th>
			Destination
		</th>
		<th>
			Arrive dans
		</th>
		<?php
			foreach ($UNITES as $unite)
				{
					echo '<th id="tooltip" title="'. $unite["nom"] .'"><img width="15px" src="template/'. $TEMPLATE .'/images/unites/'.$unite["img"].'"></th>';
				}
		?>
	</tr>
	
	<?php
	if($listAttaquesSor->rowCount() > 0)
	{
		while($attaqueSor = $listAttaquesSor->fetch())
		{
			$villageOri = $bdd->query('SELECT * FROM village WHERE villageId = '. $attaqueSor['idVillageDest']);
			$villageOri = $villageOri->fetch();
			$lienVillage = "index.php?mod=infosVillage&id=". $message['idVillageDest'];
	?>
				<tr>
					<td><?php echo $villageOri["nom"];?></td>
					<td><?php echo gmdate("H:i:s", time() - $attaqueSor["tpsArrive"]);?></td>
					<td><?php echo $attaqueSor['paysans']; ?></td>
					<td><?php echo $attaqueSor['lancePierre']; ?></td>
					<td><?php echo $attaqueSor['guerrier']; ?></td>
					<td><?php echo $attaqueSor['archer']; ?></td>
					<td><?php echo $attaqueSor['hache']; ?></td>
					<td><?php echo $attaqueSor['piquier']; ?></td>
					<td><?php echo $attaqueSor['hommeDeMain']; ?></td>
					<td><?php echo $attaqueSor['chevalier']; ?></td>
					<td><?php echo $attaqueSor['catapulte']; ?></td>
				</tr>


	<?php
			}
		}
		else
		{
			?>
			<tr>
				<td colspan="11">Rien à venir</td>
			</tr>
			<?php
		}
	?>
	
</table>


<script>
	$( function() {
				var tooltips = $( "[title]" ).tooltip({
				  position: {
					my: "left top",
					at: "right+5 top-5",
					collision: "none"
				  }
				});
			  } );

</script>