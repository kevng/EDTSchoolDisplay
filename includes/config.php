<!--

config.php : Déclaration des constantes et et récupération des données de l'URL

Version : 1.0

Date dernière modification : 25/01/2018

-->

<?php

/* Définition de constantes */
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "root"); /* fip2018! */
define("DATABASE", "event"); /* EDT */

/* Récupération des infos de l'URL */

if (isset($_GET['formation']))
	define("URL_FORMATION", $_GET['formation']);
else
	define("URL_FORMATION", '');

if (isset($_GET['majeure']) && isset($_GET['groupe']))
	define("URL_MAJEURE", $_GET['majeure']);
else
	define("URL_MAJEURE", '');

if (isset($_GET['groupe']))
{
	$listeGroupe = explode(' ', $_GET['groupe']);
	sort($listeGroupe);
	$listeGroupe = implode(' ', $listeGroupe);
	define("URL_GROUPE", $listeGroupe);
}
else
	define("URL_GROUPE", '');

if (isset($_GET['semaine']))
	define("URL_SEMAINE", $_GET['semaine']);
else
	define("URL_SEMAINE", 0);
?>
