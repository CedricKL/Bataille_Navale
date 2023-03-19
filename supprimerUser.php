<?php
    include('./connexion.php');
    $req = "DELETE FROM joueur WHERE pseudo=:pseudo";
    $stmt = $c->prepare($req);
    $stmt->bindParam(":pseudo",$_POST['pseudo']);
    $stmt->execute();
