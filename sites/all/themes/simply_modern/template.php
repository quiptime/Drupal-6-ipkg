<?php
// $Id: template.php,v 1.6 2009/04/28 19:16:26 jrglasgow Exp $

function phptemplate_body_class($sidebar_left, $sidebar_right) {
   if ($sidebar_left != '' && $sidebar_right != '') {
     $class = 'sidebars';
   }
  else {
    if ($sidebar_left != '') {
      $class = 'sidebar-left';
    }
    if ($sidebar_right != '') {
      $class = 'sidebar-right';
    }
  }

  if (isset($class)) {
    print ' class="'. $class .'"';
}

}
if (is_null(theme_get_setting('simply_modern_style'))) {
  global $theme_key;
  // Save default theme settings
  $defaults = array(
    'simply_modern_style' => 'blue',
    'simply_modern_width' => 0,
    'simply_modern_fixedwidth' => '850',
    'simply_modern_breadcrumb' => 0,
    'simply_modern_iepngfix' => 0,
    'simply_modern_themelogo' => 0,
    'simply_modern_fontfamily' => 0,
    'simply_modern_customfont' => '',
    'simply_modern_uselocalcontent' => 0,
    'simply_modern_localcontentfile' => '',
    'simply_modern_leftsidebarwidth' => '210',
    'simply_modern_rightsidebarwidth' => '210',
    'simply_modern_suckerfish' => 1,
    'simply_modern_usecustomlogosize' => 0,
    'simply_modern_logowidth' => '100',
    'simply_modern_logoheight' => '100',
  );

  variable_set(
    str_replace('/', '_', 'theme_'. $theme_key .'_settings'),
    array_merge(theme_get_settings($theme_key), $defaults)
  );
  // Force refresh of Drupal internals
  theme_get_setting('', TRUE);
}

function get_simply_modern_style() {
  $style = theme_get_setting('simply_modern_style');
  if (!$style)
  {
    $style = 'blue';
  }
  if (isset($_COOKIE["simply_modernstyle"])) {
    $style = $_COOKIE["simply_modernstyle"];
  }
  return $style;
}

$style = get_simply_modern_style();
drupal_add_css(drupal_get_path('theme', 'simply_modern') . '/css/' . $style . '.css', 'theme');

if (theme_get_setting('simply_modern_iepngfix')) {
  drupal_add_js(drupal_get_path('theme', 'simply_modern') . '/js/jquery.pngFix.js', 'theme');
}

if (theme_get_setting('simply_modern_suckerfish')) {
  drupal_add_css(drupal_get_path('theme', 'simply_modern') . '/css/suckerfish_'  . $style . '.css', 'theme');
}

if (theme_get_setting('simply_modern_uselocalcontent'))
{
  $local_content = drupal_get_path('theme', 'simply_modern') . '/' . theme_get_setting('simply_modern_localcontentfile');
  if (file_exists($local_content)) {
    drupal_add_css($local_content, 'theme');
  }
}

if (theme_get_setting('simply_modern_custom_css_path')) {
  if (theme_get_setting('usecustomcss')) {
    drupal_add_css(theme_get_setting('simply_modern_custom_css_path'), 'theme');
  }
}


function phptemplate_menu_links($links, $attributes = array()) {

  if (!count($links)) {
    return '';
  }
  $level_tmp = explode('-', key($links));
  $level = $level_tmp[0];
  $output = "<ul class=\"links-$level ".$attributes['class']. "\" id=\"".$attributes['id']."\">\n";

  $num_links = count($links);
  $i = 1;

  foreach ($links as $index => $link) {
    $output .= '<li';

    $output .= ' class="';
    if (stristr($index, 'active')) {
      $output .= 'active';
    }
    elseif((drupal_is_front_page()) && ($link['href']=='<front>')){
      $link['attributes']['class'] = 'active';
      $output .= 'active';
    }
    if ($i == 1) {
      $output .= ' first'; }
    if ($i == $num_links) {
      $output .= ' last'; }

    $output .= '"';

    $output .= ">". l($link['title'], $link['href'], $link['attributes'], $link['query'], $link['fragment']) ."</li>\n";

    $i++;
  }
  $output .= '</ul>';
  return $output;
}

function phptemplate_maintenance_page(
  $content, $messages = TRUE, $partial = FALSE) {
  drupal_set_header('Content-Type: text/html; charset=utf-8');
  //drupal_set_html_head('<style type="text/css" media="all">@import "'. base_path() .'misc/maintenance.css";</style>');
  drupal_set_html_head('<style type="text/css" media="all">@import "'. base_path() . drupal_get_path('theme', 'newsflash') .'/maintenance.css";</style>');
  drupal_set_html_head('<style type="text/css" media="all">@import "'. base_path() . drupal_get_path('module', 'system') .'/defaults.css";</style>');
  drupal_set_html_head('<style type="text/css" media="all">@import "'. base_path() . drupal_get_path('module', 'system') .'/system.css";</style>');
  //drupal_set_html_head('<style type="text/css" media="all">@import "'. base_path() . drupal_get_path('theme', 'newsflash') .'/style.css";</style>');
  drupal_set_html_head('<link rel="shortcut icon" href="'. base_path() .'misc/favicon.ico" type="image/x-icon" />');
  
  $output = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
  $output .= '<html xmlns="http://www.w3.org/1999/xhtml">';
  $output .= '<head>';
  $output .= '<title>Tribute Media</title>';
  $output .= drupal_get_html_head();
  $output .= drupal_get_js();
  $output .= '</head>';
  $output .= '<body>';
  
  $output .= '<div class="logo"><img src="'. drupal_get_path('theme', 'newsflash') .'/images/tribute_comingsoon.png" id="logo"/></div>';
  //$output .= '<h1 id="title">' . drupal_get_title() . '</h1>';
  if ($messages) {
    $output .= theme('status_messages');
  }
  $output .= "\n<!-- begin content -->\n";
  //$output .= $content;
  $output .= "\n<!-- end content -->\n";

  if (!$partial) {
    $output .= '</body></html>';
  }

  return $output;
}
