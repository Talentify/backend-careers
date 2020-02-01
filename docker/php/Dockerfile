FROM php:7.3-fpm

WORKDIR /opt/work_king

# Install extensions
RUN apt-get update && apt-get install -y \
        git \
        wget \
        zip \
        build-essential

# Install Docker PHP extensions
RUN docker-php-ext-install  pdo_mysql

# Install Docker X-Debug tools
RUN pecl install xdebug
COPY ./files/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"\
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer
