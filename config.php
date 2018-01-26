<!--

config.php : Page de configuration pour les messages

Version : 1.0

Date dernière modification : 18/01/2018

-->

<!DOCTYPE html>

<!-- Include des fichiers de connections à la BDD -->
<?php
  include_once 'includes/config.php';
  include_once 'includes/db_connect.php';
?>

<html>
  <head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/favicon.png" />
    <link rel="stylesheet" href="css/config.css">
    <link rel="stylesheet" href="css/header-basic.css">
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <title>Configuration des messages et evenements</title>
  </head>

  <body>

    <header>
        <h1 class="titre">Configuration des messages</h1><hr \>
    </header>

    <!-- Récupération des trois messages de la bdd dans des variables -->
    <?php
      $stmt = $bdd->query('SELECT message FROM Message');
      for ($i = 0 ; $i < 3 ; ++$i)
      {
        $donnees = $stmt->fetch();
        $tabMessage[$i] = $donnees['message'];
      }
     ?>

     <!-- Formulaire de saisi avec boutons -->
    <div class="container">
      <legend>Envoi de messages (160 caractères max) : </legend>

            <form role="form" class="form-vertical" method="post" action="#">
                <div class="form-group">
                  <input type="text" class="form-control" name="message1" placeholder="Message 1 ..." value="<?php echo $tabMessage[0] ?>" maxlength="160"/>
                </div>
                <input type="submit" class="btn btn-primary" name="envoyerMessage1" value="Envoyer" />
                <input type="submit" class="btn btn-primary" name="effacerMessage1" value="Effacer" />
              </form>

              <form role="form" class="form-vertical" method="post" action="#">
                <div class="form-group">
                  <input type="text" class="form-control" name="message2" placeholder="Message 2 ..." value="<?php echo $tabMessage[1] ?>" maxlength="160"/>
                </div>
                <input type="submit" class="btn btn-primary" name="envoyerMessage2" value="Envoyer" />
                <input type="submit" class="btn btn-primary" name="effacerMessage2" value="Effacer" />
              </form>

              <form role="form" class="form-vertical" method="post" action="#">
                <div class="form-group">
                  <input type="text" class="form-control" name="message3" placeholder="Message 3 ..." value="<?php echo $tabMessage[2] ?>" maxlength="160"/>
                </div>
                <input type="submit" class="btn btn-primary" name="envoyerMessage3" value="Envoyer" />
                <input type="submit" class="btn btn-primary" name="effacerMessage3" value="Effacer" />
              </form>

            <legend>Affichage actuel :</legend>

              <!-- Insertion de la zone message -->
              <div class="zoneMessages">
                <?php include('footer/footerMessages.php'); ?>
              </div>

            <p>Après modification, les messages s'affichent sur l'écran après un délai de 1 minute maximum.</p>
          </div>

        <?php

          // Action des boutons (appel de la procédure modifMessage)
          if(isset($_POST['envoyerMessage1']))
          {
            $stmt = $bdd->prepare('CALL modifMessage(:IDMessage, :message)');
            $stmt->bindValue(':IDMessage', 1);
            $stmt->bindValue(':message', $_POST['message1']);
            $stmt->execute();
            header("Refresh:0");
          }
          if(isset($_POST['envoyerMessage2']))
          {
            $stmt = $bdd->prepare('CALL modifMessage(:IDMessage, :message)');
            $stmt->bindValue(':IDMessage', 2);
            $stmt->bindValue(':message', $_POST['message2']);
            $stmt->execute();
            header("Refresh:0");
          }
          if(isset($_POST['envoyerMessage3']))
          {
            $stmt = $bdd->prepare('CALL modifMessage(:IDMessage, :message)');
            $stmt->bindValue(':IDMessage', 3);
            $stmt->bindValue(':message', $_POST['message3']);
            $stmt->execute();
            header("Refresh:0");
          }

          if(isset($_POST['effacerMessage1']))
          {
            $stmt = $bdd->prepare('CALL modifMessage(:IDMessage, :message)');
            $stmt->bindValue(':IDMessage', 1);
            $stmt->bindValue(':message', '');
            $stmt->execute();
            header("Refresh:0");
          }
          if(isset($_POST['effacerMessage2']))
          {
            $stmt = $bdd->prepare('CALL modifMessage(:IDMessage, :message)');
            $stmt->bindValue(':IDMessage', 2);
            $stmt->bindValue(':message', '');
            $stmt->execute();
            header("Refresh:0");
          }
          if(isset($_POST['effacerMessage3']))
          {
            $stmt = $bdd->prepare('CALL modifMessage(:IDMessage, :message)');
            $stmt->bindValue(':IDMessage', 3);
            $stmt->bindValue(':message', '');
            $stmt->execute();
            header("Refresh:0");
          }
          ?>

          <header>
              <h1 class="titre">Configuration des evenements</h1><hr\>
          </header>

          <!-- Récupération de l'evenement de la bdd -->
          <?php
            $stmt = $bdd->query('SELECT evenement FROM Evenement');
            $donnees = $stmt->fetch();
            $tabEvenement[0] = $donnees['evenement'];
           ?>

          <!-- Formulaire de saisi avec boutons -->
         <div class="container">
           <legend>Envoi du lien vers l'evenement à mettre en avant : </legend>

                 <form role="form" class="form-vertical" method="post" action="#">
                     <div class="form-group">
                       <input type="text" class="form-control" name="evenement" placeholder="Evenement ..." value="<?php echo $tabEvenement[0] ?>" maxlength="160"/>
                     </div>
                     <input type="submit" class="btn btn-primary" name="envoyerEvenement" value="Envoyer" />
                     <input type="submit" class="btn btn-primary" name="effacerEvenement" value="Effacer" />
                </form>

              <legend>Evenement actuel :</legend>
              <!-- Insertion de la zone message -->
              <div class="zoneMessages">
                <?php
                $stmt = $bdd->query('SELECT DATE_FORMAT(dateMessage, "%d/%m/%Y %Hh%i") AS date, evenement FROM Evenement');
                while ($donnees = $stmt->fetch())
                  if ($donnees['evenement'] != '')
                    echo $donnees['date'] . ' : ' . $donnees['evenement'] . '<br \>';
                     ?>
              </div>

            </div>

            <?php

              // Action des boutons (appel de la procédure modifEvenement)
              if(isset($_POST['envoyerEvenement']))
              {
                $stmt = $bdd->prepare('CALL modifEvenement(:IDEvenement, :evenement)');
                $stmt->bindValue(':IDEvenement', 1);
                $stmt->bindValue(':evenement', $_POST['evenement']);
                $stmt->execute();
                header("Refresh:0");
              }
              if(isset($_POST['effacerEvenement']))
              {
                $stmt = $bdd->prepare('CALL modifEvenement(:IDEvenement, :evenement)');
                $stmt->bindValue(':IDEvenement', 1);
                $stmt->bindValue(':evenement', '');
                $stmt->execute();
                header("Refresh:0");
              }
          ?>

  </body>
</html>
