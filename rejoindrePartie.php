<?php
session_start();
$_SESSION['pseudo'] = "Ded"; 
include('./connexion.php');

$requete = "SELECT * FROM jouer WHERE idPartie = :idPartie AND pseudo = :pseudo";
$stmt = $c->prepare($requete);
$stmt->bindParam(":idPartie",$_POST['id']);
$stmt->bindParam(":pseudo",$_SESSION['pseudo']);
$stmt->execute();
$tab = $stmt->fetch();
if(!empty($tab)){
    $_SESSION['numJoueur'] = $tab['numJoueur'];
}else{
    $_SESSION['numJoueur'] = '2';
    $num = 2;
    $requete = "INSERT INTO jouer(idPartie,pseudo,numJoueur) VALUES(:idPartie, :pseudo, :numJoueur)";
    $stmt = $c->prepare($requete);
    $stmt->bindParam(":idPartie",$_POST['id']);
    $stmt->bindParam(":pseudo",$_SESSION['pseudo']);
    $stmt->bindParam(":numJoueur",$num);
    $stmt->execute();
}

$requete = "UPDATE partie SET etat=:etat WHERE idPartie=:idPartie";
$stmt = $c->prepare($requete);
$etat = 1;
$stmt->bindParam(":etat",$etat);
$stmt->bindParam(":idPartie",$_POST['id']);
$stmt->execute();
