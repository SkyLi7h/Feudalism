<?php

	$business = new indexBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	

	$village = unserialize($_SESSION["village"]);

?>
	<div style="font-size: 14px; text-align: center; display:block; margin-top:10px;" id="msgInfos">
		<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				<p id='msgInfosTxt'><b>Last imperium</b> est en cours de <b>développement</b> ! Des bugs et remises à zéro sont à prévoir !</p>
			</div>
		</div>
	</div>