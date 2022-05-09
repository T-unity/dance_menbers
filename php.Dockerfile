#-----------------------
# ・ECSへデプロイする用のLaravelイメージ
# ・ビルドの際、開発環境ではdocker-composeでコンテキストを指定していたが、ECRへpushする都合上単体でビルドしたいため、ルートディレクトリに設置している。
# https://qiita.com/carimatics/items/01663d32bf9983cfbcfe
#-----------------------

# ビルドコマンド
# docker build -f ./php.Dockerfile . -t dancers/laravel

# ベースイメージを指定
# FROM php:8.1-fpm-bullseye AS base
FROM php:8.1-fpm-buster AS base

# /dataで作業を行う。この/dataは、ホストマシン側ではなくDockerホストの中に作成されるディレクトリ
# https://docs.docker.jp/engine/reference/builder.html#workdir
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

# リモートから取得するcomposerをDockerホストへコピー
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Laravelのサーバー要件を満たすために必要なモジュールをインストール。
# https://readouble.com/laravel/8.x/ja/deployment.html
# 当然/dataで実行される
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

# デプロイステージをビルド
# マルチステージビルドについて
# https://matsuand.github.io/docs.docker.jp.onthefly/develop/develop-images/multistage-build/
# https://qiita.com/polarbear08/items/e6855fc8caea1b03d54f
FROM base AS deploy

# php.iniとLaravelのコードをDockerホストへコピー
COPY ./infra/docker/php/php.deploy.ini /usr/local/etc/php/php.ini
COPY ./src /data

# composer installの実行によってvendorとcomposer.lockが追加される
RUN composer install -q -n --no-ansi --no-dev --no-scripts --no-progress --prefer-dist \
  && chmod -R 777 storage bootstrap/cache
