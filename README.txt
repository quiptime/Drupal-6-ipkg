Drupal 6 Ipkg

  "Drupal 6 Ipkg" ist ein Drupal 6 Installer mit dem nach verschiedenen Installationsprofilen
  unterschiedliche Drupal 6 Varianten installiert werden können.

  "Drupal 6 Ipkg" enthält eine komplette Drupal 6 Version mit mehreren Installationsprofilen.

  Mit anderen Worten: "Drupal 6 Ipkg" erweitert den Installationsprozess von Drupal.

KONFIGURATIONEN

  Verfügbare Installationsprofile

  - Standard
  - Standard i18n
  - SEO

DOWNLOAD

  Im Drupal root befinden sich die 2 Dateien .gitignore und README.txt. Die README.txt lesen sie gerade
  und .gitignore dient der Verwaltung dieses Repository. Beide Dateien können gelöscht werden.

BESONDERHEIT

  Die Profil-Module und die optionalen Module und Themes werden während der Installation von drupal.org
  heruntergeladen und installiert.

  Daraus ergibt sich:

  Alle Ordner und Dateien die per Download installiert werden müssen nach der Installation (in der
  Drupal-Installation) mit den entsprechenden Rechten (Besitzer/Gruppe) versehen werden.

  Erfolgt dies nicht
  können diese Ordner und Dateien nicht, beispielsweise per FTP, verarbeitet werden.

  Tipp

    Shared Webhoster bieten in der Regel eine Möglichkeit bzw. ein Tool um Ordner und Dateien dem
    Benutzer des Webaccount zuzuordnen.

    Linux ssh/shell:

    chown -R correct_owner:correct_group sites/all/modules/contrib
    chown -R correct_owner:correct_group sites/all/themes

EPILOG

  Viel Erfolg beim Installieren von Drupal wünscht die

  Quiptime Group
