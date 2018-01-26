<!--

main.php : Main page

Version : 1.0

Date dernière modification : 17/01/2018

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
		<!-- Rafraichissement automatique de la page toute les heures -->
		<meta http-equiv="refresh" content="3600" />
		<!-- Sélection du css à afficher -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" href="img/favicon.png" />
		<?php echo '<link rel="stylesheet" href="css/styleDEF.css">' ?>

		<script src="js/jquery-3.0.0.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

		<title>Emploi du temps</title>
  </head>

	<body>

		<!-- Affichage de l'en-tête -->
		<div class="EnTete">
			<?php include('header/headerDEF.php'); ?>
		</div>

		<div>
			<!-- Affichage de la timeline -->
			<div class="timeline">
				<ul>
					<li><span>08:00</span></li>
					<li><span>08:30</span></li>
					<li><span>09:00</span></li>
					<li><span>09:30</span></li>
					<li><span>10:00</span></li>
					<li><span>10:30</span></li>
					<li><span>11:00</span></li>
					<li><span>11:30</span></li>
					<li><span>12:00</span></li>
					<li><span>12:30</span></li>
					<li><span>13:00</span></li>
					<li><span>13:30</span></li>
					<li><span>14:00</span></li>
					<li><span>14:30</span></li>
					<li><span>15:00</span></li>
					<li><span>15:30</span></li>
					<li><span>16:00</span></li>
					<li><span>16:30</span></li>
					<li><span>17:00</span></li>
					<li><span>17:30</span></li>
					<li><span>18:00</span></li>
					<li><span>18:30</span></li>
					<li><span>19:00</span></li>
					<li><span>19:30</span></li>
					<li><span>20:00</span></li>
					<li><span>20:30</span></li>
					<li><span>21:00</span></li>
					<li><span>21:30</span></li>
				</ul>
			</div>

			<!-- Affichage du calendrier -->
			<div class="events">
				<ul>
					<?php afficheCalendrier($bdd); ?>
				</ul>
			</div>

		</div>

		<!-- Afichage du pied de page -->
		<footer class="PiedDePage">
			<?php include('footer/footerDEF.php'); ?>
		</footer>

	</body>

</html>
