FROM composer:latest AS composer
FROM php:7.4-cli

USER root
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY docker/php/bin/ /usr/bin/
COPY docker/php/usr/local/etc/php/conf.d/*.ini /usr/local/etc/php/conf.d/
RUN apt-get update \
    && apt-get install -y \
        unzip \
        git
RUN pecl install \
        xdebug
RUN docker-php-ext-enable \
        xdebug
WORKDIR /aironou