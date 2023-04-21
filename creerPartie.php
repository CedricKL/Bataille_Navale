<?php
    session_start() ;  
    // $_SESSION['pseudo'] = "Ced"; 
    include('./connexion.php');
    // include('./end.php');
    require_once('function.php');

    $requete = "INSERT INTO partie(Grillej1, Grillej2, tour, etat) VALUES(:grilleJ1, :grilleJ2, :tour, :etat)";
    $stmt = $c->prepare($requete);

    // Legende Grille
    // 1 - Position d'un bateau 2- Tiré mais loupé 3-Touché

    /* $grilleJ1 = '[
        "3":1,"4":1, "5":1,"6":1,"7":1,"23":1,"34":1,"45":1,"51":1,"52":1,"53":1,"54":1,"55":1,"56":1,"67":1,"84":1,"85":1,"86":1,"87":1,"88":1,
    ]'; */
    $grilleJ1 = [];
    $cpt = 0;
    $sens = -1;
    $numbers = array(); // tableau qui va contenir les nombres aléatoires distincts

    while (count($numbers) < 5) {
        $number = rand(0, 9); // génère un nombre aléatoire
        if (!in_array($number, $numbers)) { // vérifie si le nombre n'est pas déjà dans le tableau
            $numbers[] = $number; // ajoute le nombre au tableau final
        }
    }
    foreach($numbers as $ligne){
        $col = rand(0, 9);
        $case = $ligne*10+$col;
        if($case%10 < 6 ){
            for($i=0;$i<4;$i++){
                $grilleJ1[$case+$i] = 1;
            }
        }else{
            for($i=0;$i<4;$i++){
                $grilleJ1[$case-$i] = 1;
            } 
        }
    }




    $grilleJ2 = [];
    $cpt = 0;
    $sens = -1;
    while (count($numbers) < 5) {
        $number = rand(0, 9); // génère un nombre aléatoire
        if (!in_array($number, $numbers)) { // vérifie si le nombre n'est pas déjà dans le tableau
            $numbers[] = $number; // ajoute le nombre au tableau final
        }
    }
    foreach($numbers as $ligne){
        $col = rand(0, 9);
        $case = $ligne*10+$col;
        if($case%10 < 6 ){
            for($i=0;$i<4;$i++){
                $grilleJ2[$case+$i] = 1;
            }
        }else{
            for($i=0;$i<4;$i++){
                $grilleJ2[$case-$i] = 1;
            } 
        }
    }

    // Legende Tour
    // 1 - Joueur 1 2- Joueur 2
    $tour = '1';

    // Legende Etat
    // 1 - demarré 2- En Attente 0-Pas encore commence
    $etat = '2';
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

    $_SESSION['numJoueur'] = '1';

