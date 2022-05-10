#!/bin/sh
# $ chmod 755 hoge.sh

mkdir mysql
mkdir nginx
mkdir php

cd mysql
touch my.cnf

cd ..
cd nginx

touch Dockerfile
touch default.conf

cd ..
cd php

touch Dockerfile
touch php.ini
