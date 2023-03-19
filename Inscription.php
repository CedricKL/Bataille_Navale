



<?php

//$bdd= new PDO('mysql:host=127.0.0.1;dbname=***', '**username','**password');
include( "./connexion.php");

if(isset($_POST['formInscription']))
{
    $pseudo =htmlspecialchars($_POST['pseudo']);
    $nom =htmlspecialchars($_POST['nom']);
    $prenom =htmlspecialchars($_POST['prenom']);
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

              $reqmail = $c->prepare("SELECT * FROM joueur WHERE mail= ?");
              $reqmail->execute(array($mail));
              $mailexist= $reqmail->rowcount();
              if($mailexist==0)
              {
                if($mdp==$mdp2)
                {
                    echo "Nickel";
                    $inserttmbr=$c->prepare("INSERT INTO joueur(pseudo,mail,mdp,nom,prenom) VALUES (?,?,?,?,?)");
                    if($inserttmbr->execute(array($pseudo, $mail, $mdp,$nom,$prenom))){
                        $erreur= "Votre compte a bien été cree";  
                        $_SESSION['pseudo'] = $pseudo;
                        header('Location:index.php?page=PageConnexion.php');
                    };
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

<div style="margin-left:30%;" align="center">
   <h2 style="color: rgb(255, 197, 40);">Inscription</h2> 
   <br/><br />
   <form method="POST" action="">
      <div class="mb-3">
          <label for="pseudo" class="form-label">Pseudo</label>
          <input type="text" class="form-control" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)){echo $pseudo;} ?>">
      </div>
      <div class="mb-3">
          <label for="nom" class="form-label">Nom</label>
          <input type="text" class="form-control" placeholder="Votre nom" id="nom" name="nom"  value="<?php if(isset($nom)){echo $nom;} ?>" />    
      </div>
      <div class="mb-3">
          <label for="prenom" class="form-label">Prenom</label>
          <input type="text" class="form-control" placeholder="Votre prenom" id="prenom" name="prenom"  value="<?php if(isset($prenom)){echo $prenom;} ?>" />    
      </div>
      <div class="mb-3">
          <label for="mail" class="form-label">Mail</label>
          <input type="email" class="form-control" placeholder="Votre mail" id="mail" name="mail"  value="<?php if(isset($mail)){echo $mail;} ?>" />    
      </div>
      <div class="mb-3">
          <label for="mail2" class="form-label">Confirmation du mail :</label>
          <input type="email" class="form-control" placeholder="Votre mail" id="mail2" name="mail2"  value="<?php if(isset($mail2)){echo $mail2;} ?>" />    
      </div>
      <div class="mb-3">
          <label for="mdp" class="form-label">Mot de passe</label>
          <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Votre mot de passe">
      </div>
      <div class="mb-3">
          <label for="mdp2" class="form-label">Confirmation du mot de passe</label>
          <input type="password" class="form-control" name="mdp2" id="mdp2" placeholder="Confirmez Votre mot de passe">
      </div>
      <button type="submit" name="formInscription" class="btn btn-primary"> Je m'inscris </button>
   </form>
   <!--<form method="POST" action="">


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

      
   </form> -->
   <br />
   <?php
   if(isset($erreur))
   {
    echo '<font color="red">'.$erreur."</font>";
   }
   ?>
    </div>
</body>
</html>