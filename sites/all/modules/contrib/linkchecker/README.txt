; $Id: README.txt,v 1.2.2.6 2009/07/19 17:06:58 hass Exp $

Link Checker
------------

Installation:

1. Place the entire linkchecker folder into your modules directory.
2. Go to Administer -> Site building -> Modules and enable the Link checker module.
3. Go to Administer -> Site configuration -> Link checker and enable the node types to scan.
4. Check all HTML tags that should be scanned.
5. Adjust the other parameters if the defaults don't suit your needs.
6. Save configuration
7. Wait for cron to check all your links... this may take some time! :-)

If links are broken they should appear after a while under this url:
http://example.com/admin/reports/linkchecker

If not, make sure the cron is configured and running properly on your Drupal
installation. The Link checker module also logs somewhat useful info about it's
activity under Administer -> Reports -> Recent log entries.


Known issues:

1. drupal_http_request() does handle (invalid) non-absolute redirects, http://drupal.org/node/164365
   Until this issue is fixed in core the permanently moved links are not
   automatically updated by the "Update permanently moved links" feature
   to the newly provided URL.
   -> Solution: Manually fix these links or apply the patch.
