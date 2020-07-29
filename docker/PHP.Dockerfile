# ------------------------------------------------------------------------------------
#                                Production Dockerfile
# ------------------------------------------------------------------------------------
# @build-example docker-compose up -d
# ------------------------------------------------------------------------------------
FROM php:7.4-fpm-alpine

MAINTAINER Hampster <phper.blue@gmail.com>

# phpredis和xlswriter版本
ENV PHPREDIS_VERSION=5.2.2

# 更新镜像仓库
RUN echo http://mirrors.aliyun.com/alpine/v3.12/main>/etc/apk/repositories \
    && echo  http://mirrors.aliyun.com/alpine/v3.12/community>>/etc/apk/repositories

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

# Add gd library
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/

# 安装一些必备的扩展
RUN docker-php-ext-install gd bcmath pdo_mysql mysqli opcache intl pcntl sockets

# 安装composer
RUN wget https://mirrors.aliyun.com/composer/composer.phar -O /usr/local/bin/composer \
    && chmod a+x /usr/local/bin/composer \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer \
    && composer self-update --clean-backups \
# 安装redis扩展
    && wget http://pecl.php.net/get/redis-${PHPREDIS_VERSION}.tgz -O /tmp/redis.tar.tgz \
    && pecl install /tmp/redis.tar.tgz \
    && rm -rf /tmp/redis.tar.tgz \
    && docker-php-ext-enable redis

# 添加目录到Docker
ADD . /skeleton

COPY docker/uploads.ini /usr/local/etc/php/conf.d
COPY docker/fpm/php-fpm.conf /usr/local/etc/php-fpm.d/php-fpm.conf

# Enable Opcache
RUN { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=32'; \
        echo 'opcache.max_accelerated_files=10000'; \
        echo 'opcache.validate_timestamps=0'; \
        echo 'opcache.fast_shutdown=1'; \
    } > /usr/local/etc/php/conf.d/opcache.ini

WORKDIR /skeleton

# 计划任务
COPY crontab.root /var/spool/cron/crontabs/root
RUN chmod 0755 /var/spool/cron/crontabs/root
RUN crontab /var/spool/cron/crontabs/root

RUN composer install --optimize-autoloader -o --no-dev

# 赋予权限
RUN chown -R www-data:www-data storage public bootstrap

# 优化
RUN php artisan route:scan && php artisan route:cache && php artisan config:cache

CMD crond && php-fpm

EXPOSE 80