



<?php

//$bdd= new PDO('mysql:host=127.0.0.1;dbname=***', '**username','**password');
include( "./connexion.php");

if(isset($_POST['formInscription']))
{
    $pseudo =htmlspecialchars($_POST['pseudo']);
    $mail= htmlspecialchars($_POST['mail']);
    $mail2= htmlspecialchars($_POST['mail2']);
    $mdp= sha1($_POST['mdp']);
    $mdp2= sha1($_POST['mdp2']);

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) )
    {
       

       $pseudolength =strlen($pseudo);
       if($pseudolength<=255)
       {
          if($mail==$mail2)
          {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL))
            {

              $reqmail = $bdd->prepare("SELECT * FROM joueur WHERE mail= ?");
              $reqmail->execute(array($mail));
              $mailexist= $reqmail->rowcount();
              if($mailexist==0)
              {
                if($mdp==$mdp2)
                {
                    echo "Nickel";
                    $inserttmbr=$bdd->prepare("INSERT INTO joueur(pseudo,mail,mdp) VALUES (?,?,?)");
                    $inserttmbr->execute(array($pseudo, $mail, $mdp));
                    $erreur= "Votre compte a bien été cree";  
                    header('Location:index.php');
                }
                else
                {
                  $erreur= "Vos mots de passe ne correspondent pas";
                }
              }
              else
              {
                $errreur="Adresse mail déja utilisé";


                
              }

                
            }
            else
            {
             $erreur="Votre adressse mail est pas valide";
            }
              
          }
          else
          {
           $erreur="Vos adresses mail ne correspondent pas ";
          }
       }
       else
       {
        $erreur= "Votre pseudo ne doit pas depasser 255 caractere";
       }
    }
    else
     {
        $erreur= "Tous les champs doivent etre completés !";
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
   <h2>Inscription</h2> 
   <br/><br />
   <form method="POST" action="">


   <table>
    <tr>
   <td align="right">
   <label for="pseudo">Pseudo :</label>
   </td>

   <td align="right">
   <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)){echo $pseudo;} ?>"/>
   </td>
    </tr>

    <tr>
   <td align="right">
   <label for="mail">Mail :</label>
   </td>

   <td align="right">
   <input type="text" placeholder="Votre mail" id="mail" name="mail"  value="<?php if(isset($mail)){echo $mail;} ?>" />
   </td>
    </tr>

    <tr>
   <td align="right">
   <label for="mail2">Confirmation du mail :</label>
   </td>

   <td align="right"> 
   <input type="email" placeholder="Confirmez Votre mail" id="mail2" name="mail2"value="<?php if(isset($mail2)){echo $mail2;} ?>"  />
   </td>
    </tr>

    <tr>
   <td align="right">
   <label for="mdp">Votre mot de passe:</label>
   </td>

   <td align="right"> 
   <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
   </td>
    </tr>

    <tr>
   <td align="right">
   <label for="mdp2">Confirmation du mot de passe:</label>
   </td>

   <td align="right"> 
   <input type="password" placeholder="Confirmez votre mot de passe" id="mdp2" name="mdp2" />
   </td>
    </tr>
    <tr>
        <td>

        </td >
        <td align="center">
            <br/>
        <input type="submit" name="formInscription" value="je m'inscris"/>
    
        </td>
    </tr>
   </table>

      
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