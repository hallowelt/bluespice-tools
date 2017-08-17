<?php

require_once "$IP/extensions/LdapAuthentication/LdapAuthentication.php";
require_once "$IP/extensions/LdapAuthentication/LdapAutoAuthentication.php";
require_once "$IP/extensions/BlueSpiceLdapAuthenticationConnector/LdapAuthenticationConnector.setup.php";

if ( !isset( $bsgLDAPLocalUsers ) ) {
	$bsgLDAPLocalUsers[] = 'Wikisysop';
}

if ( !( isset( $_POST['wpName'] ) && !in_array( $_POST['wpName'], $bsgLDAPLocalUsers ) ) &&
     file_exists( "$IP/LocalSettings.ldap.php" ) &&
	 PHP_SAPI != 'cli' ) {
	require_once "$IP/LocalSettings.ldap.php";
}
