<!--

importICS.php : Routine d'imporation des fichiers ics dans la base de données

Version : 1.0

Date dernière modification : 15/01/2018

-->

<?php

	// Include des fichiers de connections à la BDD
	include_once 'includes/config.php';
	include_once 'includes/db_connect.php';

	// Lecture de chaque fichier du dossier ics, mise en forme des données et enregistrement dans la BDD
	$listeFichiers = scandir('ics');
	for ($noFichier = 2 ; $noFichier < count($listeFichiers) ; ++$noFichier)
	{
		/*Réinitialisation des variables */
		unset($start);
		unset($end);
		unset($location);
		unset($summary);
		unset($description);
		unset($descGroupe);
		unset($descIntervenant);
		unset($chevauchement);

		if ($fichier = fopen('ics/'.$listeFichiers[$noFichier], 'r'))
		{

			/* Récupération du numéro de ressource dans le nom du fichier */
			$ressource = substr($listeFichiers[$noFichier], strpos($listeFichiers[$noFichier], '=') + 1, strpos($listeFichiers[$noFichier], '&') - strpos($listeFichiers[$noFichier], '=') - 1);

			/* Appel de la procedure pour supprimer les évènements */
			$stmt = $bdd->prepare('CALL deleteData(:ressource)');
			$stmt->bindValue(':ressource', $ressource);
			$stmt->execute();

			$n = 0;
			/* Boucle de lecture du fichier ligne par ligne */
			while($ligne = fgets($fichier))
			{
				/* Détection des en-tetes du fichier ICS et mise en forme des données */
				if (strstr($ligne, 'DTSTART'))
					$start[$n] = date_create_from_format('Ymd?Gi',substr($ligne,8,13));
				if (strstr($ligne, 'DTEND'))
					$end[$n] = date_create_from_format('Ymd?Gi', substr($ligne,6,13));
				if (strstr($ligne, 'LOCATION'))
					$location[$n] = str_replace('LANGUAGE=fr:', '', substr($ligne, 9, strlen($ligne)-11)); // Supression des '\'
				if (strstr($ligne, 'SUMMARY'))
					$summary[$n] = str_replace('LANGUAGE=fr:', '', substr($ligne, 8, strlen($ligne)-10)); // Supression de 'LANGUAGE=fr:''
				if (strstr($ligne, 'DESCRIPTION'))
				{

					$description[$n] = substr($ligne, 14, strlen($ligne)-16);
					/* Si le champs description est sur deux lignes */
					while(!strstr($ligne = fgets($fichier), 'UID'))
						$description[$n] = $description[$n] . substr($ligne, 1, strlen($ligne)-3); // Supression de l'espace au début de la ligne

					/* Séparation du champs description en 2 parties : groupe, intervenant*/
					$temp = explode('\n', $description[$n]);

					$descGroupe[$n] = $temp[0];
					$descIntervenant[$n] = '';

					if (count($temp) > 2)
						for ($i = 1 ; $i < count($temp)-1 ; ++$i)
							$descIntervenant[$n] = $descIntervenant[$n] . $temp[$i] . '<br/ >';

					++$n;
				}
			}

			fclose($fichier);

		}

			$dateMin = new DateTime("9999-01-01");
			$dateMax = new DateTime("2000-01-01");
			$heureMin = new DateTime("06:00");
			$heureMax = new DateTime("16:30");

			for ($j = 0 ; $j < count($start); ++$j)
			{
				// Initialisation de chevauchement
				$chevauchement[$j] = 0;
			}

			$mem = array('', '', '');

			// On parcourt toute les dates du début a la fin par tranche de 5min pour détecter un chevauchement d'évènement
			for($i = clone($dateMin) ; $i < $dateMax ; $i->modify('+5 minutes'))
			{
					$cpt = 0;
					$m = 0;
					for ($j = 0 ; $j < count($start) ; ++$j)
					{

						if  (($i->format("YmdGi") > $start[$j]->format("YmdGi")) && ($i->format("YmdGi") < $end[$j]->format("YmdGi")) && ($i->format("Ymd") == $start[$j]->format("Ymd")))
						{
							$cpt = $cpt + 1;
							if ($cpt < 4)
							{
								$mem[$m] = $j;
								$m = $m + 1;
							}
							else
								$cpt = 3;
						}
					}
					for ($j = 0 ; $j < $m ; ++$j)
						if ($chevauchement[$mem[$j]] < $cpt-1)
							$chevauchement[$mem[$j]] = $cpt-1;
			}

			/* Ecriture dans la base de données */
			for ($i = 0 ; $i < count($start) ; ++$i)
			{
				$stmt = $bdd->prepare('CALL insertData(:ressource, :dtStart, :dtEnd, :summary, :location, :descGroupe, :descIntervenant, :chevauchement)');
				$stmt->bindValue(':ressource', $ressource);
				$stmt->bindValue(':dtStart', date_format($start[$i], 'Y-m-d G:i'));
				$stmt->bindValue(':dtEnd',  date_format($end[$i], 'Y-m-d G:i'));
				$stmt->bindValue(':summary', $summary[$i]);
				$stmt->bindValue(':location', $location[$i]);
				$stmt->bindValue(':descGroupe', is_null(0));
				$stmt->bindValue(':descIntervenant', is_null(0));
				$stmt->bindValue(':chevauchement', $chevauchement[$i]);
				$stmt->execute();
			}
	 }

?>
