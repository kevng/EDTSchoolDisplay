#!/bin/bash


# importData.sh : Routine de téléchargement des ics et enregistrement dans la base de données
#
# Version : 1.0
#
# Date dernière modification : 15/01/2018
#

# On se place dans le bon dossier
cd /var/www/html/EDT

# Appel de la fonction createListeUrl.php
#php createListeUrl.php
# Changement du owner de tout les fichiers ics pour pouvoir les écraser
#sudo chown -R pi ics

# wget : téléchargement de fichiers depuis une url
# -q : mode quiet
# -N : Ecraser les fichiers existants si ils ont changé
# --timeout : Timeout en s
# -i : récupérer la liste des url dans le fichier spécifié
# -P : Enregister les fichiers téléchargés dans le dossier spécifié
#if wget -N --timeout=30 -i listeUrl -P ics/ ; then
  # Si le téléchargement s'est bien terminé, on appel le programme importICS
  php importICS.php
#fi
