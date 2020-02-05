FROM php:7.2-apache
RUN apt-get install -y --no-install-recommends libjpeg-dev libpng-dev && \
    docker-php-ext-configure gd --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install gd; \
    \
    # Instala a extensão PHP "exif" => http://php.net/manual/pt_BR/intro.exif.php
    apt-get install -y --no-install-recommends libexif-dev && \
    docker-php-ext-install exif; \
    \
    # Instala as extensões PHP "mysqli pdo_mysql pgsql pdo_pgsql"
    apt-get install -y --no-install-recommends libpq-dev && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install mysqli pdo_mysql pgsql pdo_pgsql