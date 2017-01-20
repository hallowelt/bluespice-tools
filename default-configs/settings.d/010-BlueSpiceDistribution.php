<?php

require_once "$IP/extensions/CategoryTree/CategoryTree.php";
require_once "$IP/extensions/DynamicPageList/DynamicPageList.php";
require_once "$IP/extensions/HitCounters/HitCounters.php";
require_once "$IP/extensions/ImageMapEdit/ImageMapEdit.php";
require_once "$IP/extensions/Lockdown/Lockdown.php";
require_once "$IP/extensions/Quiz/Quiz.php";
require_once "$IP/extensions/RSS/RSS.php";
require_once "$IP/extensions/Echo/Echo.php";
require_once "$IP/extensions/TitleKey/TitleKey.php";
require_once "$IP/extensions/EmbedVideo/EmbedVideo.php";
require_once "$IP/extensions/UserMerge/UserMerge.php";
$wgUserMergeProtectedGroups = array();
$wgUserMergeUnmergeable = array();
require_once "$IP/extensions/EditNotify/EditNotify.php";
require_once "$IP/extensions/MobileFrontend/MobileFrontend.php";
$wgMFAutodetectMobileView = true;
$wgMFEnableDesktopResources = true;
require_once "$IP/extensions/BlueSpiceEchoConnector/BlueSpiceEchoConnector.php";
require_once "$IP/extensions/BlueSpiceDistributionConnector/BlueSpiceDistributionConnector.php";
require_once "$IP/extensions/BlueSpiceUserMergeConnector/BlueSpiceUserMergeConnector.php";
wfLoadExtension( "BlueSpiceEditNotifyConnector" );
