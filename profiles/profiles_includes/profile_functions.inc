<?php
// $Id: profile_functions.inc, v 1.0 2009/08/28 16:21:13 quiptime Exp $

/**
 * Define contributed modules, will be install.
 *
 * @return
 *   An array contain the additional contributed modules.
 */
function _profile_contrib_modules($profile) {
  // This module available on all profiles.
  $contrib_modules = array(
    // "Advanced help" is required by "Chaos tool suite".
    'advanced_help' => l('Advanced help', 'http://drupal.org/project/advanced_help', _profile_get_link_attr()),
    'cck' => l('Content Construction Kit (CCK)', 'http://drupal.org/project/cck', _profile_get_link_attr()),
    'ctools' => l('Chaos tool suite', 'http://drupal.org/project/ctools', _profile_get_link_attr()),
    'filefield' => l('FileField', 'http://drupal.org/project/filefield', _profile_get_link_attr()),
    'imageapi' => l('ImageAPI', 'http://drupal.org/project/imageapi', _profile_get_link_attr()),
    'imagecache' => l('ImageCache', 'http://drupal.org/project/imagecache', _profile_get_link_attr()),
    'imagefield' => l('ImageField', 'http://drupal.org/project/imagefield', _profile_get_link_attr()),
    'panels' => l('Panels', 'http://drupal.org/project/panels', _profile_get_link_attr()),
    'token' => l('Token', 'http://drupal.org/project/token', _profile_get_link_attr()),
    'views' => l('Views', 'http://drupal.org/project/views', _profile_get_link_attr()),
    // Skinr is required from theme Acquia Prosper.
    'skinr' => l('Skinr', 'http://drupal.org/project/skinr', _profile_get_link_attr()),
    // Transliteration is required from ImageCache and ImageCache UI.
    'transliteration' => l('Transliteration', 'http://drupal.org/project/transliteration', _profile_get_link_attr()),
  );

  switch ($profile) {
    case 'standard':
      $modules = $contrib_modules;
      break;
    case 'standard_i18n':
      $standard_i18n_contrib_modules = array(
        'admin_language' => l('Admin Language', 'http://drupal.org/project/admin_language', _profile_get_link_attr()),
        'dul' => l('Disable User Language', 'http://drupal.org/project/dul', _profile_get_link_attr()),
        'i18n' => l('Internationalization', 'http://drupal.org/project/i18n', _profile_get_link_attr()),
        'language_sections' => l('Language Sections', 'http://drupal.org/project/language_sections', _profile_get_link_attr()),
        'languageicons' => l('Language Icons', 'http://drupal.org/project/languageicons', _profile_get_link_attr()),
        'languagelink_title' => l('Language Link Title', 'http://drupal.org/project/languagelink_title', _profile_get_link_attr()),
        'l10n_client' => l('Localization client', 'http://drupal.org/project/l10n_client', _profile_get_link_attr()),
        'potx' => l('Translation template extractor', 'http://drupal.org/project/potx', _profile_get_link_attr()),
        'reglang' => l('Registration Language', 'http://drupal.org/project/reglang', _profile_get_link_attr()),
        'translation404' => l('Translation 404 – Translation Page Not Found', 'http://drupal.org/project/translation404', _profile_get_link_attr()),
      );
      $modules = array_merge($contrib_modules, $standard_i18n_contrib_modules);
      break;
    case 'seo':
      $seo_contrib_modules = array(
        'alinks' => l('Alinks', 'http://drupal.org/project/alinks', _profile_get_link_attr()),
        'google_analytics' => l('Google Analytics', 'http://drupal.org/project/google_analytics', _profile_get_link_attr()),
        'link' => l('Link', 'http://drupal.org/project/link', _profile_get_link_attr()),
        'linkchecker' => l('Link checker', 'http://drupal.org/project/linkchecker', _profile_get_link_attr()),
        'nodewords' => l('Meta Tags', 'http://drupal.org/project/nodewords', _profile_get_link_attr()),
        'nodewords_bypath' => l('Meta Tags by Path', 'http://drupal.org/project/nodewords_bypath', _profile_get_link_attr()),
        'nodewords_nodetype' => l('Meta Tags Node Type', 'http://drupal.org/project/nodewords_nodetype', _profile_get_link_attr()),
        'seo_checklist' => l('SEO hecklist', 'http://drupal.org/project/seo_checklist', _profile_get_link_attr()),
        'similar' => l('Similar', 'http://drupal.org/project/similar', _profile_get_link_attr()),
      );
      $modules = array_merge($contrib_modules, $seo_contrib_modules);
      break;
  }

  return $modules;
}

/**
 * Define optional contributed modules, can be install.
 *
 * @return
 *   An array contain the optional contributed modules.
 */
