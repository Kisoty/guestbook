FROM php:8.0.1-cli-alpine AS builder

RUN apk add postgresql-dev \
    && apk add --no-cache rabbitmq-c-dev \
    && mkdir -p //usr/src/php/ext/amqp \
    && curl -fsSL https://pecl.php.net/get/amqp | tar xvz -C "/usr/src/php/ext/amqp" --strip 1 \
    && docker-php-ext-install pdo_pgsql amqp intl opcache;

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet

WORKDIR /var/www

COPY ./ ./

RUN composer install --no-dev --prefer-dist --no-progress --optimize-autoloader \
    && rm -rf /root/.composer/cache

FROM php:8.0.1-fpm-alpine

RUN apk add postgresql-dev \
    && apk add --no-cache rabbitmq-c-dev \
    && mkdir -p //usr/src/php/ext/amqp \
    && curl -fsSL https://pecl.php.net/get/amqp | tar xvz -C "/usr/src/php/ext/amqp" --strip 1 \
    && docker-php-ext-install pdo_pgsql amqp intl opcache;

RUN mv $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini

RUN deluser www-data && adduser -DH -h /home/www-data -s /sbin/nologin -u 1000 www-data

WORKDIR /var/www

COPY --from=builder /var/www ./

RUN chown -R www-data:www-data public
