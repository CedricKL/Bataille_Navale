<?php
session_start();
//session_start();
include('./connexion.php');

// get positions navires
$requete = "SELECT * FROM partie WHERE idPartie = :idPartie";
$stmt = $c->prepare($requete);
$idPartie = $_SESSION['id_partie'];
$stmt->bindParam(':idPartie', $idPartie);

$stmt->execute();

// récupération du résultat dans un tableau associatif
$tabRes = $stmt->fetch();
// Si vous voulez mieux comprendre la structure de données retournée :
$_SESSION['tour'] = $tabRes['tour'];

if($_SESSION['numJoueur'] == 1) {
    $grille_joueur = json_decode($tabRes['Grillej1']);
    $grille_enemi = json_decode($tabRes['Grillej2']);
    $_SESSION['grille_joueur'] = $grille_joueur;
    $_SESSION['grille_enemi'] = $grille_enemi;
}else if($_SESSION['numJoueur'] == 2) {
    $grille_joueur = json_decode($tabRes['Grillej2']);
    $grille_enemi = json_decode($tabRes['Grillej1']);
    $_SESSION['grille_joueur'] = $grille_joueur;
    $_SESSION['grille_enemi'] = $grille_enemi;
}
$json = json_encode($_SESSION['grille_enemi']);
header('Content-Type: application/json');
echo $json;
