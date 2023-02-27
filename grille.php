<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/grille.css">
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/joueur.js"></script>
    <script src="navire.js"></script>
    <title>Grille</title>
</head>
<body class="container">
    <header>
        <div class="players">
            <div class="player">
            <img src="img/player1.png" alt="Player 1">
            <h3>Player 1</h3>
            <span>Score: 0</span>
            </div>
            <div class="player">
            <img src="img/player2.png" alt="Player 2">
            <h3>Player 2</h3>
            <span>Score: 0</span>
            </div>
        </div>
    </header>

    <div class="game">
        <div class="grid">
            <?php 
                for($i=0;$i<100;$i++){
                    echo "<div class=\"carreau\" id=\"j$i\"></div>";
                } 
            ?>     
        </div>
        <div class="grid">
            <?php 
                for($i=0;$i<100;$i++){
                    echo "<div class=\"carreau carreauEnnemi \" id=\"e$i\" onclick=\"gererClick($i)\"></div>";
                } 
            ?>     
        </div>
        <div class="choix">
            <?php 
                for($i=0;$i<40;$i++){
                    if($i % 10 == 0){
                        
                    }
                } 
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>