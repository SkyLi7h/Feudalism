<?php

	$business = new accueilBusiness();	
	if($DEBUG)
		$debug->show("Lancement de la view $viewClass avec en business $businessClass");	
	
?>

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
</script>

<form class="formConnexion" method="POST" action="javascript:void(0);" onSubmit="connexionAjax()">
	<label for="pseudo">Pseudo</label>
	<br />
	<input id="pseudo" placeholder="Ex : Imperium" type="text" name="pseudo" />
	<br />
    <label for="pass">Mot de passe</label> 
	<br />
	<input type="password" name="pass" id="pass" />
	<br />
	<button type="button" onclick="connexionAjax()">Se connecter</button>
</form>