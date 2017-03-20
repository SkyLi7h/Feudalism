<?php

	$business = new mineBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
	
?>
<table class="recapGain">
	<tr>
		<th>Niveau :</th>
		<th>Gain :</th>
	</tr>
	<?php
			$lvl = 0;
			$bg = "";
			foreach ($BATIMENTS["Mine"]["gain"] as $gain)
				{
					if($lvl == $village->getMine())
					{
						$bg = 'style="background-color: orange"';
					}
					
					echo '<tr '. $bg .'><td>'. $lvl .'</td><td>'. $gain . ' <img width="15px" src="template/'. $TEMPLATE .'/images/ressources/iron.png"> / h</td></tr>';
					$lvl++;
					$bg = "";
				}
		?>

</table>
