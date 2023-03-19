<?php
<<<<<<< HEAD
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
=======
//session_start();

echo "<div class=\"grid\">";
    for($i=0;$i<100;$i++){
        echo "<div class=\"carreau\" id=\"j$i\"></div>";
    }     
echo "</div>";
echo "<div class=\"grid\">";
    for($i=0;$i<100;$i++){
       if($_SESSION['tour'] == $_SESSION['numJoueur']){
            echo "<div class=\"carreau carreauEnnemi \" id=\"e$i\" onclick=\"gererClick($i)\"></div>";
       }else{
            echo "<div class=\"carreau carreauEnnemi \" id=\"e$i\"></div>";
       }
            
    }  
echo "</div>";
>>>>>>> 8dee9226c3401de0c850de1ecf7d82e19e2e60f1
