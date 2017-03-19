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
					echo '<td id="tooltip" title="'. str_replace(' ','',$unite["nom"]) .'"><img width="15px" src="template/'. $TEMPLATE .'/images/unites/'.$unite["img"].'"></td>';
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

<script>
	var villageDestId = <?php echo $_GET["id"]; ?>

	function piller()
	{
		var paysans = document.getElementById("Paysans").value;		
		var lancePierre = document.getElementById("Lance-pierre").value;
		var guerrier = document.getElementById("Guerrier").value;
		var archer = document.getElementById("Archer").value;
		var hache = document.getElementById("Hache").value;
		var piquier = document.getElementById("Piquier").value;
		var hommeDeMain = document.getElementById("Homme De Main").value;
		var chevalier = document.getElementById("Chevalier").value;
		var catapulte = document.getElementById("Catapulte").value;
		
		var xhrConnexion = new XMLHttpRequest();
		
		xhrConnexion.open('POST', 'utils/piller.php');
		xhrConnexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhrConnexion.send('paysans=' + paysans + '&lancePierre=' + lancePierre + '&guerrier=' + guerrier + '&archer=' + archer + '&hache=' + hache + '&piquier=' + piquier + '&hommeDeMain=' + hommeDeMain + '&chevalier=' + chevalier + '&catapulte=' + catapulte + '&villageDestId=' + villageDestId);
		
		xhrConnexion.addEventListener('readystatechange', function() {

        if (xhrConnexion.readyState === XMLHttpRequest.DONE && xhrConnexion.status === 200) {
			
			if(xhrConnexion.responseText == 0)
			{
				document.location.href="index.php?mod=index";
			}
			else
			{
				console.log(xhrConnexion.responseText);
			}

        }

		});
	}

</script>