function _profile_optional_modules($profile) {
  $optional_modules = array(
    'content_profile' => l('Content Profile', 'http://drupal.org/project/content_profile', _profile_get_link_attr()),
    'logintoboggan' => l('LoginToboggan', 'http://drupal.org/project/logintoboggan', _profile_get_link_attr()),

    'simplenews' => l('Simplenews', 'http://drupal.org/project/simplenews', _profile_get_link_attr()),
    'simplenews_register' => l('Simplenews on register', 'http://drupal.org/project/simplenews_register', _profile_get_link_attr()),

    'bueditor' => l('BUEditor', 'http://drupal.org/project/bueditor', _profile_get_link_attr()),
    'imce' => l('IMCE', 'http://drupal.org/project/imce', _profile_get_link_attr()) .' '. st('Recommended for') .' BUEditor - '. st('insert images'). '.',
    'imce_mkdir' => l('IMCE Mkdir', 'http://drupal.org/project/imce_mkdir', _profile_get_link_attr()),

    'pathauto' => l('Pathauto', 'http://drupal.org/project/pathauto', _profile_get_link_attr()),
    'views_bonus' => l('Views Bonus Pack', 'http://drupal.org/project/views_bonus', _profile_get_link_attr()),
    'fivestar' => l('Fivestar', 'http://drupal.org/project/fivestar', _profile_get_link_attr()),
    'votingapi' => l('Voting API', 'http://drupal.org/project/votingapi', _profile_get_link_attr()) .' '. st('Needed by') .' "Fivestar"!',
    'flatcomments' => l('Flatcomments', 'http://drupal.org/project/flatcomments', _profile_get_link_attr()),

    'node_expire' => l('Node Expire', 'http://drupal.org/project/node_expire', _profile_get_link_attr()),
    'rules' => l('Rules', 'http://drupal.org/project/rules', _profile_get_link_attr()) .' '. st('Needed by') .' "Node Expire"!',

    'acl' => l('ACL', 'http://drupal.org/project/acl', _profile_get_link_attr()) .' '. st('Needed by') .' "Forum Access" '. st('and optional by') .' "Content Access"!',
    'content_access' => l('Content Access', 'http://drupal.org/project/content_access', _profile_get_link_attr()),
    'forum_access' => l('Forum Access', 'http://drupal.org/project/forum_access', _profile_get_link_attr()),
    'taxonomy_access' => l('Taxonomy Access Control', 'http://drupal.org/project/taxonomy_access', _profile_get_link_attr()),

    'db_maintenance' => l('DB Maintenance', 'http://drupal.org/project/db_maintenance', _profile_get_link_attr()),
    'coder' => l('Coder', 'http://drupal.org/project/coder', _profile_get_link_attr()),
    'devel' => l('Devel', 'http://drupal.org/project/develhttp://drupal.org/project/devel', _profile_get_link_attr()),
    'Teleport' => l('Teleport', 'http://drupal.org/project/teleport', _profile_get_link_attr()),
    'masquerade' => l('Masquerade', 'http://drupal.org/project/masquerade', _profile_get_link_attr()),
  );

  switch ($profile) {
    case 'standard':
      $modules = $optional_modules;
      break;
    case 'standard_i18n':
      $modules = $optional_modules;
      break;
    case 'seo':
      $modules = $optional_modules;
      break;
  }

  return $modules;
}

/**
 * Define own, not contributed modules, will be install.
 *
 * @return
 *   An array contain the own (not contributed) modules.
 */
function _profile_own_modules($profile) {
  return array(
    'explorer8_modus' => l('Explorer8 modus', 'http://www.quiptime.com/downloads', _profile_get_link_attr()) .' '.'(Quiptime Group module)',
  );
}

/**
 * Define the optional contributed themes to download.
 *
 * @return
 *   An array contain the optional themes.
 */
function _profile_optional_themes($profile) {
  $themes = array(
    'a3_atlantis' => l('A3 Atlantis', 'http://drupal.org/project/a3_atlantis', _profile_get_link_attr()),
    'acquia_marina' => l('Acquia Marina', 'http://drupal.org/project/acquia_marina', _profile_get_link_attr()),
    'acquia_prosper' => l('Acquia Prosper', 'http://drupal.org/project/acquia_prosper', _profile_get_link_attr()),
    'acquia_slate' => l('Acquia Slate', 'http://drupal.org/project/acquia_slate', _profile_get_link_attr()),
    'fourseasons' => l('Four Seasons', 'http://drupal.org/project/fourseasons', _profile_get_link_attr()),
    'fusion' => l('Fusion', 'http://drupal.org/project/fusion', _profile_get_link_attr()) .' '. st('Needed by') .' "Acquia Prosper"!',
    'litejazz' => l('LiteJazz', 'http://demo.roopletheme.com/litejazz', _profile_get_link_attr()),
    'newsflash' => l('NewsFlash', 'http://demo.roopletheme.com/newsflash/', _profile_get_link_attr()),
    'radiant' => l('Radiant', 'http://drupal.org/project/radiant', _profile_get_link_attr()),
    'rootcandy' => l('RootCandy', 'http://drupal.org/project/rootcandy', _profile_get_link_attr()),
    'simply_modern' => l('Simply Modern', 'http://drupal.org/project/simply_modern', _profile_get_link_attr()),
    'zeropoint' => l('Zeropoint', 'http://drupal.org/project/zeropoint', _profile_get_link_attr()),
  );

  return $themes;
}

