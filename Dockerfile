FROM php:7.4-cli-alpine as buildenv

COPY --from=composer:1.9.1 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.json
COPY composer.lock composer.lock

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-reqs

RUN composer run-script post-autoload-dump

RUN php artisan route:cache && \
    php artisan view:clear

FROM php:7.4-fpm-alpine

RUN apk add icu-dev
RUN docker-php-ext-install -j$(nproc) bcmath intl opcache mysqli pdo_mysql

RUN apk add nginx supervisor

# php and php-fpm configuration
COPY .build/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY .build/docker.conf /usr/local/etc/php-fpm.d/docker.conf
COPY .build/php.ini-production /usr/local/etc/php/php.ini

# Nginx configuration
COPY .build/nginx.conf /etc/nginx/nginx.conf
COPY .build/talentify.conf /etc/nginx/conf.d/default.conf

# Supervisor configuration
COPY .build/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ARG ENV_FILE=.env.prd.example

WORKDIR /var/www
COPY --chown=www-data:www-data --from=buildenv /var/www .
COPY --chown=www-data:www-data $ENV_FILE .env

RUN chgrp -R www-data storage bootstrap/cache
RUN chmod -R ug+rwx storage bootstrap/cache

EXPOSE 80

ENTRYPOINT [ "supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf", "-n" ]

LABEL maintainer="dev.rafael.leme@gmail.com"
LABEL org.label-schema.schema-version="1.0"
LABEL org.label-schema.name=""
LABEL org.label-schema.vcs-url="https://github.com/rafaelleme/talentify"
LABEL org.label-schema.vendor=""
