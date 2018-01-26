<!--

footerMessages.php : Affichage de la zone de message en pied de page

Version : 1.0

Date dernière modification : 18/01/2018

-->

  <?php
  // Include des fichiers de connections à la BDD
  include_once '/var/www/html/EDT/includes/config.php';
  include_once '/var/www/html/EDT/includes/db_connect.php';

    // Récupération des messages dans la base et affichage
    $stmt = $bdd->query('SELECT DATE_FORMAT(dateMessage, "%d/%m/%Y %Hh%i") AS date, message FROM Message');
    while ($donnees = $stmt->fetch())
      if ($donnees['message'] != '')
        echo $donnees['date'] . ' : ' . $donnees['message'] . '<br \>';
   ?>
