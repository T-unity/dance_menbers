# normal-laravel

## build

```
$ git clone git@github.com:T-unity/laravel-template.git
$ cd laravel-template
$ docker compose up -d --build
$ docker compose exec app bash

and execute...

[app container] $ bash initialize.sh
[app container] $ rm initialize.sh

or

[app container] $ composer install
[app container] $ cp .env.example .env
[app container] $ php artisan key:generate
[app container] $ php artisan storage:link
[app container] $ chmod -R 777 storage bootstrap/cache
[app container] $ php artisan migrate
```

## use node.js

change base/php/Dockerfile snd rebuildz

```
FROM php:8.0-fpm-buster
SHELL ["/bin/bash", "-oeux", "pipefail", "-c"]

ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
  apt-get -y install git unzip libzip-dev libicu-dev libonig-dev && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-install intl pdo_mysql zip bcmath

# Node.js
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

COPY ./php.ini /usr/local/etc/php/php.ini

WORKDIR /work
```

## VCS

```
git remote set-url origin (your_repo's_url)
e.g: git remote set-url origin git@github.com:T-unity/laravel-prod.git
(Use ssh instead of http)

or

git add .
git commit -m 'init'
git push (your_repo's_url) master
```

## special thanks

https://qiita.com/ucan-lab/items/56c9dc3cf2e6762672f4
https://github.com/ucan-lab/docker-laravel-handson
