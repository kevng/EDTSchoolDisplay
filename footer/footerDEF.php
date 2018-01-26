<!--

footerAPP.php : Affichage du pied de page pour les Apprentis

Version : 1.0

Date dernière modification : 17/01/2018

-->

<!-- Affichage des boutons -->
<div class="container">

  <div class="boutonSalleLibre" annee="boutonSalleLibre">
    <span class="aligner">
      <?php
      $texteBouton = '';
      if (URL_FORMATION == "sallesDispos") echo $texteBouton = "<a href=\"index.php\">retour</a>";
      else echo $texteBouton = "<a href=\"main.php?formation=sallesDispos\">Salles libres</a>";
       ?>
     </span>
    <!-- <span class="aligner">Salles Libres</span>
  <a href="http://10.4.69.147/EDT/main.php?formation=sallesDispos">-->
  </div>

</div>

<!-- Affichage de la zone message -->
<div class="zoneMessages">
  <?php include('footer/footerMessages.php'); ?>
</div>
