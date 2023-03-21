<?php
	try
	{
		//$c = new PDO("mysql:host=localhost;dbname=womeni0","womeni","yx08PAhV");
		// $c = new PDO("mysql:host=localhost;dbname=kouam0","kouam","zGo3Zyl9");
		$c = new PDO("mysql:host=localhost;dbname=bataille","root","");

	}
	catch (PDOException $e)
	{
        echo "Erreur PDO : ".$e->getMessage()."<br/>";
        die();
		
	}