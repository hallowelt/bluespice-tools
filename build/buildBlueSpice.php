<?php

//
// Require configuration file
//
require_once __DIR__ . "/config.php";

//
// Define WorkDir
//
if ( isset( $cfgWorkDir ) && !empty( $cfgWorkDir ) ) {
	$workDir = $cfgWorkDir;
}
else {
	$workDir = __DIR__;
}

//
// Define possible command-line-options
//
$shortopts  = "";
$shortopts .= "b:"; // Branch
$shortopts .= "h::"; // Help
$shortopts .= "m:"; // MediaWiki Version
$shortopts .= "o:"; // Output-Name

//
// Read command-line options
//
$options = getopt( $shortopts );

//
// Show help
//
if ( isset( $options['h'] ) ) {
	echo "\nUsage:\n\n";
	echo "  -b [Branch]              Use this branch for BlueSpice (default: " . $cfgDefaultBranch . ").\n";
	echo "  -m [MediaWiki-Version]   Version of MediaWiki. Enables building with installer.\n";
	echo "  -o [Output version name] Version name of your build (default: " . $cfgDefaultOutput . ").\n";
	echo "  -h                       Shows this help.\n";
	exit;
}

//
// Define defaults
//
if ( isset( $options['b'] ) ) {
	$build['branch'] = $options['b'];
}
else {
	$build['branch'] = $cfgDefaultBranch;
}
if ( isset( $options['m'] ) ) {
	$build['mediawiki'] = $options['m'];
}
if ( isset( $options['o'] ) ) {
	$build['output'] = $options['o'];
}
else {
	$build['output'] = $cfgDefaultOutput;
}

//
// Try to create a temporary directory if not exists
//
if ( !file_exists( __DIR__ . "/tmp" ) ) {
	mkdir( __DIR__ . "/tmp" );
}
elseif ( !is_dir( __DIR__ . "/tmp" ) ) {
	die( __DIR__ . '/tmp exists but is no folder. Aborting.' );
}

//
// Clean temporary directory
//
exec( 'rm -rf ' . __DIR__ . '/tmp/*' );

//
// Download MediaWiki if needed or create directory "bluespice-free" and needed subfolders
//
if ( isset( $build['mediawiki'] ) ) {
	$MediaWikiMajorRelease = substr( $build['mediawiki'], 0, strpos( $build['mediawiki'], '.', 2 ) );
	$MediaWikiDownloadFile = str_replace( '%1', $build['mediawiki'] , $cfgMediaWikiDownloadFile );
	$MediaWikiDownloadPath = $cfgMediaWikiDownloadPath . '/' . $MediaWikiMajorRelease . '/' . $MediaWikiDownloadFile;
	if ( !file_exists( __DIR__ . '/tmp/' . $MediaWikiDownloadFile ) ) {
		exec( 'wget --no-check-certificate -P ' . __DIR__ . '/tmp ' . $MediaWikiDownloadPath );

		
	}
	if ( !file_exists( __DIR__ . '/tmp/' . $MediaWikiDownloadFile ) ) {
		die( 'Could not download ' . $MediaWikiDownloadFile . '. Aborting.' );
	}
	else {
		exec( 'tar xzf ' . $workDir . '/tmp/' .$MediaWikiDownloadFile . ' -C ' . __DIR__ . '/tmp/' );
		exec( 'rm -f ' . __DIR__ . '/tmp/' . $MediaWikiDownloadFile );
		exec( 'mv ' . __DIR__ . '/tmp/' . substr( $MediaWikiDownloadFile, 0, strpos( $MediaWikiDownloadFile, '.tar.gz') ) . ' ' . __DIR__ . '/tmp/bluespice-free' );
	}
}
else {
	mkdir( __DIR__ . '/tmp/bluespice-free' );
	mkdir( __DIR__ . '/tmp/bluespice-free/extensions' );
	mkdir( __DIR__ . '/tmp/bluespice-free/skins' );
}

//
// Check if all needed directories exists
//
if ( !file_exists( __DIR__ . '/tmp/bluespice-free' ) ) {
	die( "Directory " . __DIR__ . "/tmp/bluespice-free does not exists. Aborting." );
}
if ( !file_exists( __DIR__ . '/tmp/bluespice-free/extensions' ) ) {
	die( "Directory " . __DIR__ . "/tmp/bluespice-free/extensions does not exists. Aborting." );
}
if ( !file_exists( __DIR__ . '/tmp/bluespice-free/skins' ) ) {
	die( "Directory " . __DIR__ . "/tmp/bluespice-free/skins does not exists. Aborting." );
}

