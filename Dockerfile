FROM php:8.0.0RC5-fpm-alpine

LABEL NAME="PHP-FPM"
LABEL MAINTAINER="Hampster <phper.blue@gmail.com>"

# phpredis version
ENV PHPREDIS_VERSION=5.3.2

# use china repository
RUN echo http://mirrors.aliyun.com/alpine/v3.12/main > /etc/apk/repositories \
    && echo  http://mirrors.aliyun.com/alpine/v3.12/community >> /etc/apk/repositories

RUN apk add --no-cache oniguruma-dev \
    curl-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev freetype \
    libpng \
    libjpeg-turbo \
    freetype-dev \
    libpng-dev \
    jpeg-dev \
    libjpeg \
    libjpeg-turbo-dev \
    icu-dev \
    gcc \
    g++ \
    make \
    autoconf

# gd library
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/

# necessary extension
RUN docker-php-ext-install gd bcmath pdo_mysql mysqli opcache intl pcntl sockets

# composer
RUN wget https://mirrors.aliyun.com/composer/composer.phar -O /usr/local/bin/composer \
    && chmod a+x /usr/local/bin/composer \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer \
    && composer self-update --clean-backups
    
# redis extension
RUN wget http://pecl.php.net/get/redis-${PHPREDIS_VERSION}.tgz -O /tmp/redis.tar.tgz \
    && pecl install /tmp/redis.tar.tgz \
    && rm -rf /tmp/redis.tar.tgz \
    && docker-php-ext-enable redis

WORKDIR /tmp

CMD php -S 0.0.0.0:8000 -t public

EXPOSE 8000
