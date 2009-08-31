<?php
// $Id: get_files.inc, v 1.0 2009/08/21 13:11:33 quiptime Exp $

/**
 * Gets module and theme archive files from ftp.drupal.org, save to module or theme folder.
 * Extracts each to ./sites/all/modules/contrib
 * Extracts each to ./sites/all/themes
 *
 * @param $profile
 *   Name of installation profile.
 * @param $op
 *   Identifier for modules and themes to download and install.
 *   'modules' Additional contributed modules.
 *   'optional_modules' Optional contributed modules.
 *   'themes' Optional contributed themes.
 * @param $files_list
 *   Array of files to download.
 * @param $allow
 *   Array of parameters to allow alpha,- beta- or dev-versions of modules and themes.
 * @param $drupal_version
 *   Number of Drupal Major version for download compatibility.
 * @returns $mod_inst
 *   Array of modules placed in ./sites/all/modules/contrib
 */
function profile_download_files($profile, $op = 'modules', $files_list = array(), $ignore, $drupal_version = 6) {
  // Make sure this is only called once during the install process.
  global $profile_download_modules_complete;

  // Important, hide error messages.
  error_reporting(0);

  if ($profile_download_modules_complete) {
    return;
  }

  include_once './includes/common.inc';
  $count = $unpack = 0;

  // Install profile modules directory.
  $p_dir = './profiles/' .$profile. '/modules/';
  // Contributed modules directory.
  $m_dir = './sites/all/modules/contrib/';
  // Own modules directory.
  $o_dir = './sites/all/modules/own/';
  // Themes directory.
  $t_dir = './sites/all/themes/';

  // Organize error messages output.
  $error_message = array();
  $string_2 = st('Please define the write permissions (775 or 777) for this directory.');
  if (!is_writeable($m_dir)) {
    $error_message[] = preg_replace("/^\.\//", '', $m_dir) .' '. st('is not writeable');
  }
  if (!is_writeable($o_dir)) {
    $error_message[] = preg_replace("/^\.\//", '', $o_dir) .' '. st('is not writeable');
  }
  if (!is_writeable($t_dir)) {
    $error_message[] = preg_replace("/^\.\//", '', $t_dir) .' '. st('is not writeable');
  }
  if (count($error_message) > 0) {
    foreach ($error_message as $message) {
      drupal_set_message($message .'<br />'.$string_2 , 'error');
    }
    return false;
  }

  // Define file list for download.
  if ($op == 'modules') {
    $core_modules = array();
    foreach (drupal_system_listing('.module$', 'modules', 'name', 0) as $core_module) {
      array_push($core_modules, $core_module->name);
    }
    $files_get = array_diff($files_list, $core_modules);
  }
  elseif ($op == 'optional_modules' || $op == 'themes') {
    $files_get = $files_list;
  }
  else {
    return false;
  }

  $ftp_server = 'ftp.drupal.org';
  $connection = ftp_connect($ftp_server) or drupal_set_message("Couldn't connect to $ftp_server to download missing files", 'error');
  $login = ftp_login($connection, 'anonymous', '');

  // Turn passive mode on.
  ftp_pasv($connection, true);

  ftp_chdir($connection, 'pub/drupal/files/projects/');

  // Get file list from current directory.
  $files = ftp_nlist($connection, '.');

  // This is important.
  natsort($files);

  // For each file needed.
  $final_list = array();
  foreach ($files_get as $mod) {
    $nmod = $mod .'-'. $drupal_version;
    // Continue checking only the files that include the name of the module or theme we are after.
    $dev_count = 0;
    foreach ($files as $key => $file) {
      // Avoid dev releases, in that order.
      // NOTE: Set $ignore['dev'] in all *.profile files!
      if ($ignore['dev'] == TRUE) {
        // Some modules and themes have only a dev release.
        // Check if a module or theme has only a dev release.
        if (preg_match("/^$nmod/", $file) && !preg_match("/^$nmod.+-dev/", $file)) {
          $dev_count++;
          $final_list[$key] = $files[$key];
        }
        // A module or theme has only a dev release.
        if (preg_match("/^$nmod/", $file) && preg_match("/^$nmod.+-dev/", $file) && $dev_count == 0) {
          $final_list[$key] = $files[$key];
        }
      }
      // This will install dev release if available and is true for all modules and themes.
      elseif (preg_match("/^$nmod/", $file)) {
        $final_list[$key] = $files[$key];
      }
    }

    // Use the most recent release that satisfies our criteria.
    $dfile = array_pop($final_list);

    // Check exist module/theme x-release.
    // Eg. foobar-6.x-2.1.tar.gz and foobar-6.x-2.x.tar.gz
    if (preg_match("/x\.tar\.gz/", $dfile) && count($final_list) > 1) {
      $dfile = array_pop($final_list);
    }

    // Separate modules and themes.
    if ($op == 'modules') {
      if (ftp_get($connection, $m_dir . $dfile, $dfile, FTP_BINARY)) {
        $count++;
      }
      else {
        drupal_set_message('Could not download module '. $mod, 'error');
      }
    }

    if ($op == 'optional_modules') {
      if (ftp_get($connection, $m_dir . $dfile, $dfile, FTP_BINARY)) {
        $count++;
      }
      else {
        drupal_set_message('Could not download optional module '. $mod, 'error');
      }
    }

    if ($op == 'themes') {
      if (ftp_get($connection, $t_dir . $dfile, $dfile, FTP_BINARY)) {
        $count++;
      }
      else {
        drupal_set_message('Could not download optional theme '. $mod, 'error');
      }
    }

  }
  ftp_close($connection);

  drupal_set_message($count .' file packages (modules or themes) successfully downloaded.');

  // Now to expand archive files.
  $mods_inst = array();
  $extract_dir = array($m_dir, $t_dir);
  foreach ($extract_dir as $dir) {
    $profile_modfiles = glob($dir.'*.gz');
    $ospos = stripos(php_uname('s'), 'Windows');

    foreach ($profile_modfiles as $modfile) {
      if ($ospos !== FALSE ) {
        // Windows command next line NOT working!
        $cmd = shell_exec('c:\WINNT\system32\cmd.exe /c tar -zxf ' . $modfile . ' -C ' . $dir);
      }
      else {
        // Linux command.
        $cmd = shell_exec('tar -zxf ' . $modfile . ' -C ' . $dir);
      }
      if (!$cmd) {
        $unpack++;
        // Builds valid modules or themes.
        array_push($mods_inst, array_shift(split('-', $modfile)));
        // Remove downloaded archive files.
        unlink($modfile);
      }
    }
  }

  if ($ospos !== FALSE ) {
    drupal_set_message('Please check '.$m_dir .' and '. $t_dir.', your files should be there in *.tar.gz format.'.
      ' 7-Zip is a good program for uncompressing them. In future please use a Linux web server, they just work better.');
  }
  else {
    drupal_set_message($unpack .' module or theme packages sucessfully unpacked to '. $m_dir .' and '. $t_dir);
  }

  $profile_download_modules_complete = TRUE;

  return $mods_inst;
}
