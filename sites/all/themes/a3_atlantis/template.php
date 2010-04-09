<?php
// $Id: template.php,v 1.1.4.5 2008/08/23 20:58:56 johnforsythe Exp $
// A3 Atlantis
// John Forsythe, john [at] blamcast [dot] net

// We need jQuery included on all admin pages.
if (arg(0) == 'admin') {
  drupal_add_js('misc/jquery.js');
}
