<?php

	$business = new accueilBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
?>
	<div id="msgErreurLogin">
		<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				<p>Login incorrects !</p>
			</div>
		</div>
	</div>
<div style="text-align: center; width: 80%; min-height:75px; margin: auto; margin-top: 10px; padding: 1.2em; font: 14px 'Trajan', Sans-Serif;" class="ui-widget ui-front ui-widget-content ui-corner-all ui-widget-shadow">
		<img width="110px;" style="float: left; margin-top: -17px; margin-left:-16px; margin-right: 15px;" align="top" src="template/<?php echo $TEMPLATE; ?>/images/conseilF.png"> 
<span><i>Last Imperium</i> est en cours de développement. N'hésite pas à t'inscrire sur le <span style="color: yellow;"><i>forum</i></span> et à consulter le lien <span style="color: yellow;"><i>"dev"</i></span> pour te tenir informé des avancements ! A bientôt sur <span style="color: red;"><i>l'alpha</i></span> !</span>
</div>
<div class="layoutAccueil">
	<div class="layoutAccueilGauche">
		<div class="layoutTitre"><span>Connexion</span></div>
		<form class="formConnexion" method="POST" action="javascript:void(0);" onSubmit="connexionAjax()">
			<p id="tooltip"><a href="#" title="Votre pseudo"><input placeholder id="pseudo" type="text" name="pseudo" /></a></p>
			<br />
			<p id="tooltip"><a href="#" title="Votre mot de passe"><input type="password" name="pass" id="pass" /></a></p>
			<br />
			<button <?php if($MAINTENANCE){?> disabled <?php } ?>  onclick="connexionAjax()" class="ui-button ui-widget ui-corner-all"><span class="ui-icon ui-icon-unlocked"></span>Se connecter</button>
		</form>
	</div>
	<div class="layoutAccueilDroite">
		<div class="layoutTitre"><span>Inscription</span></div>
		<form class="formInscription" method="POST" action="javascript:void(0);">
			<p id="tooltip"><a href="#" title="Votre pseudo"><input pattern="[a-zA-Z0-9]+" id="pseudoInsc" type="text" name="pseudoInsc" /></a></p>
			<br />
			<p id="tooltip"><a href="#" title="Votre mot de passe"><input type="password" name="passInsc" id="passInsc" /></a></p>
			<br />
			<p id="tooltip"><a href="#" title="Confirmez votre mot de passe"><input type="password" name="passConfInsc" id="passConfInsc" /></a></p>
			<br />
			<p id="tooltip"><a href="#" title="Votre email"><input type="email" name="mailInsc" id="mailInsc" /></a></p>
			<br />
			<button  onclick="inscriptionAjax()" id="bouttonInscription" class="ui-button ui-widget ui-corner-all"><span class="ui-icon ui-icon-bullet"></span>S'inscrire<span class="ui-icon ui-icon-bullet"></span></button>
		</form>
	</div>
</div>

<script>
	function connexionAjax()
	{
		var pseudo = document.getElementById("pseudo").value;
		var pass = document.getElementById("pass").value;
		var xhrConnexion = new XMLHttpRequest();
		
		xhrConnexion.open('POST', 'utils/connexion.php');
		xhrConnexion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhrConnexion.send('pseudo=' + pseudo + '&pass=' + pass);
		
		xhrConnexion.addEventListener('readystatechange', function() {

        if (xhrConnexion.readyState === XMLHttpRequest.DONE && xhrConnexion.status === 200) {

			console.log(xhrConnexion.responseText);
			if(xhrConnexion.responseText == 0)
			{
				document.location.href="index.php";
			}
			else if(xhrConnexion.responseText == "1")
			{
				document.getElementById("msgErreurLogin").style = "display: block;";
			}

        }

		});
	}
	
	function inscriptionAjax()
	{
		var pseudoInsc = document.getElementById("pseudoInsc").value;
		var passInsc = document.getElementById("passInsc").value;
		var passConfInsc = document.getElementById("passConfInsc").value;
		var mailInsc = document.getElementById("mailInsc").value;
		var xhrInscription = new XMLHttpRequest();
		
		xhrInscription.open('POST', 'utils/inscription.php');
		xhrInscription.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhrInscription.send('pseudo=' + pseudoInsc + '&pass=' + passInsc + '&passConf=' + passConfInsc + '&mail=' + mailInsc);
		
		xhrInscription.addEventListener('readystatechange', function() {

        if (xhrInscription.readyState === XMLHttpRequest.DONE && xhrInscription.status === 200) {
			if(xhrInscription.responseText == "0")
			{
				
			}

        }

		});
	}
	
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

			