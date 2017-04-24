#!/bin/bash

echo "* lsx *";
cd ~/Sites-LightSpeed/@git/lsx;

gulp compile-css;
gulp compile-js;
gulp wordpress-lang;

exit;
