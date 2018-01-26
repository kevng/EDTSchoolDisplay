<!--

inscription.php : Page d'inscription si la carte n'est pas reconnue
Version : 1.0
Date dernière modification : 24/01/2018

Historique des modifications :
- 17/01/2018 : v1.0 - Création du fichier

-->

<!DOCTYPE html>

<!-- Include des fichiers de connections à la BDD et du fichier contenant les fonctions -->
<?php
include_once 'includes/config.php';
include_once 'includes/db_connect.php';
include_once 'includes/fonctions.php';
?>

<html>

<head>
	<meta charset="utf-8" />
	<!-- Sélection du css à afficher -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" href="img/favicon.png" />

	<title>Inscription</title>
</head><center>

	<body>
		<h1>Inscription de votre badge NFC</h1>

		<?php
		include "phpqrcode/qrlib.php";

		$content= 'http://10.4.64.211/EDT/inscription.php';
		$filename = 'qrcode.png';
		$errorCorrectionLevel = 'H';
		$matrixPointSize = 5;

		QRcode::png($content, $filename,
		$errorCorrectionLevel, $matrixPointSize, 2);

		echo '<img src="qrcode.png" alt="" />';
		?>

		<form>
			<p>
				<!-- une balise select ou input ne peut pas être imbriquée directement dans form -->
				<?php
				$stmt = $bdd->query('SELECT formation,majeure,groupe FROM Ressource');
				?>
				<!-- boucle pour la formation -->
				<?php
				$i=1;
				while ($donnees = $stmt->fetch())
				{
					$tabFormation[$i] = $donnees['formation'];
					$tabMajeure[$i] = $donnees['majeure'];
					$tabGroupe[$i] = $donnees['groupe'];
					$i++;
				} ?>
				<!-- boucle pour la formation -->
				<select name="formation">
			  <?php
				for ($i=1; $i < sizeof($tabFormation); $i++) { ?>
					<option value=<?php echo $tabFormation[$i] ?>><?php echo $tabFormation[$i] ?></option>
				<?php } ?>
				</select>
				<!-- boucle pour la Majeure -->
				<select name="majeure">
			  <?php
				for ($i=1; $i < sizeof($tabMajeure); $i++) { ?>
					<option value=<?php echo $tabMajeure[$i] ?>><?php echo $tabMajeure[$i] ?></option>
				<?php } ?>
				</select>
				<!-- boucle pour le Groupe -->
				<select name="groupe">
			  <?php
				for ($i=1; $i < sizeof($tabGroupe); $i++) { ?>
					<option value=<?php echo $tabGroupe[$i] ?>><?php echo $tabGroupe[$i] ?></option>
				<?php } ?>
				</select>

				<!--<input type="submit" value="valider" title="valider pour aller à la page sélectionnée"/>-->
				<input type="submit" class="btn btn-primary" name="AjoutBDD" value="Envoyer"/>
				<?php
				if(isset($_POST['AjoutBDD']))
				{
					$stmt = $bdd->query('INSERT INTO Carte (uid, formation, majeure, groupe) VALUES ("test", "SI", "test", "0t1")');
				}
 				?>

			</p>
		</form>

	</center>
