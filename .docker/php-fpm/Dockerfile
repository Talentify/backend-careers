#FROM surnet/alpine-wkhtmltopdf:3.9-0.12.5-small as wkhtmltopdf
FROM php:7.4.2-fpm-alpine3.10

RUN apk add --no-cache openssl bash mysql-client nodejs npm

# Install GD Dependencies
RUN apk add --no-cache freetype-dev libpng-dev libjpeg-turbo-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Install php extensions
RUN docker-php-ext-install -j "$(getconf _NPROCESSORS_ONLN)" pdo pdo_mysql opcache exif gd

# Install phpredis
RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS && pecl install redis && docker-php-ext-enable redis

## Install dependencies for wkhtmltopdf and copy
#RUN apk add --no-cache libstdc++ libx11 libxrender libxext libssl1.1 ca-certificates fontconfig freetype ttf-dejavu ttf-droid ttf-freefont ttf-liberation ttf-ubuntu-font-family
#RUN apk add --no-cache --virtual .build-deps msttcorefonts-installer && update-ms-fonts && fc-cache -f && rm -rf /tmp/* && apk del .build-deps
#COPY --from=wkhtmltopdf /bin/wkhtmltopdf /bin/wkhtmltopdf

# Install Dockerize
ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy Php.ini
COPY config/php.ini-production $PHP_INI_DIR/php.ini

# Copy opcache config
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"
COPY config/opcache.ini $PHP_INI_DIR/conf.d/

WORKDIR /var/www
RUN rm -rf /var/www/html

RUN ln -s public html

EXPOSE 9000
ENTRYPOINT ["php-fpm"]

