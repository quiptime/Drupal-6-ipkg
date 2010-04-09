/* $Id: ipkg_manager.js, v 1.0 2009/08/25 17:04:45 quiptime $ */

Drupal.ipkger = function () {
 $('#edit-locale').attr("checked", "checked");

 var locale = 'en';
 var addModulesInfo = new Array();
 var optModulesInfo = new Array();
 var optThemesInfo = new Array();

 addModulesInfo['en'] = 'Downloading profile modules ... Please wait.';
 optModulesInfo['en'] = 'Downloading optional modules ... Please wait.';
 optThemesInfo['en'] = 'Downloading optional themes ... Please wait.';
 addModulesInfo['de'] = 'Lade Profilmodule herunter ... Bitte warten.';
 optModulesInfo['de'] = 'Lade optionale Module herunter ... Bitte warten.';
 optThemesInfo['de'] = 'Lade optionale Themen herunter ... Bitte warten.';

 $('#install-select-locale-form #edit-submit').after('<div id="download-throbber" style="display: none;"><img id="loader" style="padding-right: 14px;" src="../../profiles/profiles_includes/loader.gif" alt="Loader" align="absmiddle"></div>');
 $('#edit-continue-modules').after('<div id="download-throbber" style="display: none;"><img id="loader" style="padding-right: 14px;" src="../../profiles/profiles_includes/loader.gif" alt="Loader" align="absmiddle"></div>');
 $('#edit-continue-themes').after('<div id="download-throbber" style="display: none;"><img id="loader" style="padding-right: 14px;" src="../../profiles/profiles_includes/loader.gif" alt="Loader" align="absmiddle"></div>');

 $('#install-select-locale-form #edit-submit').click( function() {
  $('#loader').after(addModulesInfo[checkradio()]);
  $('#download-throbber').show();
 } );

 $('#edit-continue-modules').click( function() {
  var info = '';
  info = optModulesInfo[getlocale("locale")];
  $('#loader').after(info);
  $('#download-throbber').show();
 } );

 $('#edit-continue-themes').click( function() {
  var info = '';
  info = optThemesInfo[getlocale("locale")];
  $('#loader').after(info);
  $('#download-throbber').show();
 } );

 function checkradio() {
  if ($('#edit-locale-1').attr('checked') == true) {
   locale = 'de';
  }
  return locale;
 }

 function getlocale(param) {
  param = param.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+param+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if (results == null) {
    return 'en';
  }
  else {
    return results[1];
  }
 }

}

if (Drupal.jsEnabled) {
  $(document).ready(Drupal.ipkger);
}
