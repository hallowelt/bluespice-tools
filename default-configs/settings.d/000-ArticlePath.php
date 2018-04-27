<?php

/*
 *
 * Make MediaWiki reachable via ShortUrl /wiki/
 * Documentation: https://www.mediawiki.org/wiki/Manual:Short_URL
 *
 * For apache integration please add the following rewrite rule to your vhosts:
 *
 * RewriteEngine On
 * RewriteRule ^/?wiki(/.*)?$ %{DOCUMENT_ROOT}/index.php [L]
 *
 * For IIS integration please add the following rewrite ruke to you web.config:
 *
 * <?xml version="1.0" encoding="UTF-8"?>
 * <configuration>
 *     <system.webServer>
 *         <rewrite>
 *             <rules>
 *                 <rule name="WikiShortURL">
 *                     <match url="^wiki/(.*)$" />
 *                     <action type="Rewrite" url="/index.php?title={UrlEncode:{R:1}}" />
 *                 </rule>
 *             </rules>
 *         </rewrite>
 *     </system.webServer>
 * </configuration>
 *
 */

$wgArticlePath = "/wiki/$1";
 
