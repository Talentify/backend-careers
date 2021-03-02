FROM php:7.4-apache

ENV ACCEPT_EULA=Y

#UPDATE
RUN apt-get update

#DEPENDENCIAS
RUN apt-get install -y  git libpq-dev libpng-dev zip unzip gnupg2 \
    zlib1g-dev libicu-dev g++ wget wkhtmltopdf libzip-dev

#EXTENSOES PHP
RUN docker-php-ext-install pdo pdo_mysql pgsql pdo_pgsql intl zip gd

## Utilizar outras versões ex: sqlsrv-3.5.0
## https://pecl.php.net/package/sqlsrv
RUN  pecl install xdebug \
    && docker-php-ext-enable xdebug


## NODEJS
RUN curl -sL https://deb.nodesource.com/setup_14.x -o nodesource_setup.sh && bash nodesource_setup.sh \ 
    && apt -y install nodejs \
    && npm install -g apidoc


# COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --filename=composer \
    && mv composer /usr/local/bin/composer

COPY . /var/www/html/

WORKDIR /var/www/html/

RUN composer install

RUN mkdir -p logs && chmod -R 777 ./logs
RUN mkdir -p tmp && chmod -R 777 ./tmp

RUN a2enmod rewrite && service apache2 restart

EXPOSE 80