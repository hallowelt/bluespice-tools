<?php

//
// This file includes automatically all default BlueSpice settings
//

if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}

if ( file_exists( "$IP/LocalSettings.local.php") ) {
	require_once "$IP/LocalSettings.local.php";	
}

if ( isset( $bsgSettingsDir ) ) {
	$settingsDir = $bsgSettingsDir;
}
else {
	$settingsDir = "$IP/settings.d";
}

foreach ( glob( $settingsDir . "/*.php" ) as $conffile ) {
	include_once $conffile;
}
