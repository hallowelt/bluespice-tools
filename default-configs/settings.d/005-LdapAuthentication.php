<?php

require_once "$IP/extensions/LdapAuthentication/LdapAuthentication.php";
require_once "$IP/extensions/LdapAuthentication/LdapAutoAuthentication.php";
require_once "$IP/extensions/BlueSpiceLdapAuthenticationConnector/LdapAuthenticationConnector.setup.php";

if ( !isset( $bsgLDAPLocalUsers ) ) {
	$bsgLDAPLocalUsers[] = 'Wikisysop';
}

if ( file_exists( "$IP/LocalSettings.ldap.php" ) && PHP_SAPI != 'cli' ) {
	if ( isset( $_POST['wpName'] ) && in_array( $_POST['wpName'], $bsgLDAPLocalUsers ) ) {
        require_once "$IP/LocalSettings.ldap.php";
	}
}
