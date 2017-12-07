<?php

//
// This file includes automatically all default BlueSpice settings
//

if ( !defined( 'MEDIAWIKI' ) ) {
    exit;
}

if ( isset( $bsgSettingsDir ) ) {
	$settingsDir = $bsgSettingsDir;
}
else {
	$settingsDir = "$IP/settings.d";
}

$loaded = [];

foreach ( glob( $settingsDir . "/*.php" ) as $conffile ) {

	$searchString = preg_replace( '/\\.[^.\\s]{3,4}$/', '', $conffile ) . ".local.php";

	if ( file_exists( $searchString ) ) {
		$conffile = $searchString;
		$loaded[] = $searchString;
	}

	if ( !in_array( $conffile, $loaded) ) {
		require_once $conffile;
	}

}
