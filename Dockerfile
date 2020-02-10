FROM ubuntu:18.04
MAINTAINER Thiago Carnaes <thiago.carnaes@ftd.com.br>

RUN apt-get update --fix-missing 
RUN DEBIAN_FRONTEND=noninteractive apt-get install software-properties-common -y --fix-missing

#add repository php7.3
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php -y

RUN apt-get update --fix-missing && \
    DEBIAN_FRONTEND=noninteractive apt-get -y install --fix-missing
RUN DEBIAN_FRONTEND=noninteractive apt-get -y install apache2 php7.3 php7.3-cli libapache2-mod-php7.3 php-xdebug php7.3-mbstring php7.3-mysql php7.3-common php7.3-dev php7.3-gd php7.3-json php7.3-curl php7.3-intl php7.3-bcmath php7.3-soap php7.3-dom php7.3-ldap php7.3-imagick curl php-pear php7.3-xmlrpc php7.3-sqlite3 --fix-missing
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y git tzdata vim unzip zip mlocate net-tools --fix-missing
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y sqlite3 --fix-missing
RUN DEBIAN_FRONTEND=noninteractive a2enmod rewrite
RUN DEBIAN_FRONTEND=noninteractive curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    chmod +x /usr/local/bin/composer && \
    apt-get clean

# Set the time zone
RUN echo "America/Sao_Paulo" > /etc/timezone 
RUN dpkg-reconfigure -f noninteractive tzdata
RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /etc/php/7.3/apache2/php.ini
RUN sed -i "s/display_errors = Off/display_errors = On/" /etc/php/7.3/apache2/php.ini
RUN sed -i "s/error_reporting = *$/error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT/" /etc/php/7.3/apache2/php.ini
RUN sed -i "s/max_execution_time = 30/max_execution_time = 120/" /etc/php/7.3/apache2/php.ini
RUN sed -i "s/upload_max_filesize = 2M/upload_max_filesize = 20M/" /etc/php/7.3/apache2/php.ini

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/run/
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV APACHE_LOG_DIR /var/log/apache2


COPY . /var/www/html

RUN chown www-data:www-data -R /var/www/html

WORKDIR /var/www/html

RUN echo  '    StrictHostKeyChecking no' >> /etc/ssh/ssh_config

ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf

EXPOSE 80
EXPOSE 3306
CMD ["/usr/sbin/apache2", "-D", "FOREGROUND"]
