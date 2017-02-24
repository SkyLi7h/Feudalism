<?php

	$business = new accueilBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
?>
<div class="layoutAccueil">
	<div class="layoutAccueilGauche">
		<div class="layoutTitre"><span>Connexion</span></div>
		<form class="formConnexion" method="POST" action="javascript:void(0);" onSubmit="connexionAjax()">
			<p id="tooltip"><a href="#" title="Votre pseudo"><input pattern="[a-zA-Z0-9]+" placeholder id="pseudo" type="text" name="pseudo" /></a></p>
			<br />
			<p id="tooltip"><a href="#" title="Votre mot de passe"><input pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" type="password" name="pass" id="pass" /></a></p>
			<br />
			<button <?php if($MAINTENANCE){?> disabled <?php } ?>  onclick="connexionAjax()" class="ui-button ui-widget ui-corner-all"><span class="ui-icon ui-icon-unlocked"></span>Se connecter</button>
		</form>
	<div style="width: 80%; margin: auto; margin-top: 20px; padding: 1.2em; font: 14px 'Trajan', Sans-Serif;" class="ui-widget ui-front ui-widget-content ui-corner-all ui-widget-shadow">
		Bienvenue, mon Seigneur.<br> <i>Last Imperium</i> est en cours de développement.<br> N'hésite pas à t'inscrire sur le <span style="color: yellow;"><i>forum</i></span> et de consulter le lien <span style="color: yellow;"><i>"dev"</i></span> pour te tenir informé sur nos avancements ! A bientôt sur <span style="color: red;"><i>l'alpha</i></span> !
	</div>
	</div>
	<div class="layoutAccueilDroite">
		<div class="layoutTitre"><span>Inscription</span></div>
		<form class="formInscription" method="POST" action="javascript:void(0);" onSubmit="inscriptionAjax()">
			<p id="tooltip"><a href="#" title="Votre pseudo"><input pattern="[a-zA-Z0-9]+" id="pseudoInsc" type="text" name="pseudoInsc" /></a></p>
			<br />
			<p id="tooltip"><a href="#" title="Votre mot de passe"><input pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" type="password" name="passInsc" id="passInsc" /></a></p>
			<br />
			<p id="tooltip"><a href="#" title="Confirmez votre mot de passe"><input pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" type="password" name="passConfInsc" id="passConfInsc" /></a></p>
			<br />
			<p id="tooltip"><a href="#" title="Votre email"><input type="email" name="mailInsc" id="mailInsc" /></a></p>
			<br />
			<button disabled onclick="inscriptionAjax()" id="bouttonInscription" class="ui-button ui-widget ui-corner-all"><span class="ui-icon ui-icon-bullet"></span>S'inscrire<span class="ui-icon ui-icon-bullet"></span></button>
		</form>
	</div>
</div>

<script>
	function connexionAjax()
	{
		var pseudo = document.getElementById("pseudo").value;
		var pass = document.getElementById("pass").value;
		var xhr = new XMLHttpRequest();
		
		xhr.open('POST', 'utils/connexion.php');
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('pseudo=' + pseudo + '&pass=' + pass);
		
		xhr.addEventListener('readystatechange', function() {

        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

            console.log(xhr.responseText);
			if(xhr.responseText == "0")
			{
				document.location.href="index.php";
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

			