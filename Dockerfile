FROM php:8.2-fpm-alpine

# Install Dockerize
ENV DOCKERIZE_VERSION=0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/v$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-v$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-v$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-v$DOCKERIZE_VERSION.tar.gz

# Install packages
RUN apk --no-cache add \
    php8 \
    php8-fpm \
    php8-opcache \
    php8-gd \
    php8-pdo_mysql \
    php8-pdo_pgsql \
    php8-pgsql \
    php8-pcntl \
    php8-exif \
    php8-intl \
    php8-openssl \
    php8-zip \
    php8-pecl-apcu \
    php8-pecl-redis \
    php8-common \
    php8-iconv \
    php8-json \
    php8-mbstring \
    php8-xml \
    php8-bcmath \
    php8-curl \
    php8-ctype \
    php8-dom \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    composer \
    nodejs \
    npm \
    && ln -s /usr/bin/php8 /usr/bin/php

WORKDIR /usr/src/app

RUN chown -R www-data:www-data .
