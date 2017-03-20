<?php

	$business = new armeeBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
	$listAttaquesEnt = $bdd->query("SELECT * FROM deplacement WHERE idVillageDest=". $village->getVillageId() ." AND type='combat'");

?>

<table class="recapUnite">
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

</table>

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
			$lienVillage = "index.php?mod=infosVillage&id=". $villageOri['idVillageOri'];
	?>
				<tr>
					<td><?php echo $villageOri["nom"];?></td>
					<td><?php echo gmdate("H:i:s", $attaqueEnt["tpsArrive"] - time());?></td>
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
			$villageDest = $bdd->query('SELECT * FROM village WHERE villageId = '. $attaqueSor['idVillageDest']);
			$villageDest = $villageDest->fetch();
			$lienVillage = "index.php?mod=infosVillage&id=". $villageDest['idVillageDest'];
	?>
				<tr>
					<td><?php echo $villageDest["nom"];?></td>
					<td><?php echo gmdate("H:i:s", $attaqueSor["tpsArrive"] - time());?></td>
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
				<td colspan="11">Rien à voir</td>
			</tr>
			<?php
		}
	?>
	
</table>

<?php
	$listRetour = $bdd->query("SELECT * FROM deplacement WHERE idVillageDest=". $village->getVillageId() ." AND type='retourPillage'");
?>
<div class="layoutTitreArmee">
	Retour de combat
</div>

<table class="recapRetourCombat">
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
		<th>
			<img width="15px" id="tooltip" title="Bois" src="template/<?php echo $TEMPLATE; ?>/images/ressources/wood.png">
		</th>
		<th>
			<img width="15px" id="tooltip" title="Pierre" src="template/<?php echo $TEMPLATE; ?>/images/ressources/stone.png">
		</th>
		<th>
			<img width="15px" id="tooltip" title="Metal" src="template/<?php echo $TEMPLATE; ?>/images/ressources/iron.png">
		</th>
	</tr>
	
	<?php
	if($listRetour->rowCount() > 0)
	{
		while($retour = $listRetour->fetch())
		{
			$villageOri = $bdd->query('SELECT * FROM village WHERE villageId = '. $retour['idVillageOri']);
			$villageOri = $villageOri->fetch();
			$lienVillage = "index.php?mod=infosVillage&id=". $villageOri['idVillageDest'];
	?>
				<tr>
					<td><?php echo $villageOri['nom']; ?></td>
					<td><?php echo gmdate("H:i:s", $retour["tpsArrive"] - time());?></td>
					<td><?php echo $retour['paysans']; ?></td>
					<td><?php echo $retour['lancePierre']; ?></td>
					<td><?php echo $retour['guerrier']; ?></td>
					<td><?php echo $retour['archer']; ?></td>
					<td><?php echo $retour['hache']; ?></td>
					<td><?php echo $retour['piquier']; ?></td>
					<td><?php echo $retour['hommeDeMain']; ?></td>
					<td><?php echo $retour['chevalier']; ?></td>
					<td><?php echo $retour['catapulte']; ?></td>
					<td><?php echo $retour['bois']; ?></td>
					<td><?php echo $retour['pierre']; ?></td>
					<td><?php echo $retour['metal']; ?></td>
				</tr>


	<?php
			}
		}
		else
		{
			?>
			<tr>
				<td colspan="14">Rien à voir</td>
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