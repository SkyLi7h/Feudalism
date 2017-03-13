<?php
if (! @include_once("config.php")) 
		throw new Exception ("config.php est introuvable !");

$bdd = new PDO('mysql:host='.$HOST.';dbname='.$DBNAME.';charset=utf8', $LOGIN, $PASS);

$run = false;
function runServ()
{
	GLOBAL $bdd, $UNITES, $run;
	$run = true;
	$listDeplacements = $bdd->query('SELECT * FROM deplacement');

	while($deplacement = $listDeplacements->fetch())
	{
			if($deplacement["type"] = "combat")
			{
				//Init
				$forceAttaquant = 0;
				$forceDefenseur = 0;
				
				$atkChance = (rand ( 90 , 110 ))/100;
				
				//Recup données du village défenseur
				$resultVillageDest = $bdd->query('SELECT * FROM village WHERE villageId=' . $deplacement["idVillageDest"]);
				$villageDest = $resultVillageDest->fetch();
				
				//Force de l'attaquant
				$forceAttaquant += $UNITES["Paysans"]["ATK"]  * $deplacement["paysans"];
				$forceAttaquant += $UNITES["Lance-pierre"]["ATK"]  * $deplacement["lancePierre"];
				$forceAttaquant += $UNITES["Guerrier"]["ATK"]  * $deplacement["guerrier"];
				$forceAttaquant += $UNITES["Archer"]["ATK"]  * $deplacement["archer"];
				$forceAttaquant += $UNITES["Hache"]["ATK"]  * $deplacement["hache"];
				$forceAttaquant += $UNITES["Piquier"]["ATK"]  * $deplacement["piquier"];
				$forceAttaquant += $UNITES["HommeDeMain"]["ATK"]  * $deplacement["hommeDeMain"];
				$forceAttaquant += $UNITES["Chevalier"]["ATK"]  * $deplacement["chevalier"];
				$forceAttaquant += $UNITES["Catapulte"]["ATK"]  * $deplacement["catapulte"];
				$forceAttaquant *= $atkChance;
				
				//Force du défenseur
				$forceDefenseur += $UNITES["Paysans"]["ATK"]  * $villageDest["paysans"];
				$forceDefenseur += $UNITES["Lance-pierre"]["ATK"]  * $villageDest["lancePierre"];
				$forceDefenseur += $UNITES["Guerrier"]["ATK"]  * $villageDest["guerrier"];
				$forceDefenseur += $UNITES["Archer"]["ATK"]  * $villageDest["archer"];
				$forceDefenseur += $UNITES["Hache"]["ATK"]  * $villageDest["hache"];
				$forceDefenseur += $UNITES["Piquier"]["ATK"]  * $villageDest["piquier"];
				$forceDefenseur += $UNITES["HommeDeMain"]["ATK"]  * $villageDest["hommeDeMain"];
				$forceDefenseur += $UNITES["Chevalier"]["ATK"]  * $villageDest["chevalier"];
				$forceDefenseur += $UNITES["Catapulte"]["ATK"]  * $villageDest["catapulte"];
				
				$combat = $forceAttaquant - $forceDefenseur;
				
				if($combat > 0)
				{
					echo "Attaquant gagne avec une force de " . $forceAttaquant;
				}
				else if($combat < 0)
				{
					echo "Defenseur gagne avec une force de " . $forceDefenseur;
				}
				else if($combat == 0)
				{
					echo "Egalite";
				}
				
			}								
	}
	
	$run = false;
	
}

while(1)
{		
	if(!$run)
		runServ();	
	sleep(1);
	flush();
	ob_flush();
}










?>