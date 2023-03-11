<?php
session_start();
$_SESSION['pseudo'] = "Ded"; 
include('./connexion.php');

$_SESSION['numJoueur'] = '2';
$num = 2;
$requete = "INSERT INTO jouer(idPartie,pseudo,numJoueur) VALUES(:idPartie, :pseudo, :numJoueur)";
$stmt = $c->prepare($requete);
$stmt->bindParam(":idPartie",$_SESSION['id_partie']);
$stmt->bindParam(":pseudo",$_SESSION['pseudo']);
$stmt->bindParam(":numJoueur",$num);
$stmt->execute();