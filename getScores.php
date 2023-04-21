<?php
    session_start();
    include('./connexion.php');
// get score
$requete = "SELECT * FROM jouer WHERE idPartie = :idPartie";
$stmt = $c->prepare($requete);
$idPartie = $_SESSION['id_partie'];
$stmt->bindParam(':idPartie', $idPartie);
$stmt->execute();

$tabRes = $stmt->fetchAll();
if(count($tabRes) == 2) {
    // echo "ici";
    // var_dump($tabRes);
    if($_SESSION['numJoueur'] == 1) {

        if($tabRes[0]['numJoueur'] == 1) {
            $score_joueur = $tabRes[0]['score'];
            $score_enemi = $tabRes[1]['score'];
        }
        if($tabRes[1]['numJoueur'] == 1) {
            $score_joueur = $tabRes[1]['score'];
            $score_enemi = $tabRes[0]['score'];
        }

    }else  if($_SESSION['numJoueur'] == 2) {

        if($tabRes[0]['numJoueur'] == 2) {
            $score_joueur = $tabRes[0]['score'];
            $score_enemi = $tabRes[1]['score'];
        }
        if($tabRes[1]['numJoueur'] == 2) {
            $score_joueur = $tabRes[1]['score'];
            $score_enemi = $tabRes[0]['score'];
        }

    }
}else  if(count($tabRes) == 1) {
    $score_joueur = $tabRes[0]['score'];
    $score_enemi = 0;
}

echo $score_joueur.",".$score_enemi;