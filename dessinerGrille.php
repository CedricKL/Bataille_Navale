<?php
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