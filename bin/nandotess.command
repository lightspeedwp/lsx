#!/bin/bash

echo "* lsx *";
cd ~/Sites-LightSpeed/@git/lsx;

#gulp compile-css;
#gulp compile-js;
#gulp wordpress-lang;

rm -Rf ~/Sites-LightSpeed/@mamp/lsx2.mamp/wp-content/themes/lsx;
rsync -a \
	--exclude='.git' \
	--exclude='bin' \
	--exclude='node_modules' \
	--exclude='sass' \
	--exclude='.DS_Store' \
	--exclude='lsx.sublime-workspace' \
	--exclude='lsx.sublime-project' \
	--exclude='.gitignore' \
	--exclude='.travis.yml' \
	--exclude='codesniffer.ruleset.xml' \
	--exclude='changelog.txt' \
	--exclude='gulpfile.js' \
	--exclude='LICENSE' \
	--exclude='package.json' \
	--exclude='README.md' \
	--exclude='readme.txt' \
	~/Sites-LightSpeed/@git/lsx ~/Sites-LightSpeed/@mamp/lsx2.mamp/wp-content/themes;

exit;
