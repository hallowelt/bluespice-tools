<?php

/*
 *
 * Disables check of certificate for LDAP connections.
 * To ensure that it works without problems create /etc/openldap/ldap.conf
 * (Windows: C:\OpenLDAP\ldap.conf OR C:\OpenLDAP\sysconf\ldap.conf - yust try it)
 * Content: "TLS_REQCERT never"
 *
 */

putenv( 'LDAPTLS_REQCERT=never' );
