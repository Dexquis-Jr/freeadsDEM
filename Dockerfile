
FROM php:8.5-apache

RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql mbstring zip

RUN a2enmod rewrite


WORKDIR /var/www/html

COPY . .


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Copier .env si nécessaire
RUN cp .env.example .env


RUN php artisan key:generate

ENV APACHE_DOCUMENT_ROOT /var/www/html/public


RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html


EXPOSE 8080
CMD ["apache2-foreground"]


