<?php

class carteBusiness
{	
	public function getCarte($x, $y)
	{
		global $bdd, $CARTEX, $CARTEY;
		
		$xMin = $x - 5;
		$xMax = $x + 6;
		$yMin = $y - 5;
		$yMax = $y + 6;
		
		if($xMin < 1)
		{
			$xMin = 1;
			$xMax = 11;
		}
		
		if($yMin < 1)
		{
			$yMin = 1;
			$yMax = 11;
		}
		
		if($xMax > $CARTEX)
		{
			$xMax = $CARTEX;
			$xMin = $CARTEX - 11;
		}
		
		if($yMax > $CARTEY)
		{
			$yMax = $CARTEY;
			$yMin = $CARTEY - 11;
		}

		$reponse = $bdd->query('SELECT * FROM carte WHERE x BETWEEN '. $xMin  .' AND '. $xMax  .' AND y BETWEEN '. $yMin  .' AND '. $yMax);
	
		return $reponse;
	}	
}





?>