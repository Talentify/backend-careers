FROM php:7.4-fpm-alpine

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install tokenizer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV MEMCACHED_DEPS zlib-dev libmemcached-dev cyrus-sasl-dev
RUN apk add --no-cache --update libmemcached-libs zlib
RUN set -xe \
    && apk add --no-cache --update --virtual .phpize-deps $PHPIZE_DEPS \
    && apk add --no-cache --update --virtual .memcached-deps $MEMCACHED_DEPS \
    && pecl install memcached \
    && echo "extension=memcached.so" > /usr/local/etc/php/conf.d/20_memcached.ini \
    && rm -rf /usr/share/php7 \
    && rm -rf /tmp/* \
    && apk del .memcached-deps .phpize-deps
