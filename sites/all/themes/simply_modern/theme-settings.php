<?php
// $Id: theme-settings.php,v 1.7 2009/04/03 22:51:04 spencerbrooks Exp $
function phptemplate_settings($saved_settings) {

  $settings = theme_get_settings('simply_modern');

  $defaults = array(
    'background_color' => '',
    'masthead_color' => '',
    'usecustombodybg' => 0,
    'body_bg_path' => '',
    'bodytile' => 'fulltile',
    'masthead_bg_path' => '',
    'default_custom' => 'default',
    'mastheadtile' => 'fulltile',
    'mastheadfixedfluid' => '184px',
    'simply_modern_style' => 'blue',
    'simply_modern_width' => 1,
    'simply_modern_fixedwidth' => '960',
    'simply_modern_breadcrumb' => 1,
    'simply_modern_iepngfix' => 0,
    'simply_modern_fontfamily' => 0,
    'simply_modern_customfont' => '',
    'simply_modern_leftsidebarwidth' => '250',
    'simply_modern_rightsidebarwidth' => '250',
    'simply_modern_sidebar_positions' => 'split',
    'simply_modern_suckerfish' => 1,
    'simply_modern_usecustomlogosize' => 0,
    'simply_modern_logowidth' => '100',
    'simply_modern_logoheight' => '100',
    'simply_modern_custom_css_path' => '',
    'usecustomcss' => 0,
  );

  $settings = array_merge($defaults, $settings);
  
  /* added code for custom body background */
  $form['body_background'] = array(
    '#type' => 'fieldset',
    '#title' => t('Body background settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    );
  
  $form['body_background']['background_color'] = array(
    '#type' => 'textfield',
    '#title' => 'Custom body background color',
    '#description' => t('Leave blank for default. Format as a 3 or 6 character hexadecimal value without "#"'),
    '#size' => '5',
    '#maxlength' => '6',
    '#default_value' => $settings['background_color'],
  );
  
  $form['body_background']['usecustombodybg'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use custom body background'),
    '#default_value' => $settings['usecustombodybg'],
  );
  
  $form['body_background']['background_image'] = array(
    '#type' => 'file',
    '#title' => 'Upload a custom background image',
  );
  $form['#attributes'] = array(
  'enctype' => "multipart/form-data"
  );
  
  $form['body_background']['body_bg_path'] = array(
      '#type' => 'value',
      '#default_value' => $settings['body_bg_path'],
     );
  
  $form['body_background']['bodytile'] = array(
    '#type' => 'radios',
    '#title' => t('Tile custom background image'),
    '#default_value' => $settings['bodytile'],
    '#options' => array(
      'fulltile' => t('Horizontally and vertically'),
      'vertical' => t('Vertically only'),
      'horizontal' => t('Horizontally only'),
    ),
  );
  
  if ($file = file_save_upload('background_image', array('file_validate_is_image' => array()))) {
    $parts = pathinfo($file->filename);
    $filename = ($key) ? str_replace('/', '_', $key) .'_body_bg.'. $parts['extension'] : 'body_bg.'. $parts['extension'];

    // The image was saved using file_save_upload() and was added to the
    // files table as a temporary file. We'll make a copy and let the garbage
    // collector delete the original upload.
    if (file_copy($file, $filename, FILE_EXISTS_REPLACE)) {
      $_POST['usecustombodybg'] = 1;
      $_POST['body_bg_path'] = $file->filepath;
    }
  }
  /* end added code for custom body background */
  
  /* added code for custom masthead */
  $form['masthead'] = array(
      '#type' => 'fieldset',
      '#title' => t('Masthead settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
      //'#attributes' => array('class' => 'theme-settings-bottom'),
    );
  
  $form['masthead']['masthead_color'] = array(
    '#type' => 'textfield',
    '#title' => 'Custom masthead background color',
    '#description' => t('Leave blank for default. Format as a 3 or 6 character hexadecimal value without "#"'),
    '#size' => '5',
    '#maxlength' => '6',
    '#default_value' => $settings['masthead_color'],
  );
  
  $form['masthead']['masthead_background'] = array(
    '#type' => 'file',
    '#title' => 'Upload a custom masthead image',
  );

   $form['masthead']['masthead_bg_path'] = array(
      '#type' => 'value',
      '#default_value' => $settings['masthead_bg_path'],
      );
  
  if ($file = file_save_upload('masthead_background', array('file_validate_is_image' => array()))) {
    $parts = pathinfo($file->filename);
    $filename = ($key) ? str_replace('/', '_', $key) .'_masthead_bg.'. $parts['extension'] : 'masthead_bg.'. $parts['extension'];

    // The image was saved using file_save_upload() and was added to the
    // files table as a temporary file. We'll make a copy and let the garbage
    // collector delete the original upload.
    if (file_copy($file, $filename, FILE_EXISTS_REPLACE)) {
      $_POST['default_custom'] = 'custom';
      $_POST['masthead_bg_path'] = $file->filepath;
    }
  }
  
  $form['masthead']['default_custom'] = array(
    '#type' => 'radios',
    '#title' => t('Masthead image'),
    '#default_value' => $settings['default_custom'],
    '#options' => array(
      'default' => t('Use default image'),
      'custom' => t('Use custom image'),
      'none' => t('Use no image'),
    ),
  );
  
  $form['masthead']['mastheadtile'] = array(
    '#type' => 'radios',
    '#title' => t('Tile custom masthead image'),
    '#default_value' => $settings['mastheadtile'],
    '#options' => array(
      'fulltile' => t('Horizontally and vertically'),
      'vertical' => t('Vertically only'),
      'horizontal' => t('Horizontally only'),
    ),
  );
  
    $form['masthead']['mastheadfixedfluid'] = array(
    '#type' => 'textfield',
    '#title' => t('Fixed or fluid masthead height'),
    '#default_value' => $settings['mastheadfixedfluid'],
    '#description' => t('Leave blank for fluid height.'),
    '#size' => '5',
    '#field_suffix' => 'px',
  );
  
  /* end added code for custom masthead */
  
  /* add support for custom css file*/
  $form['custom_css'] = array(
    '#type' => 'fieldset',
    '#title' => t('Custom CSS file'),
    '#description' => t('Upload your own custom CSS file.'),
    '#collapsed' => TRUE,
    '#collapsible' => TRUE,
  );
  
  $form['custom_css']['usecustomcss'] = array(
    '#type' => 'checkbox',
    '#title' => 'Use my custom CSS',
    '#default_value' => $settings['usecustomcss'],
  );
  
  if ($file = file_save_upload('custom_css_upload')) {
    $parts = pathinfo($file->filename);
    $filename = ($key) ? str_replace('/', '_', $key) .'_logo.'. $parts['extension'] : 'custom_css.'. $parts['extension'];

    // The image was saved using file_save_upload() and was added to the
    // files table as a temporary file. We'll make a copy and let the garbage
    // collector delete the original upload.
    if (file_copy($file, $filename, FILE_EXISTS_REPLACE)) {
      $_POST['simply_modern_custom_css_path'] = $file->filepath;
      $_POST['usecustomcss'] = 1;
      //$settings['simply_modern_custom_css_path'] = $file->filepath;
    }
  }
  $form['custom_css']['simply_modern_custom_css_path'] = array(
    '#type' => 'textfield',
    '#title' => t('Custom CSS file path'),
    '#description' => t('Where on the system is the custom CSS file?, this is currently set to @path', array('@path' => $settings['simply_modern_custom_css_path'])),
    '#description' => t('Where on the system is the custom CSS file?'),
    '#default_value' => $settings['simply_modern_custom_css_path'],
    #'#size' => 100,
  );
  $form['custom_css']['custom_css_upload'] = array(
    '#title' => t('Upload custom CSS file'),
    '#description' => t('Upload a file to use for your custom CSS.'),
    '#type' => 'file',
    '#size' => 50,
  );
  /* end add support for custom css file*/
  
  $form['simply_modern_style'] = array(
    '#type' => 'select',
    '#title' => t('Style'),
    '#default_value' => $settings['simply_modern_style'],
    '#options' => array(
      'copper' => t('Copper'),
      'green' => t('Green'),
      'blue' => t('Blue'),
      'black' => t('Black'),
      'red' => t('Red'),
    ),
  );

  $form['simply_modern_width'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use Fixed Width'),
    '#default_value' => $settings['simply_modern_width'],
  );

  $form['simply_modern_fixedwidth'] = array(
    '#type' => 'textfield',
    '#title' => t('Fixed Width Size'),
    '#default_value' => $settings['simply_modern_fixedwidth'],
    '#size' => 5,
    '#maxlength' => 5,
  );

  $form['simply_modern_breadcrumb'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Breadcrumbs'),
    '#default_value' => $settings['simply_modern_breadcrumb'],
  );

  $form['simply_modern_iepngfix'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use IE PNG Fix'),
    '#default_value' => $settings['simply_modern_iepngfix'],
  );
  
  $form['simply_modern_fontfamily'] = array(
    '#type' => 'select',
    '#title' => t('Font Family'),
    '#default_value' => $settings['simply_modern_fontfamily'],
    '#options' => array(
      'Arial, Verdana, sans-serif' => t('Arial, Verdana, sans-serif'),
      '"Arial Narrow", Arial, Helvetica, sans-serif' => t('"Arial Narrow", Arial, Helvetica, sans-serif'),
      '"Times New Roman", Times, serif' => t('"Times New Roman", Times, serif'),
      '"Lucida Sans", Verdana, Arial, sans-serif' => t('"Lucida Sans", Verdana, Arial, sans-serif'),
      '"Lucida Grande", Verdana, sans-serif' => t('"Lucida Grande", Verdana, sans-serif'),
      'Tahoma, Verdana, Arial, Helvetica, sans-serif' => t('Tahoma, Verdana, Arial, Helvetica, sans-serif'),
      'Georgia, "Times New Roman", Times, serif' => t('Georgia, "Times New Roman", Times, serif'),
      'Custom' => t('Custom (specify below)'),
    ),
  );

  $form['simply_modern_customfont'] = array(
    '#type' => 'textfield',
    '#title' => t('Custom Font-Family Setting'),
    '#default_value' => $settings['simply_modern_customfont'],
    '#size' => 40,
    '#maxlength' => 75,
  );

  $form['simply_modern_uselocalcontent'] = array(
    '#type' => 'checkbox',
    '#title' => t('Include Local Content File'),
    '#default_value' => $settings['simply_modern_uselocalcontent'],
  );

  $form['simply_modern_localcontentfile'] = array(
    '#type' => 'textfield',
    '#title' => t('Local Content File Name'),
    '#default_value' => $settings['simply_modern_localcontentfile'],
    '#size' => 40,
    '#maxlength' => 75,
  );

  $form['simply_modern_leftsidebarwidth'] = array(
    '#type' => 'textfield',
    '#title' => t('Left Sidebar Width'),
    '#default_value' => $settings['simply_modern_leftsidebarwidth'],
    '#size' => 5,
    '#maxlength' => 5,
  );

  $form['simply_modern_rightsidebarwidth'] = array(
    '#type' => 'textfield',
    '#title' => t('Right Sidebar Width'),
    '#default_value' => $settings['simply_modern_rightsidebarwidth'],
    '#size' => 5,
    '#maxlength' => 5,
  );//'simply_modern_sidebar_positions' => 'split',
  $form['simply_modern_sidebar_positions'] = array (
    '#type' => 'select',
    '#title' => t('Sidebar Positions'),
    '#desription' => t('Where do you want the sidebars positioned?'),
    '#options' => array('split' => t('Split, one on each side'), 'left' => t('Left, Both on the left'), 'right' => t('Right, both on the right')),
    '#default_value' => $settings['simply_modern_sidebar_positions'],
  );

  $form['simply_modern_suckerfish'] = array(
    '#type' => 'checkbox',
    '#title' => t('Use Suckerfish Menus'),
    '#default_value' => $settings['simply_modern_suckerfish'],
  );

  $form['simply_modern_usecustomlogosize'] = array(
    '#type' => 'checkbox',
    '#title' => t('Specify Custom Logo Size'),
    '#default_value' => $settings['simply_modern_usecustomlogosize'],
  );

  $form['simply_modern_logowidth'] = array(
    '#type' => 'textfield',
    '#title' => t('Logo Width'),
    '#default_value' => $settings['simply_modern_logowidth'],
    '#size' => 5,
    '#maxlength' => 5,
  );

  $form['simply_modern_logoheight'] = array(
    '#type' => 'textfield',
    '#title' => t('Logo Height'),
    '#default_value' => $settings['simply_modern_logoheight'],
    '#size' => 5,
    '#maxlength' => 5,
  );

  return $form;
}
