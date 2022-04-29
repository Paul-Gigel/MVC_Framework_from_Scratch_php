FROM php:8.0.2-fpm

RUN apt-get update && apt-get install -y \
    git     \
    curl    \
    zip     \
    unzip   \
    nano
RUN set -ex \
    docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo pdo_mysql
#RUN mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
WORKDIR /var/www
