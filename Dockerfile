FROM ubuntu:18.04

RUN apt-get update

#install nginx
RUN apt-get install nginx -y

#install php 7.3
RUN apt-get install software-properties-common -y
RUN add-apt-repository ppa:ondrej/php -y
RUN apt-get update
RUN apt-get install php7.3-fpm -y -q

RUN apt-get update

#install extensions php 7.3
RUN apt-get install -y \
    php7.3-fpm \
    php7.3-cli \
    php7.3-mysql \
    php7.3-gd \
    php7.3-xmlrpc \
    php7.3-mbstring \
    php7.3-mongodb \
    php7.3-SimpleXML \
    php7.3-soap \
    php7.3-zip \
    php7.3-intl \
    php7.3-xsl \
    php7.3-odbc \
    php7.3-curl \
    php7.3-intl

#install composer
RUN apt-get update
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

#define main work dir
WORKDIR /var/www/html

#tools install
RUN apt-get update
RUN apt-get install vim -y
RUN apt-get install make -y

#nginx config file
COPY ./nginxconf /etc/nginx/sites-available/default

#src
COPY ./src /var/www/html

RUN chmod 777 -R /var/www/html/storage

#install dependencies
RUN apt-get update
RUN composer install

RUN php artisan key:generate

EXPOSE 80 443

CMD /etc/init.d/cron start && /etc/init.d/php7.3-fpm start && nginx -g "daemon off;"

