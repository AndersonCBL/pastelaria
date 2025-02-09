FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev \
    && docker-php-ext-install pdo_mysql gd

WORKDIR /var/www/html

COPY . .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install
RUN chmod -R 777 storage bootstrap/cache

CMD php artisan serve --host=0.0.0.0
