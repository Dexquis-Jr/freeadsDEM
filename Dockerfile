
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


RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080
CMD ["apache2-foreground"]
