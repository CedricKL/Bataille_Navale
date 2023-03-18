<?php 
    session_start();
    $_SESSION['id_partie'] = $_GET['partie'];
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
                $_SESSION['score_joueur'] = $tabRes[0]['score'];
                $_SESSION['score_enemi'] = $tabRes[1]['score'];
            }
            if($tabRes[1]['numJoueur'] == 1) {
                $_SESSION['score_joueur'] = $tabRes[1]['score'];
                $_SESSION['score_enemi'] = $tabRes[0]['score'];
            }

        }else  if($_SESSION['numJoueur'] == 2) {
                
            if($tabRes[0]['numJoueur'] == 2) {
                $_SESSION['score_joueur'] = $tabRes[0]['score'];
                $_SESSION['score_enemi'] = $tabRes[1]['score'];
            }
            if($tabRes[1]['numJoueur'] == 2) {
                $_SESSION['score_joueur'] = $tabRes[1]['score'];
                $_SESSION['score_enemi'] = $tabRes[0]['score'];
            }
                    
        }
    }else  if(count($tabRes) == 1) {
        $_SESSION['score_joueur'] = $tabRes[0]['score'];
        $_SESSION['score_enemi'] = 0;
    }
    // var_dump($tabRes);
    var_dump( $_SESSION['numJoueur']);
    /* var_dump( $_SESSION['score_joueur']);
    var_dump( $_SESSION['score_enemi']); */
    var_dump( $_SESSION['tour']);
    var_dump( $_SESSION['pseudo']);
    //var_dump($tabRes);
    /*$_SESSION['score_jouer'] = $grille_joueur;
    $_SESSION['score_enemi'] = $grille_enemi;*/

    /* var_dump( $_SESSION['grille_joueur']);
    var_dump( $_SESSION['grille_enemi']);
    var_dump( $_SESSION['numJoueur']);
    var_dump( $_SESSION['tour']); */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/grille.css">
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/joueur.js"></script>
    <script src="js/navire.js"></script>
    <title>Grille</title>
</head>
<body class="container" onload="getPartie();getTour();getTirs()">
    <header>
        <div class="players">
            <div class="player">
            <img src="img/player1.png" alt="Player 1">
            <h3>Player 1</h3>
            <span id="j1">Score: 
                <?php 
                    if($_SESSION['numJoueur'] == 2) {
                        echo $_SESSION['score_enemi'];
                    }else if($_SESSION['numJoueur'] == 1) {
                        echo $_SESSION['score_joueur'];
                    }
                ?>
            </span>
            </div>
            <div class="player">
            <img src="img/player2.png" alt="Player 2">
            <h3>Player 2</h3>
            <span>Score: 
            <?php 
                    if($_SESSION['numJoueur'] == 2) {
                        echo $_SESSION['score_joueur'];
                    }else if($_SESSION['numJoueur'] == 1) {
                        echo $_SESSION['score_enemi'];
                    }
                ?>
            </span>
            </div>
        </div>
    </header>

    <div>

    </div>
    <div class="game">
        <?php include 'dessinerGrille.php'; ?>
        <!-- <div class="choix">
            <?php 
                for($i=0;$i<40;$i++){
                    if($i % 10 == 0){
                        
                    }
                } 
            ?>
        </div> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>