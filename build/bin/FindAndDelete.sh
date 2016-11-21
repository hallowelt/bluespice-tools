#!/bin/sh
find $1 -iname '.git*' -exec rm -rf {} \;
find $1 -iname '*.war' -exec rm -rf {} \;
find $1 -iname 'solr' -exec rm -rf {} \;