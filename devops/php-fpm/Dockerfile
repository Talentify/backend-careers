FROM php:7.4-fpm-alpine

RUN docker-php-ext-install  pdo_mysql

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
	--install-dir=/usr/local/bin --filename=composer
	
COPY ./backend /var/www/html/

RUN mkdir -p var/cache && chown -R www-data:www-data var
