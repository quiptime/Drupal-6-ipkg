<?php
// $Id: standard_i18n.profile, v 1.0 2009/08/21 16:30:52 quiptime Exp $

include_once('./profiles/profiles_includes/profile_functions.inc');

/**
 * Return an array of the modules to be enabled when this profile is installed.
 * Furthermore, additional modules downloaded and installed.
 *
 * @return
 *   An array of modules to enable.
 */
function standard_i18n_profile_modules() {
  $profile = 'standard_i18n';

  // Enable core modules.
  $core_modules = array(
    // Required core modules.
    'block', 'filter', 'node', 'system', 'user',
    // Optional core modules.
    'color', 'dblog', 'help', 'menu', 'taxonomy',  'path', 'php',
  );
  // Enable contributed/own modules.
  $contributed_modules = array(
    // CCK modules.
    'content', 'content_permissions', 'number', 'text', 'optionwidgets', 'fieldgroup',
    'filefield', 'imagefield',

    // Views modules.
    'views', 'views_ui',

    // ImageCache modules.
    'imagecache',
    // This module need the Transliteration module.
    'imagecache_ui',

    // Other contributed modules.
    'imageapi',
    'imageapi_gd',
    'token',
    'skinr',
    'transliteration',

    // Own modules.

  );

  // Additional module packages to download.
  $contrib_packages = _standard_i18n_contrib_modules($profile);

  include_once('./profiles/profiles_includes/get_files.inc');

  // Which versions of modules are allowed.
  // At the moment it only supports: $allow['dev'].
  $ignore['alpha'] = FALSE;
  $ignore['beta'] = FALSE;
  $ignore['dev'] = TRUE;

  $inst_mods = profile_download_files($profile, 'modules', array_keys($contrib_packages), $ignore, 6);

  // Return only module arrays to enable.
  return array_merge($core_modules, $contributed_modules);
}

/**
 * Return a description of the profile for the initial installation screen.
 *
 * @return
 *   An array with keys 'name' and 'description' describing this profile,
 *   and optional 'language' to override the language selection for
 *   language-specific profiles.
 */
