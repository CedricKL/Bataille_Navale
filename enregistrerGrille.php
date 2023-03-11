<?php 
    session_start();
    $id = $_POST["id"];
    include('./connexion.php');
    // include('./end.php');

    if($_SESSION['tour'] == 1) {

        $requete = "UPDATE partie SET Grillej1=:grilleJ1, tour=:tour WHERE idPartie=:idPartie";
        $stmt = $c->prepare($requete);
        // echo $_GET['zone'];
        // var_dump( $_SESSION['grille']);
    
        $newGrilleJ1 = get_object_vars($_SESSION['grille']);
        $newGrilleJ1[$id] = 2;

        $tour = '2';
        $partie = $_SESSION['id_partie'];
        // 1 - demarré 2- En Attente 0-Pas encore commence
        $g1Json = json_encode($newGrilleJ1);
        $stmt->bindParam(":grilleJ1",$g1Json);
        $stmt->bindParam(":tour", $tour);
        $stmt->bindParam(":idPartie", $partie);
        $stmt->execute();
        exit(); 
    }else if($_SESSION['tour'] == 2) {
        $requete = "UPDATE partie SET Grillej2=:grilleJ2, tour=:tour WHERE idPartie=:idPartie";
        $stmt = $c->prepare($requete);
        //echo $_GET['zone'];
        //var_dump( $_SESSION['grille']);
    
        $newGrilleJ2 = get_object_vars($_SESSION['grille']);
        $newGrille[$id] = 2;

        $tour = '1';
        $partie = $_SESSION['id_partie'];
        // 1 - demarré 2- En Attente 0-Pas encore commence
        $g2Json = json_encode($newGrilleJ2);
        $stmt->bindParam(":grilleJ2",$g2Json);
        $stmt->bindParam(":tour", $tour);
        $stmt->bindParam(":idPartie", $partie);
        $stmt->execute();

        exit();
    }
    
    