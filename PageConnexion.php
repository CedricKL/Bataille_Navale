<?php
//$bdd= new PDO('mysql:host=127.0.0.1;dbname=***', '**username','**password');
include("./connexion.php");
if (isset($_POST['formconnexion'])) {

    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if (!empty($mailconnect) and !empty($mdpconnect)) {
        $requser = $c->prepare("SELECT * FROM joueur WHERE mail= ?  AND mdp= ?");
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowcount();
        if ($userexist == 1) {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['role'] = $userinfo['rol'];
            $_SESSION['mail'] = $userinfo['mail'];
            // header("location:profil.php?id=".$_SESSION['id']);
            header("location:index.php");
        }
        //else
        {
            $erreur = "Mauvais mail ou mot de passe";
        }
    } else {
        $erreur = "Tous les champs doivent etre complétés";
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
    <link rel="stylesheet" type="text/css" href="css/static.css">
    <script src='main.js'></script>
</head>

<body>
    <div style="min-width: 500px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h2 style="color: rgb(255, 197, 40);">Connexion</h2>
        <br /><br />
        <form method="POST" action="" style="width: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center;" >
            <div class="mb-3" style="width: 100%">
                <label for="mailconnect" class="form-label" style="color: white; font-weight: 500;">Adresse Email</label>
                <input type="email" class="form-control" id="mailconnect" name="mailconnect" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text" style="color: wheat; font-weight: 500;">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3" style="width: 100%">
                <label for="mdpconnect" class="form-label" style="color: white; font-weight: 500;">Mot de passe</label>
                <input type="password" class="form-control" name="mdpconnect" id="mdpconnect">
            </div>
            <div class="mb-3 form-check" style="width: 100%">
                <input type="checkbox" class="form-check-input" id="check">
                <label class="form-check-label" for="check" style="color: white; font-weight: 500;">Check me out</label>
            </div>
            <button type="submit" name="formconnexion" class="btn btn-warning">Se connecter</button>
        </form>

       <!-- <form method="POST" action="">

            <input type="email" name="mailconnect" placeholder="Mail" />
            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
            <input type="submit" name="formconnexion" value="Se connecter " />


        </form> -->
        <br />
        <?php
        if (isset($erreur)) {
            echo '<font color="red">' . $erreur . "</font>";
        }
        ?>
    </div>
</body>


</html>