<?php

$wgSVGConverters = array( 'inkscape' => '"/usr/bin/inkscape" -z -w $width -f $input -e $output' ); 
$wgSVGConverter = 'inkscape';
$wgMaxShellMemory = 4096000;
$wgSVGMaxSize = 2048;