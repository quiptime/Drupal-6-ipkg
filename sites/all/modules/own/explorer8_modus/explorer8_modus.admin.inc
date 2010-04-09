<?php 
// $Id: explorer8_modus.admin.inc, v 1.2 2009/07/20 21:28:56 quiptime $ 

/**
 * @file
 * 
 * The module admin settings.
 */

/**
 * Menu callback, called from explorer8_modus_menu().
 */
function explorer8_modus_settings() {
  $form['explorer8_modus_setting'] = array(
    '#type' => 'radios',
    '#title' => t('Document compatibility modus'),
    '#options' => array(
      'IE=5' => t('IE 5.<br />The code for the page is like the Quirks mode in Internet Explorer 7 is displayed.'),
      'IE=7' => t('IE 7.<br />The code of the page as if by the standards mode in Internet Explorer 7 is displayed, without taking into account the/a DOCTYPE statement.'),
      'IE=8' => t('IE 8.<br />The IE8- or IE8-standards mode. This is the default for Internet Explorer 8 [1] [2] [3].'),
      'IE=EmulateIE7' => t('Emulate IE 7.<br />The code of the page like Internet Explorer 7 appears, however, considering the / a DOCTYPE specification (the standard mode, as displayed by IE7 and Quirks mode, as indicated by the IE 5).'),
      'IE=EmulateIE9' => t('Emulate IE 8.<br />Does the website a standard DOCTYPE indication, it appears in "IE8 mode, the other in Quirks mode (IE5 mode) are shown.'),
    ),
    '#default_value' => variable_get('explorer8_modus_setting', 'IE=8'),
    '#description' => t('Please choose the explorer version for the document compatibility modus.<br />If "IE 8" is used then there is no entry of an additional HTML tag in the header.')
  );
  return system_settings_form($form);
}
