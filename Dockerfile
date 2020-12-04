FROM php:7.4-fpm

# DEFAULT WORKDIR
WORKDIR /www/

# UPDATE PACKAGES
RUN apt-get update && \
    apt-get install -y libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev

# PHP EXTENSION BCMATH
RUN docker-php-ext-install bcmath

# PHP EXTENSION MYSQLI
RUN docker-php-ext-install mysqli

# PHP EXTENSION OPCACHE
RUN docker-php-ext-install opcache

# PHP EXTENSION ZIP
RUN docker-php-ext-install zip

# PHP PDO_MYSQL
RUN docker-php-ext-install pdo_mysql

# PHP EXTENSION GD
RUN docker-php-ext-configure gd \
    && docker-php-ext-install gd

