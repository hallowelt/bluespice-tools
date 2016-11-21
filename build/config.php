<?php

$cfgDefaultBranch = 'master';
$cfgDefaultOutput = '2.27.0';

$cfgWorkDir = '/cygdrive/c/WorkDir/BuildService';

$cfgMediaWikiDownloadPath = 'https://releases.wikimedia.org/mediawiki';
$cfgMediaWikiDownloadFile = 'mediawiki-%1.tar.gz';

$cfgNeededComposerInstallations =
	array( 'extensions/BlueSpiceFoundation', );

//
// Distribution settings
//
$cfgDistributionExtension['CategoryTree']['name'] = 'CategoryTree';
$cfgDistributionExtension['CategoryTree']['url'] = 'https://github.com/wikimedia/mediawiki-extensions-CategoryTree/archive/REL1_27.zip';
$cfgDistributionExtension['DynamicPageList']['name'] = 'DynamicPageList';
$cfgDistributionExtension['DynamicPageList']['url'] = 'https://github.com/Alexia/DynamicPageList/archive/master.zip';
$cfgDistributionExtension['HitCounters']['name'] = 'HitCounters';
$cfgDistributionExtension['HitCounters']['url'] = 'https://github.com/wikimedia/mediawiki-extensions-HitCounters/archive/REL1_27.zip';
$cfgDistributionExtension['ImageMapEdit']['name'] = 'ImageMapEdit';
$cfgDistributionExtension['ImageMapEdit']['url'] = 'https://github.com/hallowelt/mediawiki-extensions-ImageMapEdit/archive/master.zip';
$cfgDistributionExtension['Lockdown']['name'] = 'Lockdown';
$cfgDistributionExtension['Lockdown']['url'] = 'https://github.com/wikimedia/mediawiki-extensions-Lockdown/archive/REL1_27.zip';
$cfgDistributionExtension['Quiz']['name'] = 'Quiz';
$cfgDistributionExtension['Quiz']['url'] = 'https://github.com/wikimedia/mediawiki-extensions-Quiz/archive/REL1_27.zip';
$cfgDistributionExtension['RSS']['name'] = 'RSS';
$cfgDistributionExtension['RSS']['url'] = 'https://github.com/wikimedia/mediawiki-extensions-RSS/archive/REL1_27.zip';
$cfgDistributionExtension['Echo']['name'] = 'Echo';
$cfgDistributionExtension['Echo']['url'] = 'https://github.com/wikimedia/mediawiki-extensions-Echo/archive/REL1_27.zip';
$cfgDistributionExtension['TitleKey']['name'] = 'TitleKey';
$cfgDistributionExtension['TitleKey']['url'] = 'https://github.com/wikimedia/mediawiki-extensions-TitleKey/archive/REL1_27.zip';
$cfgDistributionExtension['EmbedVideo']['name'] = 'EmbedVideo';
$cfgDistributionExtension['EmbedVideo']['url'] = 'https://github.com/HydraWiki/mediawiki-embedvideo/archive/v2.4.1.zip';
$cfgDistributionExtension['UserMerge']['attribute'][] = '$wgUserMergeProtectedGroups = array();';
$cfgDistributionExtension['UserMerge']['attribute'][] = '$wgUserMergeUnmergeable = array();';
$cfgDistributionExtension['UserMerge']['name'] = 'UserMerge';
$cfgDistributionExtension['UserMerge']['url'] = 'https://github.com/wikimedia/mediawiki-extensions-UserMerge/archive/REL1_27.zip';
$cfgDistributionExtension['EditNotify']['name'] = 'EditNotify';
$cfgDistributionExtension['EditNotify']['url'] = 'https://github.com/hallowelt/mediawiki-extensions-EditNotify/archive/master.zip';
$cfgDistributionExtension['MobileFrontend']['attribute'][] = '$wgMFAutodetectMobileView = true;';
$cfgDistributionExtension['MobileFrontend']['attribute'][] = '$wgMFEnableDesktopResources = true;';
$cfgDistributionExtension['MobileFrontend']['name'] = 'MobileFrontend';
$cfgDistributionExtension['MobileFrontend']['url'] = 'https://github.com/wikimedia/mediawiki-extensions-MobileFrontend/archive/REL1_27.zip';
$cfgDistributionExtension['BlueSpiceEchoConnector']['name'] = 'BlueSpiceEchoConnector';
$cfgDistributionExtension['BlueSpiceEchoConnector']['url'] = 'https://github.com/hallowelt/mediawiki-extensions-BlueSpiceEchoConnector/archive/master.zip';
$cfgDistributionExtension['BlueSpiceDistributionConnector']['name'] = 'BlueSpiceDistributionConnector';
$cfgDistributionExtension['BlueSpiceDistributionConnector']['url'] = 'https://github.com/hallowelt/mediawiki-extensions-BlueSpiceDistributionConnector/archive/master.zip';
$cfgDistributionExtension['BlueSpiceUserMergeConnector']['name'] = 'BlueSpiceUserMergeConnector';
$cfgDistributionExtension['BlueSpiceUserMergeConnector']['url'] = 'https://github.com/hallowelt/mediawiki-extensions-BlueSpiceUserMergeConnector/archive/master.zip';
$cfgDistributionExtension['BlueSpiceEditNotifyConnector']['downloadtype'] = 'git';
$cfgDistributionExtension['BlueSpiceEditNotifyConnector']['loadtype'] = 'LoadExtension';
$cfgDistributionExtension['BlueSpiceEditNotifyConnector']['name'] = 'BlueSpiceEditNotifyConnector';
$cfgDistributionExtension['BlueSpiceEditNotifyConnector']['url'] = 'https://gerrit.wikimedia.org/r/mediawiki/extensions/BlueSpiceEditNotifyConnector';
$cfgDistributionExtension['LdapAuthentication']['name'] = 'LdapAuthentication';
$cfgDistributionExtension['LdapAuthentication']['uncommented'] = true;
$cfgDistributionExtension['LdapAuthentication']['url'] = 'https://github.com/hallowelt/mediawiki-extensions-LdapAuthentication/archive/REL1_27.zip';
$cfgDistributionExtension['LdapAuthenticationConnector']['incfile'] = 'LdapAuthenticationConnector.setup.php';
$cfgDistributionExtension['LdapAuthenticationConnector']['name'] = 'LdapAuthenticationConnector';
$cfgDistributionExtension['LdapAuthenticationConnector']['uncommented'] = true;
$cfgDistributionExtension['LdapAuthenticationConnector']['url'] = 'https://github.com/hallowelt/mediawiki-extensions-BlueSpiceLdapAuthenticationConnector/archive/master.zip';