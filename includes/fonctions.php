<!--

fonctions.php : déclaration des fonctions

Version : 1.0

Date dernière modification : 17/01/2018

-->

<?php

	// Fonction d'affichage du calendrier
	function afficheCalendrier($bdd)
	{
		$semaine = URL_SEMAINE;
		$jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
		for ($noJour = 0 ; $noJour < sizeof($jours) ; ++$noJour)
		{
			//echo $noJour;
				// Mise en forme de la première ligne (lundi, mardi...)
				$debut_fin_semaine = get_lundi_vendredi_from_week(strftime("%W")+$semaine, strftime("%Y"));
				echo '<li class="events-group">';
				echo '<div class="top-info" majeure=' . URL_MAJEURE . '><span>' . $jours[$noJour] . ' ' . $debut_fin_semaine[$noJour] . '</span></div>';
				echo '<ul>';

				// Création de la requète de récupération des données
				//$req = 'SELECT TIME(DATE_ADD(dtstart, INTERVAL 2 HOUR)) AS dtstart, TIME(DATE_ADD(dtend, INTERVAL 2 HOUR)) AS dtend, summary, location, descGroupe, descIntervenant, chevauchement FROM Calendrier NATURAL JOIN Ressource WHERE WEEKDAY(dtStart) = ' . $noJour . ' AND WEEK(dtstart) = WEEK(SYSDATE()) + ' . $semaine . ' AND formation = \'' . URL_FORMATION . '\' AND annee = \'' . URL_ANNEE . '\' AND groupe = \'' . URL_GROUPE . '\' ORDER BY dtStart';
			$req = "SELECT TIME(DATE_ADD(dtStart, INTERVAL 2 HOUR)) as dtStart, TIME(DATE_ADD(dtEnd, INTERVAL 2 HOUR)) as dtEnd, IDEvent, location, summary, formation, chevauchement, descGroupe, descIntervenant, majeure, groupe from Calendrier natural join Ressource where WEEKDAY(dtStart) = ' . $noJour . ' AND WEEK(dtStart) = WEEK(SYSDATE()) + '. $semaine .' AND formation = '".URL_FORMATION."' order by dtStart";
				$stmt = $bdd->query($req);

				while ($donnees = $stmt->fetch())
				{
					?>
						<li class="single-event" data-start=<?php echo $donnees['dtStart']; ?> data-end=<?php echo $donnees['dtEnd']; ?> data-groupe=<?php echo '"' . $donnees['descGroupe']. '"'; ?> data-chevauchement=<?php echo 'chevauchement-' . $donnees['chevauchement']; ?> >
							<em class="textblock">
								<em class="event-summary"><?php echo $donnees['summary']; ?></em>
								<em class="event-descGroupe"><?php echo $donnees['descGroupe']; ?></em>
								<em class="event-location"><?php echo $donnees['location']; ?></em>
								<em class="event-descIntervenant"><?php echo $donnees['descIntervenant']; ?></em>
							</em>
						</li>
					<?php
				}

				echo '</ul>';
				echo '</li>';
		}
	}

	// Fonction qui retourne la date du lunid au samedi de la semaine en paramètre
	function get_lundi_vendredi_from_week($week,$year,$format="d/m/Y")
	{

		$firstDayInYear=date("N",mktime(0,0,0,1,1,$year));
		if ($firstDayInYear<5)
		$shift=-($firstDayInYear-1)*86400;
		else
		$shift=(8-$firstDayInYear)*86400;
		if ($week>1) $weekInSeconds=($week-1)*604800; else $weekInSeconds=0;
		$timestamp=mktime(0,0,0,1,1,$year)+$weekInSeconds+$shift;
		$timestamp_mardi=mktime(0,0,0,1,2,$year)+$weekInSeconds+$shift;
		$timestamp_mercredi=mktime(0,0,0,1,3,$year)+$weekInSeconds+$shift;
		$timestamp_jeudi=mktime(0,0,0,1,4,$year)+$weekInSeconds+$shift;
		$timestamp_vendredi=mktime(0,0,0,1,5,$year)+$weekInSeconds+$shift;
		$timestamp_samedi=mktime(0,0,0,1,6,$year)+$weekInSeconds+$shift;

		return array(date($format,$timestamp), date($format,$timestamp_mardi), date($format,$timestamp_mercredi), date($format,$timestamp_jeudi), date($format,$timestamp_vendredi), date($format,$timestamp_samedi));

	}

?>
