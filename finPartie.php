<?php
    session_start();
    include('./connexion.php');
    $fin = false;
    $grille_enemi = get_object_vars($_SESSION['grille_enemi']);
    $grille_joueur = get_object_vars($_SESSION['grille_joueur']);
    $count_enemi = array_count_values($grille_enemi);
    $count_joueur = array_count_values($grille_joueur);
    $c1 = !isset($count_enemi["1"]);
    $c2 = !isset($count_joueur["1"]);
    if($c1 || $c2){
        $requete = "UPDATE partie SET etat=:etat, tour=:tour WHERE idPartie=:idPartie";
        $stmt = $c->prepare($requete);
        $etat = 3;
        $tour = 0;
        $stmt->bindParam(":etat",$etat);
        $stmt->bindParam(":tour",$tour);
        $stmt->bindParam(":idPartie",$_SESSION['id_partie']);
        $stmt->execute();
        $fin = true;
        if($c1){
            $winner = $_SESSION['numJoueur'];
            $loser = $winner==1?2:1;
        }
        if($c2){
            $loser = $_SESSION['numJoueur'];
            $winner = $loser==1?2:1;
        }
    }
    if(!isset($winner))
    $winner="nope";
    if(!isset($loser))
    $loser="nope";
    header('Content-Type: application/json');
    echo json_encode($winner.",".$loser);