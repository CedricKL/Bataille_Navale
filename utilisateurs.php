<!-- Page de gestion des utilisateurs -->
<?php
    include('./connexion.php');

    if(!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin') ) {
        if(isset($_SESSION['pseudo']))
            header("Location: index.php");
        else
            header("Location: index.php?page=utilisateurs.php");
    }

    $requete = "SELECT * FROM joueur";
    $stmt = $c->prepare($requete);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<article id="joueurs">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Mail</th>
            </tr>
        </thead>
        <tbody>
    <?php
        foreach($results as $result){
            echo "<tr>";
                echo "<td>".$result['nom']."</td>";
                echo "<td>".$result['prenom']."</td>";
                echo "<td>".$result['mail']."</td>";
                echo '<td><button class="btn btn-primary btn-sm" onclick="ModifierUser()"><span class="glyphicon glyphicon-remove "></span><i class="fa fa-pencil-alt"></i>
                Modifier</button></td>';
                echo '<td><button class="btn btn-danger btn-sm" onclick="supprimerUser(\''.$result['pseudo'].'\')"><span class="glyphicon glyphicon-remove "></span><i class="fa fa-trash"></i>
                Suprimer</button></td>';
            echo "</tr>";
        }
    ?>
        </tbody>
    </table>
</article>