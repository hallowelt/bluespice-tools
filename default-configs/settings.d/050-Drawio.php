<?php

/*
 *
 * Notice: This will only work at the moment for Linux with Apache!
 *
 * This includes Drawio as a local service for a Java application server (Tomcat/Jetty).
 *
 * First step:
 * You need to install the rendering service (webapp) from https://buildservice.bluespice.com/webservices/REL1_31/drawio.war at your application server
 *
 * Second step:
 * Configure a Reverse proxy in you vhost configuration in Apache with this two lines:
 *
 * ProxyPass        /drawio/ http://127.0.0.1:8080/drawio/
 * ProxyPassReverse /drawio/ http://127.0.0.1:8080/drawio/
 *
 * Third step:
 * Add this file to your settings.d folder
 *
 */

if ( wfIsWindows() ) {
        return;
}

$wgDrawioEditorBackendUrl = $wgServer . "/drawio";
