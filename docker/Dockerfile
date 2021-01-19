FROM php:7.4-fpm-alpine3.10
MAINTAINER Pedro Lazari

ARG APP_STAGE

RUN apk update \
    && apk upgrade \
    && apk add \
    oniguruma \
    libpng \
    openssl-dev \
    libxml2-dev \
    libpng-dev \
    && rm -rf /var/cache/apk/*


RUN docker-php-ext-install \
        pdo_mysql \
        gd \
        posix \
        tokenizer \
        ctype \
        pcntl \
        opcache

RUN chmod -R 755 /usr/local/lib/php/extensions/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && mkdir -p /app

#RUN if [ "$APP_STAGE" = "dev" ]; then \
#    pecl install xdebug; \
##    && docker-php-ext-enable xdebug; \
# fi

RUN adduser -u 1000 www -D -s /bin/ash && \
    chown -R www:www /home/www && \
    chown -R www:www /app

COPY config/     /
WORKDIR /app

RUN mkdir -p /app/storage/logs \
    && chown -R www:www /app/storage \
    && chmod +x /docker-entrypoint.sh

EXPOSE 9000

CMD ["/docker-entrypoint.sh", "php-fpm -F -O"]
