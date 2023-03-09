<?php
    session_start();
    $_SESSION['id_partie'] = '';
    $_SESSION['role'] = '';
	include('./connexion.php');
	// include('./end.php');
 	require_once('function.php');
?>
<!-- Partie : page pour jouer -->
	<article id="jouer1">
        <p>Creer Partie</p>
        <?php 
          $requete = "SELECT * FROM partie WHERE etat = 1";
          $stmt = $c->prepare($requete);
          $stmt->execute();

          // récupération du résultat dans un tableau associatif
            $tabRes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Si vous voulez mieux comprendre la structure de données retournée :
            //var_dump($tabRes);
            
            foreach($tabRes as $uneLigne)
            {
                $i = $uneLigne['idPartie'];
                echo $uneLigne['idPartie']. ": <a href='grille.php?partie=$i'>Rejoindre Partie</a> <br>"; 
            }
        ?>
	
		

        <?php 
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

        $stmt->bindParam(":grilleJ1", json_encode($grilleJ1));
        $stmt->bindParam(":grilleJ2", json_encode($grilleJ2));
        $stmt->bindParam(":tour", $tour);
        $stmt->bindParam(":etat", $etat);

        $stmt->execute();
        ?>
	</article>



