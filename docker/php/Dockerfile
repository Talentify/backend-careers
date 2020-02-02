FROM php:7.4-fpm

WORKDIR /opt/work_king

# Install Docker PHP extensions
RUN docker-php-ext-install  pdo_mysql

# Install Docker X-Debug tools
RUN pecl install xdebug

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"\
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

COPY ./files/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
