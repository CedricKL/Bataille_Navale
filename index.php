<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/static.css">
	<meta charset="utf-8" />
	<script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/joueur.js"></script>
    <script src="js/navire.js"></script>
		<title> Bataille navale </title>
		
</head>

<body>
	<?php 
		
		include('static/header.php'); 
		include('static/menu.php');
		if(!isset($_SESSION['pseudo'])) {
			$nomPage = "Pageconnexion.php";
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
				$nomPage = 'Pageconnexion.php';
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


