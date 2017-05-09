<?php

require_once "$IP/extensions/LdapAuthentication/LdapAuthentication.php";
require_once "$IP/extensions/LdapAuthentication/LdapAutoAuthentication.php";
require_once "$IP/extensions/BlueSpiceLdapAuthenticationConnector/LdapAuthenticationConnector.setup.php";

if ( ( !( isset($_POST['wpName']) && $_POST['wpName'] === 'Wikisysop' ) ) &&
     PHP_SAPI != 'cli' &&
     file_exists( "$IP/LocalSettings.ldap.php" ) ) {
        require_once "$IP/LocalSettings.ldap.php";
}
