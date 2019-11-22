FROM php:7.2-fpm-alpine
RUN apk update && apk add --cache libpng m4 autoconf make gcc g++ git \
    freetype-dev libjpeg-turbo-dev libpng-dev libmcrypt-dev linux-headers \
    nginx supervisor curl libcurl gmp-dev libxslt-dev gettext-dev bzip2-dev

RUN docker-php-ext-configure gd --with-gd --with-jpeg-dir=/usr/include/ \
            --with-freetype-dir=/usr/include/ --with-png-dir=/usr/include/

RUN docker-php-ext-configure zip --with-zlib-dir=/usr \
        && docker-php-ext-configure wddx --enable-libxml

RUN docker-php-ext-install bcmath gd mysqli pdo_mysql calendar sysvmsg sysvsem \
    sysvshm mysql xsl shmop sockets bz2 exif gettext gmp mcrypt opcache pcntl zip wddx

RUN apk add --cache --update libmemcached-libs zlib zlib-dev libmemcached-dev cyrus-sasl-dev

RUN pecl install swoole-1.9.0 && echo "extension=swoole.so" > /usr/local/etc/php/conf.d/swoole.ini

ENV TZ=Asia/Shanghai
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

EXPOSE 80

WORKDIR /var/www/html/14k-lnmpa
USER nginx
RUN php composer.phar install --no-dev && php composer.phar dump-autoload -o
USER root
