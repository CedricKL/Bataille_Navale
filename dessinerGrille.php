<?php
    session_start() ;  

    //dessiner les navires
    echo "<div class=\"grid\">";
            for($i=0;$i<100;$i++){
                echo "<div class=\"carreau\" id=\"j$i\"></div>";
            }      
    echo "</div>";
    echo "<div class=\"grid\">";
    $numj = $_SESSION['numJoueur'];
            for($i=0;$i<100;$i++){
                    echo "<div class=\"carreau carreauEnnemi \" id=\"e$i\" onclick=\"gererClick($i,$numj)\"></div>";       
            }     
    echo "</div>";