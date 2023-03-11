<?php
    session_start();
    $json = json_encode($_SESSION['grille_joueur']);
    header('Content-Type: application/json');
    echo $json;