<?php
// $Id: node.translation404.inc,v 1.6 2009/04/05 19:36:02 gavri Exp $ 
/** 
*@file 
*translation404 module. 
*/

/**
 * Implementation of hook_translation404api().
 */
function node_translation404api($op, $a3 = NULL, $a4 = NULL) {
  $stored = NULL; //optional array to pass static var for the t404 page usfull for tarnslate this node link
  $return = array();
  switch ($op) {
    case 'populate_links':
      //$a3 is $links and $a4 is $path
      //check if the current page is a node
      if ((preg_match("!^node/([0-9]+)(/.+|)$!", $a4, $matches)) && ($node = node_load((int)$matches[1]))) {
        //by default apply only on translatable node types - or on all node types in case of setteing change
        foreach (node_get_types() as $node_type) {
          if (translation_supported_type($node_type->type)) {
            $options[$node_type->type] = $node_type->name;
          }
        }
        //gets the data from teh settings form to see of to operate on the data r not
        $stored_settings = variable_get('translation404_node_types', $options);
        if ($stored_settings[$node->type]) {
          $languages = language_list();
          //pass info to links on page
          if (translation_supported_type($node->type)) {
            $stored = array(
              'type' => 'node',
              'nid' => $node->nid,
            );
          }
          //first check that this node have any transltions if not retrun Translation page not found for all the other langauges
          //and if this node isnot set to language neutral.
          if (empty($node->tnid) && !empty($node->language)) {
            //The node doen't have translation
            foreach (language_list() as $language) {
              //we set all links including the current lang as translation page not dound
              // the calling fuction (translation404_translation_link_alter())
              //is taking care of that at this line - $links[$langcode]['href'] = $current_page;
              $a3[$language->language]['href'] = TRANSLATION_NOT_FOUND;
            }
          }
          elseif (!empty($node->language)) {
            //The node has at least one Translation
            //check to see if all nodes have translation - and for the ones that don't - retrun Translation page not found
            $translations = translation_node_get_translations($node->tnid);
            foreach (language_list() as $language) {
                $language_name = $language->name;
                if (empty($translations[$language->language]->nid)) {
                 $a3[$language->language] = array (
                    'href'       => TRANSLATION_NOT_FOUND,
                     'title'      => $language->native,
                     'language'   => $language,
                     'attributes' => array('class' => 'language-link'),
                  );
                }
            }
          }
        }
      }
      $languages = language_list('enabled');
      //dsm($languages);
      $return = array('links' => $a3, 'stored' => $stored);
      break;
    case 'settings_form':
      foreach (node_get_types() as $node_type) {
        if (translation_supported_type($node_type->type)) {
          $options[$node_type->type] = $node_type->name;
        }
      }
      $form['translation404_node_types'] = array(
        '#type' => 'checkboxes', 
        '#title' => t('Node Specific settings - Choose on which node types to act'),
        '#options' => $options,
        '#default_value' => variable_get('translation404_node_types', $options),
        '#description' => t('Only matters if node for translation_404 upper checkbox is enabled.'),
      );
       $return = $form;
      break;
    case 'added_page_links':
      //if directed from node page and node is translatable and user have permmisions (stored in the session) add a translation link
      if ($a4['type'] == 'node' && user_access('translate content')) {
        $links = array(
           'translate_node' => array(
             'title' => t('Translate this node'),
             'href' => 'node/'. $a4['nid'] .'/translate',
          ));
         $return = $links;
      }
      break;
  }
  return  $return;
}