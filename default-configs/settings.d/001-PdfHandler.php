<?php

wfLoadExtension( 'PdfHandler' );

$wgPdfProcessor = '/usr/local/bin/gs';
$wgPdfPostProcessor = $wgImageMagickConvertCommand;
$wgPdfInfo = '/usr/bin/pdfinfo';
$wgPdftoText = '/usr/bin/pdftotext';
