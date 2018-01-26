<!--

createListeUrl.php : Routine de création de la liste d'url ics à télécharger

Version : 1.0

Date dernière modification : 15/01/2018

-->

<?php

include_once 'includes/config.php';
include_once 'includes/db_connect.php';

// Pour chaque entrée dans la table Ressource, on met en forme l'url et on l'écrit dans le fichier listeUrl

$req = 'SELECT ressource FROM Ressource';
$stmt = $bdd->query($req);

if ($fichier = fopen('listeUrl', 'w'))
{
  while ($donnees = $stmt->fetch())
  {
    $ligne = 'https://adewebcons.unistra.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources='.$donnees['ressource'].'&projectId=8&calType=ical&nbWeeks=4' . "\n";
    fputs($fichier, $ligne);
  }
}

?>
