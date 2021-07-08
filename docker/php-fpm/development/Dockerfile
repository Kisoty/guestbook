FROM php:8.0.1-fpm-alpine

RUN apk --no-cache add autoconf g++ make \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && rm -rf /tmp/pear; apk del autoconf g++ make \
    && apk add postgresql-dev \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install intl;

RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

RUN deluser www-data && adduser -DH -h /home/www-data -s /sbin/nologin -u 1000 www-data

COPY ./docker/php-fpm/development/conf.d /usr/local/etc/php/conf.d

WORKDIR /var/www
