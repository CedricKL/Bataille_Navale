<?php
 session_start();
 $json = json_encode($_SESSION['grille']);
 header('Content-Type: application/json');
 echo $json;