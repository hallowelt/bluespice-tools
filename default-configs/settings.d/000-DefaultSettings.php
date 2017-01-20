<?php

$wgLocalTZoffset = date("Z") / 60;
$wgLocaltimezone = 'Europe/Berlin';
$wgDefaultUserOptions['timecorrection'] = 'ZoneInfo|' . (date("I") ? 120 : 60) . '|Europe/Berlin';
$wgUrlProtocols[] = 'file://';
$wgNamespacesWithSubpages[NS_MAIN] = true;
$wgExternalLinkTarget = '_blank';