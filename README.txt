Drupal 6 ipkg

  "Drupal 6 ipkg" ist ein Drupal 6 Installer mit dem nach verschiedenen Installationsprofilen
  unterschiedliche Drupal 6 Varianten in Deutsch oder Englisch installiert werden können.

  "Drupal 6 ipkg" enthält eine komplette Drupal 6 Version mit mehreren Installationsprofilen.

  Mit anderen Worten: "Drupal 6 ipkg" erweitert den Installationsprozess von Drupal.

KONFIGURATIONEN

  Verfügbare Installationsprofile

  - Standard
  - Standard i18n
  - SEO

DOWNLOAD

  Im Drupal root befinden sich die 2 Dateien .gitignore und README.txt. Die README.txt lesen sie gerade
  und .gitignore dient der Verwaltung dieses Repository. Beide Dateien können gelöscht werden.

  In der Nebennavigation kann in "all branches" eine Version von "Drupal 6 ipkg" gewählt werden. Die
  Version dev entspricht dem aktuellen Entwicklungsstand.

VOR DER INSTALLATION

  Alle Dateien von "Drupal 6 ipkg" befinden entpackt sich am Ort der Website.

  Um nervige Fehlermeldungen während der Installation zu vermeiden bzw. einen reibungslosen Ablauf der
  Drupalinstallation zu organisieren sind folgende Dinge zu tun:

  1. Berechtigungen setzen

    Die Verzeichnisse

    * sites/all/default/files
    * sites/all/modules/contrib
    * sites/all/modules/own
    * sites/all/themes

   müssen für Webapplikationen (Drupal) beschreibbar sein.

   2. Konfigurationsdatei

   Die Datei sites/all/default/settings.php muss als Kopie der Datei sites/all/default/default.settings.php
   erstellt werden und muss ebenfalls für Webapplikationen (Drupal) beschreibbar sein.

   Sind die Aufgaben nach Pkt. 1 und Pkt. 2 erledigt kann die Installation starten mit dem Aufruf von:

   URL_der_neuen_Drupalwebsite/install.php

NACH DER INSTALLATION

  Bitte Nachfolgendes in "Besonderheit" lesen.

BESONDERHEIT

  Die Profil-Module und die optionalen Module und Themes werden während der Installation von drupal.org
  heruntergeladen und installiert.

  Daraus ergibt sich:

  Alle Ordner und Dateien die per Download installiert werden müssen nach der Installation (in der
  Drupal-Installation) mit den entsprechenden Rechten (Besitzer/Gruppe) versehen werden.

  Erfolgt dies nicht
  können diese Ordner und Dateien nicht, beispielsweise per FTP, verarbeitet werden.

  Installationsverzeichnisse:

  sites/all/modules/contrib
  sites/all/themes

  Einfacher Test zum Überprüfen:

  Vergleichen Sie die Datei "install.php" mit den Installationsverzeichnissen.

  TIPP

    Shared Webhoster bieten in der Regel eine Möglichkeit bzw. ein Tool um Ordner und Dateien dem
    Benutzer des Webaccount zuzuordnen.

    Linux ssh/shell:

    chown -R correct_owner:correct_group sites/all/modules/contrib
    chown -R correct_owner:correct_group sites/all/themes

SCREENSHOTS

  http://www.flickr.com/photos/quiptime/3863801698/
  http://www.flickr.com/photos/quiptime/3863801678/
  http://www.flickr.com/photos/quiptime/3863801682/
  http://www.flickr.com/photos/quiptime/3863801684/

EPILOG

  Viel Erfolg beim Installieren von Drupal wünscht die

  Quiptime Group
