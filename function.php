<?php
	//Marche bien
	function CreeEtPeuple()
	{
	 	global $c;
		global $table;

	 	$str = "(ligne int(2), ";
	 	$f = array('A','B','C','D','E','F','G','H','I','J');
	 	$s = count($f);

	 	for($i = 0; $i < $s ; $i++)
	 	{
	 		$str .= $f[$i] ." varchar(2) NULL";
	 		if ($i == $s-1)
	 		{
	 			$str .= ")";
	 			break;
	 		}else{
	 			$str .= ", ";
	 		}
	 	}
	 	$q = "CREATE TABLE " . $table . $str;
	 	echo $q . "<br/>";
	 	mysqli_query($c, $q);

	 	$str = "";
	 	for($i = 1; $i <= $s; $i++)
	 	{
	 		$str .= "(" . $i . ")";
	 		if ($i == $s)
	 		{
	 			break;
	 		}else{
	 			$str .= ", ";
	 		}
	 	}

	 	$q = "INSERT INTO $table (ligne) VALUES " . $str;
	 	echo $q . ";<br/>";
	 	mysqli_query($c, $q);
	}


	//Pas ouf
	 function affiche()
	 {
	 	global $c;
	 	global $table;

	 	$a = "<table border='1' >";

	 	$e = "";
	 	$t = "";
	 	$nba = 0;
	 	
	 	$q = "SELECT * FROM " . $table ;
	 	echo $q . ";\n";

	 	$r = mysqli_query($c, $q);
	 	
	 	while ($f = mysqli_fetch_field($r))
	 	{
	 		$e .= "<td>" . $f->name . "</td>";
	 		$nba++;
	 	}
	 	
	 	$a .= "<thead>";
	 	$a .= "<tr>$e</tr>";
	 	$a .= "<tbody>";

	 	while($n = mysqli_fetch_array($r))
	 	{
	 		$e = "";
	 		for($i = 0; $i < $nba ; $i++)
	 		{
	 			$e .= "<td>" . $n[$i] . "</td>";
	 		}
	 		$t .= "<tr>$e</tr>";
	 	}
	 	$a .= $t;
	 	$a .= "</tbody>";
	 	$a .= "</table>";
	 	
	 	echo $a;
	 	return $a;
	 }


	 function verifie($x, $y)
	 {
	 	return (($x >= 0) && ($x < 10) && ($y > 0) && ($y < 11));
	 }


	 function placeBateau($t, $s, $x, $y)
	 {
	 	global $c;
	 	global $table;

	 	$str = "";
	 	$cx = ord($x) - ord('A'); //Ord permet de retourner le code ASCII

	 	if (($s == 'h') && (verifie($cx + $t, $y)))
	 	{
	 		for ($i = 0; $i < $t; $i++)
	 		{
	 			$str .= chr(ord($x) + $i) . " = '*'";
	 			if ($i == $t-1)
	 			{
	 				break;
	 			}
	 			$str .= ", ";
	 		}
	 		$q = "UPDATE $table SET ". $str . " WHERE ligne = " . $y . ";";
	 		echo $q;

	 		mysqli_query($c, $q);
	 	}elseif (($s == "v") && (verifie($cx, $y + $t)))
	 	{
	 		$str = "(";
	 		for($j = 0; $j < $t; $j++)
	 		{
	 			$str .= $y + $j;
	 			if($j == $t-1)
	 			{
	 				$str .= ")";
	 				break;
	 			}
	 			$str .= ", ";
	 		}
	 		$q = "UPDATE $table SET ". $x ." = '*' WHERE ligne IN " . $str . ";";
	 		echo $q;

	 		mysqli_query($c, $q);
	 	}else{
	 		echo ("Position impossible !");
	 	}
	 }

	 function tireBateau($x, $y)
	 {
	 	global $c;
	 	global $table;

		//Bug à partir d'ici. peut etre acceder a la abse de donnée avant
		/*
	 	$q1 = "SELECT CASE WHEN " .$x " IS NULL THEN 'Plouf' ELSE 'Touché' END AS result FROM $table WHERE ligne = " . $y . ";";	 	
	 	$q2 = "";

	 	echo $q1 . ";<br/>";
	 	
	 	$r1 = mysqli_query($c, $q1);
	 	if($d = mysqli_fetch_assoc($r1))
	 	{
	 		if ($d["result"] == 'Plouf')
	 		{
	 			$q2 = "UPDATE $table SET ". $x ." = 'P' WHERE ligne = " . $y;
	 		}else{
	 			$q2 = "UPDATE $table SET ". $x ." = 'T' WHERE ligne = " . $y;
	 		}
	 	}
	 	echo $q2;
	 	mysqli_query($c, $q2);*/
	 }
?>



