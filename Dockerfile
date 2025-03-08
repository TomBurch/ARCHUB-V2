FROM php:8.2-fpm@sha256:606bb8f8c95bb7e4bdae9f4305260588ce676240a6b698b5aede8fa4edc3cf48 AS web

RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    default-mysql-client
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=ghcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions fileinfo exif pdo_mysql gd zip

COPY . /var/www/html
WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
USER www-data

# RUN php artisan key:generate
# RUN php artisan storage:link
# RUN php artisan migrate:install
# RUN php artisan migrate:refresh --seed
# RUN php artisan cache:clear
