<?php

# Old "version". Changed with Inkscape >= 1.x
#$wgSVGConverters = array( 'inkscape' => '"/usr/bin/inkscape" -z -w $width -f $input -e $output' );

$wgSVGConverters = [ 'inkscape' => '"E:\bluespice\bin\inkscape-1.1\bin\inkscape.exe" --export-filename $output -w $width $input' ]; 
$wgSVGConverter = 'inkscape';
$wgMaxShellMemory = 4096000;
$wgSVGMaxSize = 2048;