/**
 * Help funtion.
 *
 * Build form element with important post installation information.
 *
 * @return
 *
 */
function _profile_form_alter_important_info($form) {
  $information = '<h3>'. st('Task') .'</h3>';
  $information .= '<p>'. st('Once Drupal is installed, you have to realize an important task!') .'</p>';
  $information .= '<p><strong>'. st('All with this installer installed directories and files, modules and themes, that will have to correct permissions.') .'</strong></p>';
  $information .= '<p>'. st('With permissions is meant: Who is the owner and group?') .'</p>';
  $information .= '<p>'. st('Simple test to check: Compare the file "install.php" with these directories and their files in it.') .'</p>';
  $information .= '<p>'. st('Installation directories:') .'</p>';
  $information .= '<ul><li>'.'sites/all/modules/contrib'.'</li>';
  $information .= '<li>'.'sites/all/themes'.'</li></ul>';
  $information .= '<h3>'. st('Tipp') .'</h3>';
  $information .= '<p>'. st('Shared web host providers usually have a tool to realize this task in a web account.') .'</p>';
  $information .= '<p>'.'Linux ssh/shell:'.'</p>';
  $information .= '<p>'.'chown -R correct_owner:correct_group sites/all/modules/contrib'.'<br />';
  $information .= 'chown -R correct_owner:correct_group sites/all/themes'.'</p>';

  $form['post_install'] = array(
    '#type' => 'fieldset',
    '#title' => st('IMPORTANT information'),
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
  );
  $form['post_install']['information'] = array(
    '#type' => 'markup',
    '#value' => $information,
  );

  return $form;
}

/**
 * Add a node describing how to get started with Drupal.
 */
function _profile_add_describing_node($profile, $language) {
  $welcome_file = 'profiles/'. $profile .'/' . $language->language . '/welcome.txt';
  if (!file_exists($welcome_file)) {
    drupal_set_message(t('Could not find file !filepath', array('!filepath' => $welcome_file)), 'error');
    $welcome_file = 'profiles/'. $profile .'/en/welcome.txt';
  }
  if ($welcome_node = _profile_profile_create_node($welcome_file, 'page')) {
    node_save($welcome_node);
    variable_set($profile .'_welcome', $welcome_node->nid);
  }
  else {
    drupal_set_message(t('The file !filepath could not be read.  The welcome page will not be generated.', array('!filepath' => $welcome_file)), 'error');
  }
}

/**
 * Creates a node from the specified filename.  The node body will contain the
 * contents of the file.  All relative links must be identified within the file
 * so they can be mapped to paths appropriate for the installation.
 *
 * The relative links are identified in the file by surrounding the actual
 * link with double square brackets.  For example:
 *
 * <a href="[[admin]]">Admin page</a>
 *
 * $filename the name of the file to retrieve the text from
 * $page_type the type of node to create
 */
function _profile_profile_create_node($filename, $page_type) {
  $contents = trim(file_get_contents($filename));
  if (!$contents) {
    return null;
  }

  // Grab the title from the document and then remove the title so it
  // isn't shown in the title and the body.  The title will be encoded
  // in the document in the following form:
  // <h1 [class="..."]>{TITLE}</h1>
  $title_regexp = "/[\<]h1(\s*[^=\>]*=\"[^\"]*\")*\s*[\>](.*)\<\/h1\>/i";
  if (preg_match($title_regexp, $contents, $match)) {
    $title = $match[count($match) - 1];
    // Remove the title from the body of the document.
    $contents = preg_replace($title_regexp, '', $contents);
  }

  // Replace all local links with the full path.
  $options = array();
  $options['alias'] = TRUE;
  $link_regexp = "/(\[\[)([\/?\w+\-*]+)(\]\])/e";
  $contents = preg_replace($link_regexp, 'check_url(url("\2", $options))',
    $contents);
  $node = new stdClass();
  $node->title = $title;
  $node->teaser = node_teaser($contents);
  $node->body = $contents;
  $node->uid = 1;
  $node->type = $page_type;
  $node->status = 1;
  $node->promote = 1;
  $node->format = 2;
  return $node;
}

/**
 * Help funtion.
 *
 * @return
 *   An array with link attributes.
 */
function _profile_get_link_attr() {
  return array('attributes' => array('target' => '_blank'));
}

/**
 * Help funtion.
 *
 * Set an footer on installed website.
 */
function _profile_set_footer() {
  variable_set('site_footer', '<div id="ipkg-info">2009 '. l('Quiptime Group', 'http://www.quiptime.com', _profile_get_link_attr()) .' Drupal installer</div>');
  return;
}

/**
 * Profiles required JS.
 */
function _profile_required_js() {
  drupal_add_js('misc/jquery.js');
  drupal_add_js('profiles/profiles_includes/ipkg_manager.js');
  return;
}

