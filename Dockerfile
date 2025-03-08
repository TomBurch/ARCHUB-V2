FROM php:8.2-apache@sha256:cf4e9a057109366a8cef1979bd16868f8c214ca762116bda8b1ca435096aa308 AS web

RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    default-mysql-client
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

COPY --from=ghcr.io/mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions fileinfo exif pdo_mysql gd zip

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY . /var/www/html
WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# RUN php artisan key:generate
# RUN php artisan storage:link
# RUN php artisan migrate:install
# RUN php artisan migrate:refresh --seed
# RUN php artisan cache:clear
# RUN php artisan serve
