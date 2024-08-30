FROM php:8-fpm-alpine

RUN mkdir -p /var/www/html

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install bcmath

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf"]