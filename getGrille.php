<?php
    session_start();
<<<<<<< HEAD
    //session_start();
    include('./connexion.php');

=======

    include('./connexion.php');
    
>>>>>>> 8dee9226c3401de0c850de1ecf7d82e19e2e60f1
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
<<<<<<< HEAD

=======
    
>>>>>>> 8dee9226c3401de0c850de1ecf7d82e19e2e60f1
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
<<<<<<< HEAD
=======
    
>>>>>>> 8dee9226c3401de0c850de1ecf7d82e19e2e60f1
    $json = json_encode($_SESSION['grille_joueur']);
    header('Content-Type: application/json');
    echo $json;