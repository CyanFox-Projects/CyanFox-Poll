FROM php:8.2-fpm-alpine

# Install Dockerize
ENV DOCKERIZE_VERSION=0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/v$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-v$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-v$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-v$DOCKERIZE_VERSION.tar.gz

# Install packages
RUN apk --no-cache add \
    php \
    php-fpm \
    php-opcache \
    php-gd \
    php-pdo_mysql \
    php-pdo_pgsql \
    php-pgsql \
    php-pcntl \
    php-exif \
    php-intl \
    php-openssl \
    php-pecl-apcu \
    php-pecl-redis \
    php-common \
    php-iconv \
    php-json \
    php-mbstring \
    php-xml \
    php-bcmath \
    php-curl \
    php-ctype \
    php-dom \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    composer \
    nodejs \
    npm \
    nginx

# Copy Nginx conf
COPY docker/nginx.conf /etc/nginx/nginx.conf

WORKDIR /usr/src/app

RUN chown -R www-data:www-data .

CMD ["sh", "-c", "php-fpm -D; nginx -g 'daemon off;'"]
