FROM php:8.2-apache

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y git zip unzip

RUN docker-php-ext-install session

COPY . /var/www/html

# Exécute composer install pour créer vendor/
RUN composer install --no-interaction --prefer-dist --optimize-autoloader