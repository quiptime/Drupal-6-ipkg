<?php 
// $Id: translation404.admin.inc,v 1.1 2009/03/08 20:36:09 gavri Exp $ 
/** 
*@file 
*Administration page callbacks for the translation404 module. 
*/ 
/** 
*Form builder. Configure translation404 settings
* 
*@ingroup forms 
*@see system_settings_form(). 
*/
// 
//  translation404.admin.inc
//  «project»
//  
//  Created by gavri on 2009-02-12.
//  Copyright 2009 Linnovate. All rights reserved.
// 
 
function translation404_admin_settings() { 
  $form['overview'] = array(
    '#prefix' => '<h4 class="translation404-overview">', 
    '#value' => theme('advanced_help_topic', 'translation404', 'about-translation404') . t('Mange page translation not found'),
    '#suffix' => '</h4>', 
    
  );
  $form['translation404_default_path'] = array(
    '#type' => 'textfield',
    '#title' => t('Default Translation (not found) page'),
    '#default_value' => variable_get('translation404_default_path', ''),
    '#size' => 40,
    '#description' => t('This page is displayed when no other content matches the requested document. If unsure, specify nothing.'),
    '#field_prefix' => url(NULL, array('absolute' => TRUE)) . (variable_get('clean_url', 0) ? '' : '?q=')
  );
  //add checkboxes to disable/enable each module that implements the module
  $enabling_modules_form = _translation404_enable_implemented_modules(); 
  $form = array_merge($form, $enabling_modules_form);
  return system_settings_form($form); 
} 
