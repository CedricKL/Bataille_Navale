<?php
    // session_start();
    // $_SESSION['id_partie'] = '';
    // $_SESSION['role'] = '';
	include('./connexion.php');
	// include('./end.php');
 	require_once('function.php');
?>
<!-- Partie : page pour jouer -->
	<article id="jouer1">
        <button type="button" class="btn btn-primary" id="CreerPartie" onclick="creerPartie()">Creer Partie</button></br>
        <?php 
            
            if($_SESSION['role'] == 'admin') {
                $requete = "SELECT * FROM partie";
                $stmt = $c->prepare($requete);
                $stmt->execute();

                // récupération du résultat dans un tableau associatif
                $tabRes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Si vous voulez mieux comprendre la structure de données retournée :
                //var_dump($tabRes);
                foreach($tabRes as $uneLigne)
                {
                    $requete = "SELECT * FROM partie WHERE idPartie = :idPartie";
                    $stmt = $c->prepare($requete);

                    $stmt->bindParam(":idPartie", $uneLigne['idPartie']);
                    $stmt->execute();

                    // récupération du résultat dans un tableau associatif
                    $resultat = $stmt->fetch();

                    $i = $uneLigne['idPartie'];
                    // pour l'instant je ne sais pas si on doit laisser le lien pour l'admin de rejoindre la partie
                    if($resultat['etat'] == 1) {
                        echo "<img src=\"img/partie.png\" alt=\"Logo partie\" class=\"petite_image\">".$uneLigne['idPartie']. ": <a href='grille.php?partie=$i' onClick=\"rejoindrePartie($i)\">Rejoindre Partie</a> <span style=\"color: #842029;\">(Partie En Cours) ***  Actions</span><br>"; 
                    }else if($resultat['etat'] == 2) {
                        echo "<img src=\"img/partie.png\" alt=\"Logo partie\" class=\"petite_image\">".$uneLigne['idPartie']. ": <a href='grille.php?partie=$i' onClick=\"rejoindrePartie($i)\">Rejoindre Partie</a> <span style=\"color: #842029;\">(Partie En attente) ***  Actions </span><br>"; 
                    }
                }
            }else {
                $requete = "SELECT * FROM jouer WHERE pseudo = :pseudo";
                $stmt = $c->prepare($requete);

                $stmt->bindParam(":pseudo", $_SESSION['pseudo']);
                $stmt->execute();

                // récupération du résultat dans un tableau associatif
                $tabRes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Si vous voulez mieux comprendre la structure de données retournée :
                //var_dump($tabRes);

                $requete = "SELECT * FROM partie WHERE etat= 2";
                $stmt = $c->prepare($requete);
                $stmt->execute();

                // récupération du résultat dans un tableau associatif
                $tabRes2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($tabRes2 as $uneLigne)
                {
                // récupération du résultat dans un tableau associatif
                $i = $uneLigne['idPartie'];
                echo "<img src=\"img/partie.png\" alt=\"Logo partie\" class=\"petite_image\">" . $uneLigne['idPartie'] . ": <a href='grille.php?partie=$i' onClick=\"rejoindrePartie($i)\">Rejoindre Partie</a> <span style=\"color: #842029;\">(Partie En attente) </span><br>"; 

                }

                foreach($tabRes as $uneLigne)
                {
                    $requete = "SELECT * FROM partie WHERE idPartie = :idPartie";
                    $stmt = $c->prepare($requete);

                    $stmt->bindParam(":idPartie", $uneLigne['idPartie']);
                    $stmt->execute();

                    // récupération du résultat dans un tableau associatif
                    $resultat = $stmt->fetch();

                    $i = $uneLigne['idPartie'];
                    if($resultat['etat'] == 1) {
                        echo "<img src=\"img/partie.png\" alt=\"Logo partie\" class=\"petite_image\">".$uneLigne['idPartie']. ": <a href='grille.php?partie=$i' onClick=\"rejoindrePartie($i)\">Rejoindre Partie</a> <span style=\"color: #842029;\">(Partie En Cours)</span><br>"; 
                    }
                }
            }
            
        ?>
	
		

        <!-- <?php 
        //$requete = "INSERT INTO partie(Grillej1, Grillej2, tour, etat) VALUES(:grilleJ1, :grilleJ2, :tour, :etat)";
        //$stmt = $c->prepare($requete);
       /* $grilleJ1 = '[
            "3":1,"4":1, "5":1,"6":1,"7":1,"23":1,"34":1,"45":1,"51":1,"52":1,"53":1,"54":1,"55":1,"56":1,"67":1,"84":1,"85":1,"86":1,"87":1,"88":1,
        ]'; */
        // $grilleJ1 = array(
        //     "3" => 1,
        //     "4" => 1,
        //     "5" => 1,
        //     "6" => 1,
        //     "7" => 1,
        //     "23" => 1,
        //     "34" => 1,
        //     "45" => 1,
        //     "51" => 1,
        //     "52" => 1,
        //     "53" => 1,
        //     "54" => 1,
        //     "55" => 1,
        //     "56" => 1,
        //     "67" => 1,
        //     "84" => 1,
        //     "85" => 1,
        //     "86" => 1,
        //     "87" => 1,
        //     "88" => 1,
        // );

        // $grilleJ2 = array(
        //     "3" => 1,
        //     "4" => 1,
        //     "5" => 1,
        //     "6" => 1,
        //     "7" => 1,
        //     "23" => 1,
        //     "34" => 1,
        //     "45" => 1,
        //     "51" => 1,
        //     "52" => 1,
        //     "53" => 1,
        //     "54" => 1,
        //     "55" => 1,
        //     "56" => 1,
        //     "67" => 1,
        //     "84" => 1,
        //     "85" => 1,
        //     "86" => 1,
        //     "87" => 1,
        //     "88" => 1,
        // );
        // $tour = '1';
        // $etat = '1';
        // // 1 - demarré 2- En Attente 0-Pas encore commence
        // $g1Json = json_encode($grilleJ1);
        // $g2Json = json_encode($grilleJ2);
        // $stmt->bindParam(":grilleJ1",$g1Json);
        // $stmt->bindParam(":grilleJ2",$g2Json);
        // $stmt->bindParam(":tour", $tour);
        // $stmt->bindParam(":etat", $etat);

        // $stmt->execute();
        // ?> -->
	</article>



