<?php

/* Disable possibility to change password
 * Maybe needed with ldap
 *
 * Core-Hack needed:
 * extensions/BlueSpiceExtensions/UserManager/resources/bluespice.userManager.js
 * Uncomment line 22 'editpassword'
 *
 */

function onBeforePageDisplay( OutputPage &$out, Skin &$skin ) {

  global $wgUser;

  if ( $wgUser->mId != 0 ) {
    return false;
  }

  $script = "<style type=\"text/css\">\n";
  $script .= "div#userloginForm div.mw-form-related-link-container { display: none; }\n";
  $script .= "</style>\n";

  $out->addHeadItem("jsonTree script", $script);

  return true;

}

$wgPasswordResetRoutes = false;

$wgHooks['SpecialPage_initList'][]='disableSomeSpecialPages';
function disableSomeSpecialPages(&$list) {
  unset($list['ChangeCredentials']);
  return true;
}

$wgHooks['GetPreferences'][] = 'RemovePasswordChangeLink';
function RemovePasswordChangeLink ( $user, &$preferences ) {
  unset($preferences['password']);
  return true;
}
