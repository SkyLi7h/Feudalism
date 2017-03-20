<?php

	$business = new accueilBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
?>
	<div style="font-size: 14px; text-align: center; display: none;" id="msgInfosIns">
		<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				<p id='msgInfosTxtIns'></p>
			</div>
		</div>
	</div>
	<div style="font-size: 13px; text-align: center;" class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 0px; padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				Le jeu a été remis à zéro !</p>
			</div>
		</div>	
			<?php if($INSCRIPTIONFERMEE){?> 
		
		<div style="font-size: 13px; text-align: center;" class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 0px; padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
				Les inscriptions sont actuellement fermées.</p>
			</div>
		</div>		
		
		<?php } ?>
		
		<div id="slogan">Bâtissez, recrutez et dominez !</div>
<div class="layoutAccueil">
	<div class="layoutAccueilGauche">
		<div class="layoutTitre"><span>Connexion</span></div>
		<form class="formConnexion" method="POST" action="javascript:void(0);" onSubmit="connexionAjax()">
			<p id="tooltip"><input placeholder="Pseudo" title="Votre pseudo" placeholder id="pseudo" type="text" name="pseudo" /></p>
			<br />
			<p id="tooltip"><input placeholder="Mot de passe" title="Votre mot de passe" type="password" name="pass" id="pass" /></p>
			<br />
			<button <?php if($MAINTENANCE){?> disabled <?php } ?>  onclick="connexionAjax()" class="ui-button ui-widget ui-corner-all"><span class="ui-icon ui-icon-unlocked"></span>Se connecter</button>
		</form>
	</div>
	<div class="layoutAccueilDroite">
		<div class="layoutTitre"><span>Inscription</span></div>
		<form class="formInscription" method="POST" action="javascript:void(0);">
			<p id="tooltip"><input placeholder="Pseudo" title="Votre pseudo" id="pseudoInsc" type="text" name="pseudoInsc" /></p>
			<br />
			<p id="tooltip"><input placeholder="Mot de passe" title="Votre mot de passe" type="password" name="passInsc" id="passInsc" /></p>
			<br />
			<p id="tooltip"><input placeholder="Mot de passe" title="Confirmez votre mot de passe" type="password" name="passConfInsc" id="passConfInsc" /></p>
			<br />
			<p id="tooltip"><input placeholder="E-mail" title="Votre email" type="email" name="mailInsc" id="mailInsc" /></p>
			<br />
			<p id="tooltip"><input title="Accepter les conditions" type="checkbox" name="cguInsc" id="cguInsc"><span><a id="lienCgu" href="index.php?mod=cgu" target="_blank"><u>CGU</u></a></span></p>		
			<!-- <p id="tooltip"><select title="Choisissez votre faction" name="race" id="race">
			  <option selected="selected">Humain</option>
			  <option>Elfe</option>
			  <option>Orc</option>
			</select></p>
			<br /> -->
			<button <?php if($MAINTENANCE || $INSCRIPTIONFERMEE){?> disabled <?php } ?> onclick="inscriptionAjax()" id="bouttonInscription" class="ui-button ui-widget ui-corner-all"><span class="ui-icon ui-icon-bullet"></span>S'inscrire<span class="ui-icon ui-icon-bullet"></span></button>
		</form>
	</div>
</div>

<script>
	
	$( "#race" ).selectmenu({
  width: 150
});
  
	function callback() {
		setTimeout(function() {$( "#msgInfosIns" ).hide( "blind");}, 2000);    
    };


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
			
			if(xhrConnexion.responseText == 0)
			{
				document.location.href="index.php";
			}
			else if(xhrConnexion.responseText == "1")
			{
				document.getElementById("msgInfosTxtIns").innerHTML = "Login incorrects !";
				var options = {};
				$( "#msgInfosIns" ).show( "fade", options, 1500, callback );
			}

        }

		});
	}
	
	function inscriptionAjax()
	{
		
		if(document.getElementById("cguInsc").checked)
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
					document.getElementById("msgInfosTxtIns").innerHTML = "Inscription réussie ! Vous pouvez vous connecter !";
					var options = {};
					$( "#msgInfosIns" ).show( "fade", options, 1500, callback );
				}
				
				if(xhrInscription.responseText == "1")
				{
					document.getElementById("msgInfosTxtIns").innerHTML = "Ce joueur existe déjà !";
					var options = {};
					$( "#msgInfosIns" ).show( "fade", options, 1500, callback );
				}
				
				if(xhrInscription.responseText == "2")
				{
					document.getElementById("msgInfosTxtIns").innerHTML = "Vos mots de passe ne correspondent pas !";
					var options = {};
					$( "#msgInfosIns" ).show( "fade", options, 1500, callback );
				}
				
				if(xhrInscription.responseText == "3")
				{
					document.getElementById("msgInfosTxtIns").innerHTML = "Votre pseudo doit être compris entre 5 et 20 caractères !";
					var options = {};
					$( "#msgInfosIns" ).show( "fade", options, 1500, callback );
				}
				
				if(xhrInscription.responseText == "4")
				{
					document.getElementById("msgInfosTxtIns").innerHTML = "Votre mot de passe doit être compris entre 5 et 20 caractères !";
					var options = {};
					$( "#msgInfosIns" ).show( "fade", options, 1500, callback );
				}
				
				if(xhrInscription.responseText == "5")
				{
					document.getElementById("msgInfosTxtIns").innerHTML = "Mail invalide !";
					var options = {};
					$( "#msgInfosIns" ).show( "fade", options, 1500, callback );
				}

			}

			});
		
		}
		else
		{
			document.getElementById("msgInfosTxtIns").innerHTML = "Confirmez les CGU si vous souhaitez jouer !";
			var options = {};
			$( "#msgInfosIns" ).show( "fade", options, 1500, callback );		
		}
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

			