<?php
session_start();
$json = json_encode($_SESSION['grille_enemi']);
header('Content-Type: application/json');
echo $json;
