<!-- Header : haut de chaque page du site -->

<header id="entete">
    <div style="display: flex; max-width: 250px;">
        <a href="index.php" > <img  class="logo" src="img/3il.png" width="100%" height="auto"> </a> 
    </div>
    <h1>Bataille navale</h1>
    <div class="connect">
    <?php 
        if(!isset($_SESSION['pseudo'])) {
            echo "<h2><a href=\"index.php?page=Pageconnexion.php\" id=\"connexion\" style=\"text-decoration: none; color: rgb(255, 197, 40);\">Connexion</a></h2>";
            echo "<h2><a href=\"index.php?page=Inscription.php\" id=\"inscription\" style=\"text-decoration: none; color: rgb(255, 197, 40);\">Inscription</a></h2>";
        
        }else {
            echo "<h2>Bienvenue <span style=\"color: rgb(255, 197, 40)\";>".$_SESSION['pseudo']."!! </span> </h2>";
            echo "<h2><a href=\"index.php?page=deconnexion.php\" id=\"deconnexion\" style=\"text-decoration: none; color: rgb(255, 197, 40);\">Déconnexion</a></h2>";
        }
    ?>
    </div>
   
</header>

