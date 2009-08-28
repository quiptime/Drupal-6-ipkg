<?php
// $Id: i18ntaxonomy.translation404.inc,v 1.2 2009/04/04 07:16:36 gavri Exp $ 
/** 
* @file 
* translation404 module. 
* 
* Enable only if i18ntaxonomy.module is enabled.
*	mange taxonomy specific menu items - $items['taxonomy/term/%'] 
*
* Set different action according to vocabulary type
* 1. Type: None. No multilingual options for this vocabulary.
*  	 Action: Don't do anything.
* 2. Type: Localize terms. Terms are common for all languages, but their name and description may be localized.
*    Action: Don't do anything.	
* 3. Type: Per language terms. Different terms will be allowed for each language and they can be translated.
*    Action:	Don't do anything.
* 4. Type: Set language to vocabulary. The vocabulary will have a global language and it will only show up for pages in that language.
*    Action Taken: Always shot t404 page for other languages
*/

/**
 * Implementation of hook_translation404api().
 */
function i18ntaxonomy_translation404api($op, $a3 = NULL, $a4 = NULL) {
  $stored = NULL; //optional array to pass static var for the t404 page usfull for tarnslate this term link
  $return = array();
  switch ($op) {
    case 'populate_links':
      //check if the current page path is taxonomy/term/%
      if ((preg_match("!^taxonomy/term/([0-9]+)(/.+|)$!", $a4, $matches)) && ($term = taxonomy_get_term((int)$matches[1]))) {
        switch (i18ntaxonomy_vocabulary($term->vid)) {
          // Predefined language for all terms 
          case I18N_TAXONOMY_LANGUAGE:
            foreach (language_list() as $language) {
              $a3[$language->language]['href'] = TRANSLATION_NOT_FOUND;
            }
            break;
            // Multilingual terms, translatable
            case I18N_TAXONOMY_TRANSLATE:
              //check if term isn't neutral (for neutral terms dont apply t404 link)
              if ($term->language) {
                foreach (language_list() as $language) {
                  if (!i18ntaxonomy_translation_term_tid($term->tid, $language->language)) {
                    $a3[$language->language]['href'] = TRANSLATION_NOT_FOUND;
                  }
                  $stored = array(
                    'type' => 'term',
                    'vid' => $term->vid,
                    );
                }
              }
            // Run through the localization system
            // Action is controled threw t404 admin settings
            // this can be set to take action if there isn't any Translation for the term.
            // the default is to take no action
            case I18N_TAXONOMY_LOCALIZE:
              break;
            // No multilingual options
            // palce holder - for noe take no action
            case I18N_TAXONOMY_NONE:
              break;
            }
            $return = array('links' => $a3, 'stored' => $stored);
          }
          break;
        case 'added_page_links':
        //if directed from node page and node is translatable and user have permmisions (stored in the session) add a translation link
          if ($a4['type'] == 'term' && user_access('translate content')) {
            $links = array(
            'translate_node' => array(
              'title' => t('Go to terms Translations to Translate This term'),
              'href' => 'admin/content/taxonomy/'. $a4['vid'] .'/translation',
              ));
            $return = $links;
          }
        break;
        }
  return  $return;
}