//
// Clone BlueSpiceExtensions
//
exec( 'git clone https://gerrit.wikimedia.org/r/mediawiki/extensions/BlueSpiceExtensions ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceExtensions --branch ' . $build['branch'] );

//
// Clone BlueSpiceFoundation
//
exec( 'git clone https://gerrit.wikimedia.org/r/mediawiki/extensions/BlueSpiceFoundation ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceFoundation --branch ' . $build['branch'] );

//
// Move needed files to root directory
//
exec( 'mv ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceFoundation/BLUESPICE-* ' . __DIR__ . '/tmp/bluespice-free' );
exec( 'mv ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceFoundation/installcheck.php ' . __DIR__ . '/tmp/bluespice-free' );

//
// Clone BlueSpiceTagCloud
//
exec( 'git clone git@gitlab.hallowelt.com:BlueSpice/mediawiki-extensions-bluespicetagcloud.git ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceTagCloud --branch ' . $build['branch'] );

//
// If it's with installer rename data.template and config.template
//
if ( isset( $build['mediawiki'] ) ) {
	exec( 'mv ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceFoundation/config.template ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceFoundation/config' );
	exec( 'mv ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceFoundation/data.template ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceFoundation/data' );
}
	
//
// Clone BlueSpiceSkin
//
exec( 'git clone https://gerrit.wikimedia.org/r/mediawiki/skins/BlueSpiceSkin ' . __DIR__ . '/tmp/bluespice-free/skins/BlueSpiceSkin --branch ' . $build['branch'] );

//
// Build BlueSpiceDistribution
//
$fopen = fopen( __DIR__ . '/tmp/bluespice-free/LocalSettings.BlueSpiceDistribution.php', 'w' );
fwrite( $fopen, "<?php\n" );
fwrite( $fopen, "//\n" );
fwrite( $fopen, "// Include LocalSettings.BlueSpiceDistribution.php in LocalSettings.php to activate all modules:\n" );
fwrite( $fopen, "// require_once \"LocalSettings.BlueSpiceDistribution.php\";\n" );
fwrite( $fopen, "//\n" );

foreach ( $cfgDistributionExtension as $distributionExtension ) {

	if ( isset( $distributionExtension['name'] ) && isset( $distributionExtension['url'] ) ) {

		//
		// GIT cloning
		//
		if ( isset( $distributionExtension['downloadtype'] ) && $distributionExtension['downloadtype'] == 'git' ) {
			if ( isset( $distributionExtension['branch'] ) ) {
				$gitBranch = ' -b ' . $distributionExtension['branch'];
			}
			else {
				$gitBranch = ' -b master';
			}
			exec( 'git clone ' . $distributionExtension['url'] . ' ' . __DIR__ . '/tmp/bluespice-free/extensions/' . $distributionExtension['name'] . $gitBranch);
		}

		//
		// Download package
		//
		else {
			if ( isset( $distributionExtension['downloadtype'] ) && $distributionExtension['downloadtype'] == 'tar.gz' ) {
				$fileEnding = '.tar.gz';
			}
			else {
				$fileEnding = '.zip';
				$unpackCmd = 'unzip %1 -d %2';
			}
			$outputFile = $distributionExtension['name'] . $fileEnding;
			exec( 'wget --no-check-certificate -O ' . __DIR__ . '/tmp/' . $outputFile . ' ' . $distributionExtension['url'] );
			mkdir( __DIR__ . '/tmp/_' . $distributionExtension['name'] );
			$unpackCmd = str_replace( '%1', $workDir . '/tmp/' . $outputFile, $unpackCmd );
			$unpackCmd = str_replace( '%2', $workDir . '/tmp/_' . $distributionExtension['name'], $unpackCmd );
			exec( $unpackCmd );
			exec( 'mv ' . __DIR__ . '/tmp/_' . $distributionExtension['name'] . '/* ' . __DIR__ . '/tmp/bluespice-free/extensions/' . $distributionExtension['name'] );
			exec( 'rm -rf ' . __DIR__ . '/tmp/_' . $distributionExtension['name'] );
			exec( 'rm -f ' . __DIR__ . '/tmp/' . $outputFile );
		}

		//
		// Define include filename
		//
		if ( !isset( $distributionExtension['incfile'] ) ) {
			$distributionExtension['incfile'] = $distributionExtension['name'] . '.php';
		}
		else {
			$distributionExtension['incfile'] = $distributionExtension['name'];
		}

		//
		// Decide which type of extension loader should be used
		//
		if ( isset( $distributionExtension['loadtype'] ) && $distributionExtension['loadtype'] == 'LoadExtension' ) {
			$writeString = "wfLoadExtension( \"" . $distributionExtension['name'] . "\" );\n";
		}
		else {
			$writeString = "require_once \"\$IP/extensions/" . $distributionExtension['name'] . "/" . $distributionExtension['incfile'] . "\";\n";
		}

		//
		// Uncomment extension by default
		//
		if ( isset( $distributionExtension['uncommented'] ) && $distributionExtension['uncommented'] === true ) {
			$writeString = '// ' . $writeString;
		}

		//
		// Write LocalSettings.BlueSpiceDistribution.php//
		fwrite( $fopen, $writeString );
		if ( isset( $distributionExtension['attribute'] ) ) {
			foreach ( $distributionExtension['attribute'] as $extensionAttribute ) {
				fwrite( $fopen, $extensionAttribute . "\n" );
			}
		}

	}

}

