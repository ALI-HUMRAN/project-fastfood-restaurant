FROM php:8.2-fpm
RUN docker-php-ext-install mysqli pdo pdo_mysql
COPY . /var/www/html
WORKDIR /var/www/html

