<?php

require_once "$IP/extensions/NativeSvgHandler/NativeSvgHandler.php";
require_once "$IP/extensions/DrawioEditor/DrawioEditor.php";
$wgDrawioEditorImageType = 'png';
require_once "$IP/extensions/Duplicator/Duplicator.php";
require_once "$IP/extensions/HeaderTabs/HeaderTabs.php";
require_once "$IP/extensions/MultimediaViewer/MultimediaViewer.php";
require_once "$IP/extensions/ReplaceText/ReplaceText.php";
require_once "$IP/extensions/Scribunto/Scribunto.php";
$wgScribuntoDefaultEngine = 'luastandalone';
require_once "$IP/extensions/Widgets/Widgets.php";
wfLoadExtension( 'NSFileRepo' );
require_once "$IP/extensions/BlueSpiceNSFileRepoConnector/BlueSpiceNSFileRepoConnector.php";
