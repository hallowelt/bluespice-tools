<?php

wfLoadExtension( 'PdfHandler' );

$wgPdfProcessor = '/usr/bin/gs';
$wgPdfPostProcessor = $wgImageMagickConvertCommand;
$wgPdfInfo = '/usr/bin/pdfinfo';
$wgPdftoText = '/usr/bin/pdftotext';
