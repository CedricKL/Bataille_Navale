<?php
session_start();
//$bdd= new PDO('mysql:host=127.0.0.1;dbname=***', '**username','**password');
include( "./connexion.php");
if(isset($_POST['formconnexion']))
{

    $mailconnect= htmlspecialchars($_POST['mailconnect']);
    $mdpconnect= sha1($_POST['mdpconnect']);

    if(!empty($mailconnect) AND !empty($mdpconnect))
    {
           $requser=$bdd->prepare("SELECT * FROM joueur WHERE mail= ?  AND mdp= ?");
           $requser->execute(array($mailconnect,$mdpconnect));
           $userexist=$requser->rowcount();
           if($userexist==1)
           {
               $userinfo=$requser->fetch();
               $_SESSSION['id']=$userinfo['id'];
               $_SESSION['pseudo']=$userinfo['pseudo'];
               $_SESSION['mail']=$userinfo['mail'];
               header("location:profil.php?id=".$_SESSION['id']);
           }
           //else
           {
            $erreur="Mauvais mail ou mot de passe";
           }
    }
    else
    {
        $erreur="Tous les champs doivent etre complétés";
    }


}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Test PHP
    </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
<header id="entete">
    <div style="float:left;">
        <a href="index.php"> <img src="img/3il.png" width="30%" height="30%"> </a> 
    </div>
    <h1>Bataille navale</h1>
</header>
    <div align="center">
   <h2>Connexion</h2> 
   <br/><br />
   <form method="POST" action="">

          <input type="email" name="mailconnect" placeholder="Mail" />
          <input type="password" name="mdpconnect" placeholder="Mot de passe" />
          <input type="submit" name="formconnexion" value="Se connecter "/>

      
   </form>
   <br />
   <?php
   if(isset($erreur))
   {
    echo '<font color="red">'.$erreur."</font>";
   }
   ?>
    </div>
    <footer id="footer">
	<img src="img/3il.png" width="25%" height="25%">
    <a href="http://www.3il-ingenieurs.fr/" target="_blank" alt="Page 3IL"> 3IL- Ingénieurs</a> 
    <a href="" target="_blank" alt="Page BDW1">Programmation web</a>		
	<a>2023</a>
</footer>
</body>


</html>