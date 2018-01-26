<!--

db_connect.php : Connexion à la base de données

Version : 1.0

Date dernière modification : 15/01/2018

-->

<?php

try
{
	$bdd = new PDO('mysql:host='.HOST.';dbname='.DATABASE.';charset=utf8', USER, PASSWORD);
}
catch(Exception $e)
{
	die('Erreur : '.$e->getMessage());
}

?>
