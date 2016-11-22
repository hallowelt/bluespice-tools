<?php

//Require BlueSpice Free components
require_once "$IP/LocalSettings.BlueSpiceDistribution.php";
require_once "$IP/extensions/BlueSpiceFoundation/BlueSpiceFoundation.php";
require_once "$IP/extensions/BlueSpiceExtensions/BlueSpiceExtensions.php";
require_once "$IP/skins/BlueSpiceSkin/BlueSpiceSkin.php";

//Default MediaWiki settings needed for BlueSpice
$GLOBALS['wgNamespacesWithSubpages'][NS_MAIN] = true;
$GLOBALS['wgApiFrameOptions'] = 'SAMEORIGIN';
$GLOBALS['wgRSSUrlWhitelist'] = array(
	"http://blog.blue-spice.org/feed/",
	"http://blog.bluespice.com/feed/",
	"http://blog.hallowelt.com/feed/",
);
$GLOBALS['wgExternalLinkTarget'] = '_blank';
$GLOBALS['wgCapitalLinkOverrides'][ NS_FILE ] = false;
$GLOBALS['wgRestrictDisplayTitle'] = false; //Otherwise only titles that normalize to the same DB key are allowed
$GLOBALS['wgUrlProtocols'][] = "file://";
$GLOBALS['wgVerifyMimeType'] = false;
$GLOBALS['wgAllowJavaUploads'] = true;

//Skin specific
$GLOBALS['wgDefaultSkin'] = 'bluespiceskin';
$GLOBALS['wgSkipSkins'] = array(
	'chick',
	'cologneblue',
	'common',
	'modern',
	'monobook',
	'myskin',
	'nostalgia',
	'simple',
	'standard'
);
