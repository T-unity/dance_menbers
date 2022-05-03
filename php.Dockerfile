# FROM php:8.1-fpm-bullseye AS base
FROM php:8.1-fpm-buster AS base

WORKDIR /data

# timezone environment
ENV TZ=UTC \
  # locale
  LANG=en_US.UTF-8 \
  LANGUAGE=en_US:en \
  LC_ALL=en_US.UTF-8 \
  # composer environment
  COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

# composerをマウント先へコピー
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# 必要なモジュールをDL
RUN apt-get update \
  && apt-get -y install --no-install-recommends \
    locales \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* \
  && locale-gen en_US.UTF-8 \
  && localedef -f UTF-8 -i en_US en_US.UTF-8 \
  && docker-php-ext-install \
    intl \
    pdo_mysql \
    zip \
    bcmath \
  && composer config -g process-timeout 3600 \
  && composer config -g repos.packagist composer https://packagist.org

# 本場ステージビルド
FROM base AS deploy

# php.iniとLaravelのコードをマウント先へコピー
COPY ./infra/docker/php/php.deploy.ini /usr/local/etc/php/php.ini
COPY ./src /data

# RUN composer install -q -n --no-ansi --no-dev --no-scripts --no-progress --prefer-dist \
#   && chmod -R 777 storage bootstrap/cache \
#   && php artisan optimize:clear \
#   && php artisan optimize

# composer installを実行するとvendorとcomposer.lockが追加される
RUN composer install -q -n --no-ansi --no-dev --no-scripts --no-progress --prefer-dist
RUN chmod -R 777 storage bootstrap/cache
