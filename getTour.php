<?php
    session_start() ;  
    // $_SESSION['pseudo'] = "Ced"; 
    include('./connexion.php');
    // include('./end.php');
    $requete = "SELECT * FROM partie WHERE idPartie=:idPartie";
    $stmt = $c->prepare($requete);
    $stmt->bindParam(":idPartie",$_SESSION['id_partie']);
    $stmt->execute();
    $res = $stmt->fetch();
    $_SESSION['tour'] = $res['tour'];
    echo $_SESSION['tour'];