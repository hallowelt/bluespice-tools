#!/bin/bash

cd extensions
git clone https://gerrit.wikimedia.org/r/mediawiki/extensions/BlueSpiceFoundation BlueSpiceFoundation
git clone gitolite@git.hallowiki.biz:mediawiki/extensions/BlueSpiceDistribution BlueSpiceDistribution
git clone https://gerrit.wikimedia.org/r/mediawiki/extensions/BlueSpiceExtensions BlueSpiceExtensions
cd ../
cd skins
git clone https://gerrit.wikimedia.org/r/mediawiki/skins/BlueSpiceSkin BlueSpiceSkin
cd ../

echo gg