<?php

$u1Chance = (rand ( 90 , 110 ))/100;
$u2Chance = (rand ( 90 , 110 ))/100;


//ATTAQUANT
$u1Dp = 20*$u1Chance;
$u1Ds = 5*$u1Chance;
$u1Nb = 150;


//DEFENSEUR
$u2Dp = 20*$u2Chance;
$u2Ds = 5*$u2Chance;
$u2Nb = 130;

$ATCK = $u1Dp * $u1Nb;
$DEF = $u2Ds * $u2Nb;

echo "ATTAQUANT force : ". $ATCK . " <br>";
echo "DEFENSEUR force : ". $DEF . " <br>";

$ATCK -= $DEF;
$DEF -= $ATCK;


echo "ATTAQUANT restant : ". $ATCK . " <br>";
echo "DEFENSEUR restant : ". $DEF . " <br>";



?>