FROM composer as composer

FROM php:7.4-fpm

ENV NODE_VERSION 12.13.0

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get install -y git bash wget curl gnupg libbz2-dev zlib1g-dev zip libzip-dev libpng-dev libicu-dev libtidy-dev libpq-dev jpegoptim optipng pngquant gifsicle
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo_mysql pdo_pgsql bz2 gd intl tidy tokenizer zip exif
RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install swoole && docker-php-ext-enable swoole

# Install Nodejs and Yarn
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get update && apt-get install -y gcc g++ make nodejs
RUN npm install yarn --global

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR "/app"