function standard_i18n_profile_details() {
  $profile = 'standard_i18n';

  // Collapsible fieldsets with modules and themes information to display on the profile overview page.
  $contrib_modules = _standard_i18n_contrib_modules($profile);
  $own_modules = _profile_own_modules($profile);

  $other_modules = array_merge($contrib_modules, $own_modules);
  //natcasesort($other_modules);

  // Additional modules.
  $modules_list = '<ul>';
  foreach ($other_modules as $module => $module_name) {
    $modules_list .= '<li>'. $module_name .'</li>';
  }
  $modules_list .= '</ul>';
  // Build collapsible fieldset.
  $modules_fieldset = array(
    '#title' => st('Additional modules will be installed'),
    '#description' => st('These modules will be downloaded from drupal.org and installed with this profile.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#value' => $modules_list,
  );
  $modules_info = theme('fieldset', $modules_fieldset);

  // Optional modules
  $optional_modules = _standard_i18n_optional_modules($profile);

  $opt_modules_list = '<ul>';
  foreach ($optional_modules as $module => $module_name) {
    $opt_modules_list .= '<li>'. $module_name .'</li>';
  }
  $opt_modules_list .= '</ul>';
  // Build collapsible fieldset.
  $opt_modules_fieldset = array(
    '#title' => st('Optional modules can be installed.'),
    '#description' => st('These modules can be downloaded from drupal.org and installed. Your selection is possible at a later installation step.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#value' => $opt_modules_list,
  );
  $opt_modules_info = theme('fieldset', $opt_modules_fieldset);

  // Optional themes.
  $optional_themes = _profile_optional_themes($profile);
  $themes_list = '<ul>';
  foreach ($optional_themes as $theme => $theme_name) {
    $themes_list .= '<li>'. $theme_name .'</li>';
  }
  $themes_list .= '</ul>';
  // Build collapsible fieldset.
  $themes_fieldset = array(
    '#title' => st('Optional themes can be installed'),
    '#description' => st('These themes can be downloaded from drupal.org and installed. Your selection is possible at a later installation step.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#value' => $themes_list,
  );
  $themes_info = theme('fieldset', $themes_fieldset);

  // Making a fieldset what the other 3 fieldsets contains.
  $profile_fieldset = array(
    '#title' => st('Information'),
    '#description' => st('Additional: It will be installed. Optional: You can later choose to install.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#value' => $modules_info . $opt_modules_info . $themes_info,
  );
  $profile_info = theme('fieldset', $profile_fieldset);

  // Profile description.
  $description = st('Select this profile to enable some Drupal functionality, advanced multilanguage features, the default and optional themes.') . '<br />';
  $description .= $profile_info;

  return array(
    'name' => 'Standard i18n',
    'description' => $description,
  );
}

/**
 * Return a list of tasks that this profile supports.
 *
 * @return
 *   A keyed array of tasks the profile will perform during
 *   the final stage. The keys of the array will be used internally,
 *   while the values will be displayed to the user in the installer
 *   task list.
 */
function standard_i18n_profile_task_list() {
  global $conf;
  $conf['theme_settings'] = array(
    'default_logo' => 0,
  //  'logo_path' => 'profiles/foobar.png',
  );
  $conf['site_name'] = 'Drupal 6 ipkg';
  $conf['site_footer'] = 'Quiptime Group Drupal installer - profile Standard i18n';

  $tasks = array(
    'optional-modules' => st('Optional modules'),
    'optional-themes' => st('Optional themes'),
  );
  return $tasks;
}

/**
 * Perform any final installation tasks for this profile.
 *
 * The installer goes through the profile-select -> locale-select
 * -> requirements -> database -> profile-install-batch
 * -> locale-initial-batch -> configure -> locale-remaining-batch
 * -> finished -> done tasks, in this order, if you don't implement
 * this function in your profile.
 *
 * If this function is implemented, you can have any number of
 * custom tasks to perform after 'configure', implementing a state
 * machine here to walk the user through those tasks. First time,
 * this function gets called with $task set to 'profile', and you
 * can advance to further tasks by setting $task to your tasks'
 * identifiers, used as array keys in the hook_profile_task_list()
 * above. You must avoid the reserved tasks listed in
 * install_reserved_tasks(). If you implement your custom tasks,
 * this function will get called in every HTTP request (for form
 * processing, printing your information screens and so on) until
 * you advance to the 'profile-finished' task, with which you
 * hand control back to the installer. Each custom page you
 * return needs to provide a way to continue, such as a form
 * submission or a link. You should also set custom page titles.
 *
 * You should define the list of custom tasks you implement by
 * returning an array of them in hook_profile_task_list(), as these
 * show up in the list of tasks on the installer user interface.
 *
 * Remember that the user will be able to reload the pages multiple
 * times, so you might want to use variable_set() and variable_get()
 * to remember your data and control further processing, if $task
 * is insufficient. Should a profile want to display a form here,
 * it can; the form should set '#redirect' to FALSE, and rely on
 * an action in the submit handler, such as variable_set(), to
 * detect submission and proceed to further tasks. See the configuration
 * form handling code in install_tasks() for an example.
 *
 * Important: Any temporary variables should be removed using
 * variable_del() before advancing to the 'profile-finished' phase.
 *
 * @param $task
 *   The current $task of the install system. When hook_profile_tasks()
 *   is first called, this is 'profile'.
 * @param $url
 *   Complete URL to be used for a link or form action on a custom page,
 *   if providing any, to allow the user to proceed with the installation.
 *
 * @return
 *   An optional HTML string to display to the user. Only used if you
 *   modify the $task, otherwise discarded.
 */
function standard_i18n_profile_tasks(&$task, $url) {
  global $base_url, $install_locale, $language;
  // Just in case some of the future tasks adds some output
  $output = '';

  if ($task == 'profile') {
    _standard_i18nprofile_modify_settings();
    _standard_i18nprofile_set_content_types();
    _standard_i18nprofile_modify_blocks();

    $task = 'optional-modules';

    // Update the menu router information.
    menu_rebuild();
  }

  // Optional modules.
  if ($task == 'optional-modules') {
    $output = drupal_get_form('standard_i18n_optional_modules_form', $url);

    if (!variable_get('ipkg_modules_install', FALSE)) {
      drupal_set_title(st('Install optional modules'));
      return $output;
    }
    else {
      $modules_list = variable_get('ipkg_modules_list', array());
      if (count($modules_list) > 0) {
        include_once('./profiles/profiles_includes/get_files.inc');

        $ignore['alpha'] = FALSE;
        $ignore['beta'] = FALSE;
        $ignore['dev'] = TRUE;

        $operations = profile_download_files('standard_i18n', 'optional_modules', array_keys($modules_list), $ignore, 6);

        $batch = array(
          'operations' => $operations,
          'finished' => '_install_standard_i18n_theme_batch',
          'title' => st('Installing optional modules from drupal.org'),
          'error_message' => st('The installation has encountered an error.'),
        );

        variable_set('install_task', 'locale-initial-batch');
        batch_set($batch);
        batch_process($url, $url);
      }
      // No optional themes to install.
      else {
        //variable_del('ipkg_modules_install');
        $task = 'optional-themes';
      }
    }
  }

  // Optional themes.
  if ($task == 'optional-themes') {
    $output = drupal_get_form('standard_i18n_optional_themes_form', $url);

    // The forms inside installer profiles may not use redirection, because
    // that will break the installer workflow. So we need an other way to
    // detect whether the form was successfully submitted, meaning that
    // the submit handler already performed it's job. This depends on the
    // exact use case; in this example profile, we check whether some
    // user-submitted text was already stored into our variable.
    if (!variable_get('ipkg_themes_install', FALSE)) {
      // The variable is still empty, meaning that the drupal_get_form()
      // call above haven't finished the form yet. We set a page-title
      // here, and return the rendered form to the installer, to be
      // shown to the user. Since $task is still set to 'task1', this
      // code will be re-run on next page request, proceeding further
      // if possible.
      drupal_set_title(st('Install optional themes'));
      return $output;
    }
    else {
      $files_list = variable_get('ipkg_themes_list', array());
      if (count($files_list) > 0) {
        include_once('./profiles/profiles_includes/get_files.inc');

        $ignore['alpha'] = FALSE;
        $ignore['beta'] = FALSE;
        $ignore['dev'] = FALSE;

        $operations = profile_download_files('standard_i18n', 'themes', array_keys($files_list), $ignore, 6);

        $batch = array(
          'operations' => $operations,
          'finished' => '_install_standard_i18n_theme_batch_finished',
          'title' => st('Installing optional themes from drupal.org'),
          'error_message' => st('The installation has encountered an error.'),
        );
        // Start a batch, switch to 'locale-initial-batch' task. We need to
        // set the variable here, because batch_process() redirects.
        ///variable_set('install_task', 'locale-initial-batch');
        variable_set('install_task', 'locale-remaining-batch');
        batch_set($batch);
        batch_process($url, $url);
      }
      // No optional themes to install.
      else {
        variable_del('ipkg_themes_install');
        $task = 'profile-finished';
      }
    }
  }
}

/**
 * Callback for the optional theme batch.
 *
 * Advance installer task to the optional themes.
 */
function _install_standard_i18n_theme_batch($success, $results) {
  variable_del('ipkg_modules_install');
  variable_set('install_task', 'optional-themes');
}

/**
 * Finished callback for the optional theme batch.
 *
 * Advance installer task to the profile-finished screen.
 */
function _install_standard_i18n_theme_batch_finished($success, $results) {
  variable_del('ipkg_themes_install');
  variable_set('install_task', 'profile-finished');
}

/**
 * Form API array definition for site configuration.
 */
function standard_i18n_optional_modules_form(&$form_state, $url) {
  $profile = 'standard_i18n';

  $form['optional_modules'] = array(
    '#type' => 'fieldset',
    '#title' => st('Optional modules'),
    '#description' => st('You can install optional modules. Please select one or multiple modules to install it.'),
    '#collapsible' => FALSE,
  );
  $form['optional_modules']['ipkg_modules'] = array(
    '#type' => 'checkboxes',
    '#title' => st('Optional modules'),
    '#options' => _standard_i18n_optional_modules($profile),
  );
  $form['continue_modules'] = array(
    '#type' => 'submit',
    '#value' => st('Save and continue'),
  );

  // Note that #action is set to the url passed through from
  // installer, ensuring that it points to the same page, and
  // #redirect is FALSE to avoid broken installer workflow.
  $form['errors'] = array();
  $form['#action'] = $url;
  $form['#redirect'] = FALSE;

  return $form;
}

/**
 * Form API submit for the standard_optional_modules form.
 *
 * Handle optional modules.
 */
function standard_i18n_optional_modules_form_submit($form, &$form_state) {
  variable_set('ipkg_modules_install', TRUE);

  // Optional modules.
  $cm = 0;
  $modules_list = array();
  foreach ($form_state['values']['ipkg_modules'] as $key => $module) {
    if ($module != '0') {
      $cm++;
      $modules_list[$key] = $key;
    }
  }
  if ($cm > 0) {
    variable_set('ipkg_modules_list', $modules_list);
  }
}

/**
 * Form API array definition for site configuration.
 */
function standard_i18n_optional_themes_form(&$form_state, $url) {
  global $profile;

  $form['optional_themes'] = array(
    '#type' => 'fieldset',
    '#title' => st('Optional themes'),
    '#description' => st('You can install optional themes. Please select one or multiple themes to install it.'),
    '#collapsible' => FALSE,
  );
  $form['optional_themes']['ipkg_themes'] = array(
    '#type' => 'checkboxes',
    '#title' => st('Optional themes'),
    '#options' => _profile_optional_themes($profile),
  );
  $form['continue_themes'] = array(
    '#type' => 'submit',
    '#value' => st('Save and continue'),
  );

  // Note that #action is set to the url passed through from
  // installer, ensuring that it points to the same page, and
  // #redirect is FALSE to avoid broken installer workflow.
  $form['errors'] = array();
  $form['#action'] = $url;
  $form['#redirect'] = FALSE;

  return $form;
}

/**
 * Form API submit for the standard_optional_themes form.
 *
 * Handle optional themes.
 */
function standard_i18n_optional_themes_form_submit($form, &$form_state) {
  variable_set('ipkg_themes_install', TRUE);

  // Optional themes.
  $ct = 0;
  $themes_list = array();
  foreach ($form_state['values']['ipkg_themes'] as $key => $theme) {
    if ($theme != '0') {
      $ct++;
      $themes_list[$key] = $key;
    }
  }
  if ($ct > 0) {
    variable_set('ipkg_themes_list', $themes_list);
  }
}

/**
 * Define contributed modules, will be install.
 *
 * @return
 *   An array contain the additional contributed modules.
 */
function _standard_i18n_contrib_modules($profile) {
  $contrib_modules = _profile_contrib_modules($profile);

  return $contrib_modules;
}

/**
 * Define optional contributed modules, can be install.
 *
 * @return
 *   An array contain the optional contributed modules.
 */
function _standard_i18n_optional_modules($profile) {
  $optional_modules = _profile_optional_modules($profile);

  return $optional_modules;
}

/**
 * Modify the default settings of Drupal and contributed modules.
 */
function _standard_i18nprofile_modify_settings() {
  global $theme_key;

  // Theme related.
  // Note: Theme acquia_marina please not download.
  system_initialize_theme_blocks('garland');
  variable_set('theme_default', 'garland');
  variable_set('admin_theme', 'garland');
  $theme_settings = variable_get('theme_settings', array());
  $theme_settings['toggle_node_info_page'] = FALSE;
  variable_set('theme_settings', $theme_settings);
  $theme_key = 'garland';

  // Set logo and favicon.

  // Views - disable hover setting.
  variable_set('views_no_hover_links', '1');

  // Set a default footer message.
  _profile_set_footer();
}

/**
 * Set the content types for this profile.
 */
function _standard_i18nprofile_set_content_types() {
  global $language;

  // Insert default user-defined node types into the database. For a complete
  // list of available node type attributes, refer to the node type API
  // documentation at: http://api.drupal.org/api/HEAD/function/hook_node_info.
  $types = array(
    array(
      'type' => 'page',
      'name' => st('Page'),
      'module' => 'node',
      'description' => st("A <em>page</em>, similar in form to a <em>story</em>, is a simple method for creating and displaying information that rarely changes, such as an \"About us\" section of a website. By default, a <em>page</em> entry does not allow visitor comments and is not featured on the site's initial home page."),
      'custom' => TRUE,
      'modified' => TRUE,
      'locked' => FALSE,
      'help' => '',
      'min_word_count' => '',
    ),
    array(
      'type' => 'article',
      'name' => st('Article'),
      'module' => 'node',
      'description' => st("A <em>article</em>, similar in form to a <em>page</em>, is ideal for creating and displaying content that informs or engages website visitors. Press releases, site announcements, and informal blog-like entries may all be created with a <em>article</em> entry. By default, a <em>article</em> entry is automatically featured on the site's initial home page, and provides the ability to post comments."),
      'custom' => TRUE,
      'modified' => TRUE,
      'locked' => FALSE,
      'help' => '',
      'min_word_count' => '',
    ),
  );

  foreach ($types as $type) {
    $type = (object) _node_type_set_defaults($type);
    node_type_save($type);
  }

  // Default page to not be promoted and have comments disabled.
  variable_set('node_options_page', array('status'));
  variable_set('comment_page', COMMENT_NODE_DISABLED);

  // Disable "Promoted to front page" for article.
  variable_set('node_options_article', array('status'));

  // Add a node describing how to get started with Drupal.
  _profile_add_describing_node('standard_i18n', $language);
}

/**
 * Modify the block settings.
 */
function _standard_i18nprofile_modify_blocks() {
  // Fill the DB with default block info.
  _block_rehash();

  // Hide "Powered by Drupal".
  foreach (list_themes() as $theme => $values) {
    db_query("DELETE FROM {blocks} WHERE module = '%s' AND theme = '%s' " .
             "AND region = '%s'", 'system', $theme, 'footer');
  }
}

/**
 * Implementation of hook_form_alter().
 *
 * Allows the profile to alter the site-configuration form. This is
 * called through custom invocation, so $form_state is not populated.
 */
function standard_i18n_form_alter(&$form, $form_state, $form_id) {
  if ($form_id == 'install_configure') {
    // Set default for site name field.
    $form['site_information']['site_name']['#default_value'] = $_SERVER['SERVER_NAME'];
    // Set default for administrator account name.
    $form['admin_account']['account']['name']['#default_value'] = 'admin';
    // Important Installer information.
    $form = _profile_form_alter_important_info($form);
  }
}

/**
 * Profile required JS.
 */
_profile_required_js();