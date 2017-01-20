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

$fileArray = array();

if ( $dirHandle = opendir( $settingsDir ) ) {
        while ( ( $file = readdir( $dirHandle ) ) !== false ) {
                if ( filetype( "{$settingsDir}/{$file}" )  == 'file' ) {
                        array_push( $fileArray, "{$settingsDir}/{$file}" );
                }
        }
        closedir( $dirHandle );
}

sort( $fileArray );

foreach ( $fileArray as $file ) {
        require_once $file;
}
