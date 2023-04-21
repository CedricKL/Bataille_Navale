<?php 
    session_start();
    $id = $_POST["id"];
    include('./connexion.php');
    // include('./end.php');

    if($_SESSION['tour'] == 1) {

        $requete = "UPDATE partie SET Grillej2=:grilleJ2, tour=:tour WHERE idPartie=:idPartie";
        $stmt = $c->prepare($requete);
        // echo $_GET['zone'];
        // var_dump( $_SESSION['grille']);
        $newGrilleJ2 = get_object_vars($_SESSION['grille_enemi']);
        if (array_key_exists($id, $newGrilleJ2)) {
            if( $newGrilleJ2[$id] == 1) {
                $newGrilleJ2[$id] = 3;
            } else {
                $newGrilleJ2[$id] = 2;
            }
        } else {
            $newGrilleJ2[$id] = 2;
        }

        $tour = 2;
        $partie = $_SESSION['id_partie'];
        // 1 - demarré 2- En Attente 0-Pas encore commence
        // 1 - En cours 2-En Attente  3 - Terminée

        $g2Json = json_encode($newGrilleJ2);
        $stmt->bindParam(":grilleJ2",$g2Json);
        $stmt->bindParam(":tour", $tour);
        $stmt->bindParam(":idPartie", $partie);
        $stmt->execute();

        // Gestion score
        // Gestion score
        $requete = "SELECT * FROM jouer WHERE idPartie = :idPartie AND numJoueur=:numJoueur";
        $stmt = $c->prepare($requete);
        // echo $_GET['zone'];
        // var_dump( $_SESSION['grille']);

        $partie = $_SESSION['id_partie'];
        $numJoueur = $_SESSION['tour'];

        $stmt->bindParam(":idPartie", $partie);
        $stmt->bindParam(":numJoueur", $numJoueur);

        $stmt->execute();

        $resultat = $stmt->fetch();

        $requete2 = "UPDATE jouer SET score=:score WHERE idPartie=:idPartie AND numJoueur=:numJoueur";
        $stmt = $c->prepare($requete2);
        // echo $_GET['zone'];
        // var_dump( $_SESSION['grille']);

        $partie = $_SESSION['id_partie'];
        $score = $resultat['score'];
        $numJoueur = $_SESSION['tour'];

        // Math.max(0, score - 30);
        if( $newGrilleJ2[$id] == 2) {
            $score = max(0, $score - 3);
        }else if( $newGrilleJ2[$id] == 3) {
            $score = $score + 5;
        }
        // +5: Touché; -3: Loupé

        $stmt->bindParam(":score", $score);
        $stmt->bindParam(":idPartie", $partie);
        $stmt->bindParam(":numJoueur", $numJoueur);
        $stmt->execute();

        exit(); 
    }else if($_SESSION['tour'] == 2) {
        $requete = "UPDATE partie SET Grillej1=:grilleJ1, tour=:tour WHERE idPartie=:idPartie";
        $stmt = $c->prepare($requete);
        //echo $_GET['zone'];
        //var_dump( $_SESSION['grille']);
        
        $newGrilleJ1 = get_object_vars($_SESSION['grille_enemi']);
        if (array_key_exists($id, $newGrilleJ1)) {
            if( $newGrilleJ1[$id] == 1) {
                $newGrilleJ1[$id] = 3;
            } else {
                $newGrilleJ1[$id] = 2;
            }
        } else {
            $newGrilleJ1[$id] = 2;
        }

        $tour = 1;
        $partie = $_SESSION['id_partie'];
        // 1 - demarré 2- En Attente 0-Pas encore commence

        $g1Json = json_encode($newGrilleJ1);
        $stmt->bindParam(":grilleJ1",$g1Json);
        $stmt->bindParam(":tour", $tour);
        $stmt->bindParam(":idPartie", $partie);
        $stmt->execute();


         // Gestion score
         $requete = "SELECT * FROM jouer WHERE idPartie = :idPartie AND numJoueur=:numJoueur";
         $stmt = $c->prepare($requete);
         // echo $_GET['zone'];
         // var_dump( $_SESSION['grille']);
 
         $partie = $_SESSION['id_partie'];
         $numJoueur = $_SESSION['tour'];

         $stmt->bindParam(":idPartie", $partie);
         $stmt->bindParam(":numJoueur", $numJoueur);

         $stmt->execute();

         $resultat = $stmt->fetch();

         $requete2 = "UPDATE jouer SET score=:score WHERE idPartie=:idPartie AND numJoueur=:numJoueur";
         $stmt = $c->prepare($requete2);
         // echo $_GET['zone'];
         // var_dump( $_SESSION['grille']);
 
         $partie = $_SESSION['id_partie'];
         $score = $resultat['score'];
         $numJoueur = $_SESSION['tour'];
 
         // Math.max(0, score - 3);
         if( $newGrilleJ1[$id] == 2) {
             $score = max(0, $score - 3);
         }else if( $newGrilleJ1[$id] == 3) {
             $score = $score + 5;
         }
         // +5: Touché; -3: Loupé
 
         $stmt->bindParam(":score", $score);
         $stmt->bindParam(":idPartie", $partie);
         $stmt->bindParam(":numJoueur", $numJoueur);
         $stmt->execute();
         
        exit();
    }
    
    