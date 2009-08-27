/* $Id: ipkg_manager.js, v 1.0 2009/08/25 17:04:45 quiptime $ */

Drupal.ipkger = function () {
 $('#edit-locale').attr("checked", "checked");

 var addModulesInfo = Drupal.t('Downloading profile modules ... Please wait.');
 var optModulesInfo = Drupal.t('Downloading optional modules ... Please wait.');
 var optThemesInfo = Drupal.t('Downloading optional themes ... Please wait.');

 $('#install-select-locale-form #edit-submit').after('<div id="download-throbber" style="display: none;"><img style="padding-right: 10px;" src="../../profiles/profiles_includes/loader.gif" alt="Loader" align="absmiddle"> '+addModulesInfo+'</div>');
 $('#edit-continue-modules').after('<div id="download-throbber" style="display: none;"><img style="padding-right: 10px;" src="../../profiles/profiles_includes/loader.gif" alt="Loader" align="absmiddle"> '+optModulesInfo+'</div>');
 $('#edit-continue-themes').after('<div id="download-throbber" style="display: none;"><img style="padding-right: 10px;" src="../../profiles/profiles_includes/loader.gif" alt="Loader" align="absmiddle"> '+optThemesInfo+'</div>');

 $('#install-select-locale-form #edit-submit').click( function() {
  $('#download-throbber').show();
 } );
 $('#edit-continue-modules').click( function() {
   $('#download-throbber').show();
 } );
 $('#edit-continue-themes').click( function() {
   $('#download-throbber').show();
 } );
}

if (Drupal.jsEnabled) {
  $(document).ready(Drupal.ipkger);
}