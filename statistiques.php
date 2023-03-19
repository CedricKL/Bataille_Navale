<!-- Page de statistiques -->

<?php
//session_start();
include('./connexion.php');

if(isset($_SESSION['role']) && ($_SESSION['role'] != 'admin') ) {
	if(isset($_SESSION['pseudo']))
		header("Location: index.php");
	else
		header("Location: index.php?page=PageConnexion.php");
}

// get data from jouer
$requete = "SELECT * FROM jouer ORDER BY score DESC LIMIT 10";
$stmt = $c->prepare($requete);

$stmt->execute();

$tabRes = $stmt->fetchAll(PDO::FETCH_ASSOC);

//var_dump($tabRes);
?>

<article id="statistiques1">
	<div>
		<img src="img/coupe.png" alt="Coupe" class="petite_image">
		<span style="color:  #842029;"><u><strong> Tableau des scores </strong></u></span>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Nom</th>
							<th scope="col">Partie</th>
							<th scope="col">Statut de la Partie</th>
							<th scope="col">Score</th>
							<th scope="col">Victoire</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$victoires = 0;
						$defaites = 0;
						$nuls = 0;
						foreach ($tabRes as $valeur) {
							echo "<tr>";
							echo "	<th scope=\"row\">" . $valeur['pseudo'] . "</th>";
							echo "	<td>" . $valeur['idPartie'] . "</td>";

							$requete = "SELECT * FROM partie WHERE idPartie = :idPartie";
							$stmt = $c->prepare($requete);
							$idPartie = $valeur['idPartie'];
							$stmt->bindParam(':idPartie', $idPartie);

							$stmt->execute();

							// récupération du résultat dans un tableau associatif
							$tabRes2 = $stmt->fetch();

							if ($tabRes2['etat'] == 1)
								echo "	<td> En cours </td>";
							else if ($tabRes2['etat'] == 2)
								echo "	<td> En attente </td>";
							else if ($tabRes2['etat'] == 3)
								echo "	<td> Terminée </td>";
							echo "	<td>" . $valeur['score'] . "</td>";

							$requete = "SELECT * FROM jouer WHERE idPartie = :idPartie AND pseudo = :pseudo";
							$stmt = $c->prepare($requete);
							$idPartie = $valeur['idPartie'];
							$pseudo = $valeur['pseudo'];
							$stmt->bindParam(':idPartie', $idPartie);
							$stmt->bindParam(':pseudo', $pseudo);

							$stmt->execute();

							// récupération du résultat dans un tableau associatif
							$joueur = $stmt->fetch();

							$requete = "SELECT * FROM jouer WHERE idPartie = :idPartie AND pseudo != :pseudo";
							$stmt = $c->prepare($requete);
							$idPartie = $valeur['idPartie'];
							$pseudo = $valeur['pseudo'];
							$stmt->bindParam(':idPartie', $idPartie);
							$stmt->bindParam(':pseudo', $pseudo);

							$stmt->execute();

							// récupération du résultat dans un tableau associatif
							$enemi = $stmt->fetch();

							// var_dump($tabRes3 );
							if ($tabRes2['etat'] == 3 && $joueur['score'] > $enemi['score']) {
								echo "	<td> Victoire </td>";
							} else if ($tabRes2['etat'] == 3 && $joueur['score'] < $enemi['score']) {
								echo "	<td> Défaite </td>";
							} else if ($tabRes2['etat'] == 3 && $joueur['score'] == $enemi['score']) {
								echo " Nul ";
							}
							echo "</tr>";
						}
						?>

					</tbody>
				</table>
			</div>
			<div class="col-sm">
				<p><strong>Recapituatif</strong>
				<p>
					<?php
					// Supprimer les doublons à partir du paramètre spécifié
					$resultat_unique = array();
					$temp = array();
					$parametre = "pseudo";
					foreach ($tabRes as $row) {
						if (!in_array($row[$parametre], $temp)) {
							$temp[] = $row[$parametre];
							$resultat_unique[] = $row;
						}
					}

					// Parcourir le résultat unique et afficher les valeurs


					foreach ($resultat_unique as $row) {
						$victoires = 0;
						$defaites = 0;
						$nuls = 0;
						// echo $row['pseudo'] . "<br>";

						$requete = "SELECT * FROM jouer WHERE pseudo = :pseudo";
						$stmt = $c->prepare($requete);
						$pseudo = $row['pseudo'];
						$stmt->bindParam(':pseudo', $pseudo);

						$stmt->execute();

						// récupération du résultat dans un tableau associatif
						$joueur = $stmt->fetchAll();

						$requete = "SELECT * FROM jouer WHERE pseudo != :pseudo";
						$stmt = $c->prepare($requete);
						$pseudo = $row['pseudo'];
						$stmt->bindParam(':pseudo', $pseudo);

						$stmt->execute();

						// récupération du résultat dans un tableau associatif
						$enemi = $stmt->fetchAll();

						foreach ($joueur as $valeur1) {
							foreach ($enemi as $valeur2) {
								if ($valeur1['idPartie'] == $valeur2['idPartie']) {
									$requete = "SELECT * FROM partie WHERE idPartie = :idPartie";
									$stmt = $c->prepare($requete);
									$idPartie = $valeur1['idPartie'];
									$stmt->bindParam(':idPartie', $idPartie);

									$stmt->execute();

									// récupération du résultat dans un tableau associatif
									$tabRes2 = $stmt->fetch();

									if ($tabRes2['etat'] == 3 && $valeur1['score'] > $valeur2['score']) {
										$victoires++;
									} else if ($tabRes2['etat'] == 3 && $valeur1['score'] < $valeur2['score']) {
										$defaites++;
									} else if ($tabRes2['etat'] == 3 && $valeur1['score'] == $valeur2['score']) {
										$nuls++;
									}
								}
							}
						}
						echo $row['pseudo'] . ":  V(<span class='valeurStat'>" . $victoires . "</span>)D(<span class='valeurStat'>" . $defaites . "</span>)N(<span class='valeurStat'>" . $nuls . "</span>)</td><br>";
					}
					?>
			</div>
		</div>
	</div>
</article>