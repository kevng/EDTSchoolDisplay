<!--

headerDEF.php : En-tete par défaut, affichage de la date du jour, de la formation et de la semaine affichée

Version : 1.0

Date dernière modification : 18/01/2018

-->

<?php

  $listeGroupe = explode(' ', URL_GROUPE);
  $nbGroupe = count($listeGroupe);
  $texteGroupe = '';

  for ($i=0 ; $i<$nbGroupe ; ++$i)
    $texteGroupe = $texteGroupe . $listeGroupe[$i] . ' + ';

  setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');

  if (URL_SEMAINE == 1) $texteSemaine = 'Semaine prochaine';
  elseif (URL_SEMAINE == 0) $texteSemaine = 'Semaine courante';
  else $texteSemaine = '';

  echo '<span class="headerDate">'. strftime("%A %d %B %Y") . '</span>';

  if (isset($_GET['ressource']))
    echo 'Ressource : ' . $_GET['ressource'];
  elseif (URL_FORMATION == "sallesDispos") echo $texteGroupe = 'salles disponibles';
  else
    echo  URL_FORMATION . ' ' . URL_MAJEURE . ' ' . substr($texteGroupe, 0, strlen($texteGroupe) - 3);


  echo '<span class="headerSemaine">' . $texteSemaine . '</span>';

?>
