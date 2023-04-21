<!DOCTYPE html>

<html>
	<?php session_start(); // Ouverture de session ?>
<head>
	<meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
	<title>Bataille Navale</title>
	<link href="css/static.css" rel="stylesheet" media="all" type="text/css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
		$( ".selector" ).datepicker({
  			fomatDate: "yyyy-mm-dd"
		});
		$( ".selector" ).datepicker( "option", "formatDate", "yyyy-mm-dd" );

	});
	</script>
</head>
<body>
	<?php  			// Ouverture de la connexion à la base de données du jeu
		include("./connexion.php") ;
	?>

	<article id="co">
		<form method="post" action="">
		    <legend>Connexion</legend>
		    <div class="form-group">
		      <label class="col-lg-2 control-label">Login</label>
		      <div class="col-lg-10">
		        <input type="text" class="form-control" name="pseudo" placeholder="Login">
		      </div>
		    </div><br/>
		    <div class="form-group">
		      <label class="col-lg-2 control-label">Mot de passe</label>
		      <div class="col-lg-10">
		        <input type="password" class="form-control" name="password" placeholder="Mot de passe">
		      </div>
		    </div>
		<br/><br/><center><button type="submit" name="submit" class="btn btn-primary">Connexion</button></center>
		<a href="index.php?page=inscription.php" id="accueil" class="surligne">Inscription</a>
		</form>

		<?php
			if (isset($_POST['submit']))
			{
				// Permet de recuperer dans les variables ce qui ai mis dans le formulaire
				$pseudoPost = mysqli_real_escape_string($c, $_POST['pseudo']);
				$mdpPost = mysqli_real_escape_string($c, $_POST['password']);

				//Permet de recuperer le login associé au pseudo
				$pseudo_bd = mysqli_query($c, 'SELECT pseudo FROM Joueur WHERE pseudo = \''.$pseudoPost.'\' ;' ); 
				$pseudobd = mysqli_fetch_array($pseudo_bd);
				//echo $pseudobd[0];

				//Permet de recuperer le mot de passe associé
				//A terme doit etre changé part la formule  qui est en dessous en commentaire. 
				//Pour n'avoir aucun probleme
				$mdp_bd = mysqli_query($c, 'SELECT mdp FROM Joueur WHERE pseudo = \''.$pseudoPost.'\' ;' ); 
				$mdpbd = mysqli_fetch_array($mdp_bd);
				//echo $mdpbd[0];	



				// 				Méthode generale pour recuperer tout ce qui correspond			
				// while($pseudobd = mysqli_fetch_array($pseudo_bd)) 
				// {
				// 	echo "$pseudobd[0]";	
				// }
				// while($mdpbd = mysqli_fetch_array($mdp_bd)) 
				// {
				// 	echo "$mdpbd[0]";	
				// }


					// Doit marcher à terme. Juste probleme de syntaxe
					// $co = mysqli_query($c, 'SELECT * FROM Joueur WHERE EXIST 
					// 	(SELECT * FROM Joueur WHERE mdp = \''.$mdpPost.'\' 
					// 							AND pseudo = \''.$pseudoPost.'\' );' );



				if ($pseudobd[0] == $_POST['pseudo'] && $mdpbd[0] == $_POST['password']) 
				{
					//On ouvre une session(ne pas oublier de la fermer, futurement)
					//On sauvegade les quelques informations du joueur
					$_SESSION['pseudo'] = $_POST['pseudo'];
					$_SESSION['password'] = $_POST['password'];
				    
				    echo '<div class="alert alert-dismissable alert-success">
				  	<button type="button" class="close" data-dismiss="alert">×</button>
				  	<strong>Yes !</strong> Vous etes bien logué, Redirection dans 5 secondes ! <meta http-equiv="refresh" content="5; URL=dashboard">
					</div>';

					header ('location: index.php?page=partie.php');
				}
				else {
					//Petit coup de js proprement pour alerter que ce bonhomme n'existe pas
					echo '<body onLoad="alert(\'Membre non reconnu...\')">';
					echo '<meta http-equiv="refresh" content="0;URL=index.php?page=connexion.php">';
				}
			}
		?>

		<?php			// Fermeture de la connexion à la base de données du jeu
			include("./end.php");
		?>
	</article>
</body>
</html>