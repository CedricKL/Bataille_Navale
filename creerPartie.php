<?php
    session_start() ;  
    $_SESSION['pseudo'] = "Ced"; 
    include('./connexion.php');
    // include('./end.php');
    require_once('function.php');

    $requete = "INSERT INTO partie(Grillej1, Grillej2, tour, etat) VALUES(:grilleJ1, :grilleJ2, :tour, :etat)";
    $stmt = $c->prepare($requete);
    /* $grilleJ1 = '[
        "3":1,"4":1, "5":1,"6":1,"7":1,"23":1,"34":1,"45":1,"51":1,"52":1,"53":1,"54":1,"55":1,"56":1,"67":1,"84":1,"85":1,"86":1,"87":1,"88":1,
    ]'; */
    $grilleJ1 = array(
        "3" => 1,
        "4" => 1,
        "5" => 1,
        "6" => 1,
        "7" => 1,
        "23" => 1,
        "34" => 1,
        "45" => 1,
        "51" => 1,
        "52" => 1,
        "53" => 1,
        "54" => 1,
        "55" => 1,
        "56" => 1,
        "67" => 1,
        "84" => 1,
        "85" => 1,
        "86" => 1,
        "87" => 1,
        "88" => 1,
    );

    $grilleJ2 = array(
        "3" => 1,
        "4" => 1,
        "5" => 1,
        "6" => 1,
        "7" => 1,
        "23" => 1,
        "34" => 1,
        "45" => 1,
        "51" => 1,
        "52" => 1,
        "53" => 1,
        "54" => 1,
        "55" => 1,
        "56" => 1,
        "67" => 1,
        "84" => 1,
        "85" => 1,
        "86" => 1,
        "87" => 1,
        "88" => 1,
    );
    $tour = '1';
    $etat = '1';
    // 1 - demarré 2- En Attente 0-Pas encore commence
    $g1Json = json_encode($grilleJ1);
    $g2Json = json_encode($grilleJ2);
    $stmt->bindParam(":grilleJ1",$g1Json);
    $stmt->bindParam(":grilleJ2",$g2Json);
    $stmt->bindParam(":tour", $tour);
    $stmt->bindParam(":etat", $etat);
    $stmt->execute();

    $requete = "SELECT * FROM partie ORDER BY idPartie DESC LIMIT 1";
    $stmt = $c->prepare($requete);
    $stmt->execute();

    // récupération du résultat dans un tableau associatif
    $tabRes = $stmt->fetch();
    // Si vous voulez mieux comprendre la structure de données retournée :
    //var_dump($tabRes);
    echo $tabRes['idPartie'];
    // header("Location: grille.php?partie=1");
    $num = 1;
    $requete = "INSERT INTO jouer(idPartie,pseudo,numJoueur) VALUES(:idPartie, :pseudo, :numJoueur)";
    $stmt = $c->prepare($requete);
    $stmt->bindParam(":idPartie",$tabRes['idPartie']);
    $stmt->bindParam(":pseudo",$_SESSION['pseudo']);
    $stmt->bindParam(":numJoueur",$num);
    $stmt->execute();

    $_SESSION['numJoueur'] = 1;

