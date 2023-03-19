<?php
    $fin = false;
    if(array_count_values($_SESSION['grille_enemi'])["3"] == 20 || array_count_values($_SESSION['grille_joueur'])["3"] == 20){
        $requete = "UPDATE partie SET etat=:etat, tour=:tour WHERE idPartie=:idPartie";
        $stmt = $c->prepare($requete);
        $etat = 3;
        $tour = 0;
        $stmt->bindParam(":etat",$etat);
        $stmt->bindParam(":tour",$tour);
        $stmt->bindParam(":idPartie",$_SESSION['id_partie']);
        $stmt->execute();
        $fin = true;
        if(array_count_values($_SESSION['grille_enemi'])["3"] == 20){
            $winner = $_SESSION['numJoueur'];
            $loser = $winner==1?2:1;
        }
        if(array_count_values($_SESSION['grille_joueur'])["3"] == 20){
            $loser = $_SESSION['numJoueur'];
            $winner = $loser==1?2:1;
        }
    }