//
// Write additional lines to LocalSettings.BlueSpiceDistribution.php
//
fwrite( $fopen, "//\n" );
fwrite( $fopen, "// By default this is disabled. See https://gerrit.wikimedia.org/r/#/c/193359/1\n" );
fwrite( $fopen, "// If this is needed depends on the actual LDAP setup\n" );
fwrite( $fopen, "// \$wgHooks['SetUsernameAttributeFromLDAP'][] = 'BlueSpiceDistributionHooks::onSetUsernameAttribute';\n" );

fclose( $fopen );

//
// Composer installations
//
foreach ( $cfgNeededComposerInstallations as $composerExt ) {
	if ( file_exists( __DIR__ . '/tmp/bluespice-free/' . $composerExt ) ) {
		exec( 'sh ' . __DIR__ . '/bin/composerinstall.sh ' . __DIR__ . '/tmp/bluespice-free/' . $composerExt );
	}
}

//
// Rename BlueSpiceTagCloud.php.template
//
exec( 'mv ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceTagCloud/BlueSpiceTagCloud.php.template ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceTagCloud/BlueSpiceTagCloud.php' );

//
// Including overrides for installer
//
if ( isset( $build['mediawiki'] ) ) {
	exec( 'git clone https://github.com/hallowelt/bluespice-config-mw-overrides ' . __DIR__ . '/tmp/mw-overrides -b master' );
	exec( 'rm -rf ' . __DIR__ . '/tmp/bluespice-free/mw-config/overrides' );
	exec( 'mv ' . __DIR__ . '/tmp/mw-overrides ' . __DIR__ . '/tmp/bluespice-free/mw-config/overrides' );
}

//
// Deleting all not needed files
//
exec( 'sh ' . __DIR__ . '/bin/FindAndDelete.sh ' . $workDir . '/tmp/bluespice-free' );

//
// Adding webservices
//
exec( 'cp -a ' . __DIR__ . '/webservices/solr/* ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceExtensions/ExtendedSearch/webservices' );
exec( 'cp -a ' . __DIR__ . '/webservices/BShtml2PDF/* ' . __DIR__ . '/tmp/bluespice-free/extensions/BlueSpiceExtensions/UEModulePDF/webservices' );

//
// Writing LocalSettings.BlueSpice.php
//
if ( isset( $build['mediawiki'] ) ) {
	$fopen = fopen( __DIR__ . '/tmp/bluespice-free/LocalSettings.BlueSpice.php', 'w' );
}
else {
	$fopen = fopen( __DIR__ . '/tmp/bluespice-free/LocalSettings.BlueSpice.php.template', 'w' );
}
fwrite( $fopen, "<?php\n" );
fwrite( $fopen, "require_once \"\$IP/LocalSettings.BlueSpiceDistribution.php\";\n" );
fwrite( $fopen, "require_once \"\$IP/extensions/BlueSpiceFoundation/BlueSpiceFoundation.php\";\n" );
fwrite( $fopen, "require_once \"\$IP/extensions/BlueSpiceExtensions/BlueSpiceExtensions.php\";\n" );
fwrite( $fopen, "require_once \"\$IP/extensions/BlueSpiceTagCloud/BlueSpiceTagCloud.php\";\n" );
fwrite( $fopen, "require_once \"\$IP/skins/BlueSpiceSkin/BlueSpiceSkin.php\";\n" );
fwrite( $fopen, "\$GLOBALS['wgDefaultSkin'] = \"bluespiceskin\";" );
fclose( $fopen );

//
// Creating zip-archive
//
if ( isset( $build['mediawiki'] ) ) {
	$archiveName = 'BlueSpice-free-' . $build['output'] . '-installer.zip';
}
else {
	$archiveName = 'BlueSpice-free-' . $build['output'] . '.zip';
}
#exec( 'sh ' . $workDir . '/bin/CreateZipFile.sh ' . $workDir . '/tmp ' . $archiveName );
