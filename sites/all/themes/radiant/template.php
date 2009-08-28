<?php
// $Id: template.php,v 1.1 2009/05/29 07:41:14 agileware Exp $

/**
 * Generate the HTML representing a given menu with Artisteer style.
 *
 * @param $mid
 *   The block navigation content.
 *
 * @ingroup themeable
 */
function art_navigation_links_worker($content = NULL) {
  if (!$content) {
    return '';
  }
  
  $output = $content;
  $menu_str = ' class="menu"';
  if(strpos($content, $menu_str) !== false) {
    $empty_str = '';
    $pattern = '/class="menu"/i';
    $replacement = 'class="artmenu"';
    $output = preg_replace($pattern, $replacement, $output, 1);
    $output = str_replace($menu_str, $empty_str, $output);
  }
  $output = preg_replace('~(<a [^>]*>)([^<]*)(</a>)~', '$1<span class="l"></span><span class="r"></span><span class="t">$2</span>$3', $output);
  
  return $output;
}

function phptemplate_body_class($left, $right) {
  if ($left && $right) {
    $class = 'sidebars-2';
  }
  else if ($left || $right) {
    $class = 'sidebars-1';
  }
  if(isset($class)) {
    print ' class="'. $class .'"';
  }
}