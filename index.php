<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <!-- FONTAWESOME  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome//5.15.4/css/all.min.css">
    <!-- BOOTSTRAP  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/static.css">
	<meta charset="utf-8" />
	<script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/joueur.js"></script>
    <script src="js/navire.js"></script>
		<title> Bataille navale </title>
		
</head>

<body style="width: 100%; height: auto; font-family: Roboto;">
	<?php 
		
		include('static/header.php'); 
		include('static/menu.php');
		if(!isset($_SESSION['pseudo'])) {
			$nomPage = "PageConnexion.php";
			//header("Location: index.php?page=Pageconnexion.php");
		}
		
	?>
	<div id="contenu">
		<?php //permet d'inclure plus facilement tout notre php
			if(isset($_GET['page'])) {
				if($_GET['page'] == "Inscription.php")  {
					$nomPage = "Inscription.php";
				}
			}else {
				$nomPage = 'PageConnexion.php';
			}
			
			if(isset($_SESSION['pseudo'])) {
				if(isset($_GET['page'])) { 
					if(file_exists(addslashes($_GET['page']))) 
						$nomPage = addslashes($_GET['page']);
				}else {
					$nomPage = 'static/accueil.php';
				}
			}
			include($nomPage); 
		?>
	</div>
	

	<?php include('static/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>


