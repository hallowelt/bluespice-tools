<?php

/*
 *
 * Make MediaWiki rechable via ShortUrl /wiki/
 * Documentation: https://www.mediawiki.org/wiki/Manual:Short_URL
 *
 * For apache integration please add the following rewrite rule to your vhosts:
 *
 * RewriteEngine On
 * RewriteRule ^/?wiki(/.*)?$ %{DOCUMENT_ROOT}/index.php [L]
 *
 */
 
 $wgArticlePath = "/wiki/$1";
 
