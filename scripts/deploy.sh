#!/bin/bash
echo "Deploying"
rsync -rl --progress \
  --exclude .git \
  --exclude theme/node_modules \
  --exclude theme/bower_components \
  --exclude wp-content/uploads \
  --exclude wp/wp-content \
  --exclude wp-config.php \
  --del \
  . haveoglandskab.dk@ssh.haveoglandskab.dk:www-test
