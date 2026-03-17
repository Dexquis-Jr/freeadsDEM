# Dockerfile pour Laravel 11 sur Render avec Apache

# Utiliser PHP + Apache
FROM php:8.5-apache

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql zip

# Copier Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier tout le projet dans le container
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Copier le fichier .env
RUN cp .env.example .env

# Générer la clé d'application Laravel
RUN php artisan key:generate

# Changer la racine Apache vers public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Activer mod_rewrite pour Laravel
RUN a2enmod rewrite

# Permissions pour Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port Apache par défaut
EXPOSE 80

# Lancer Apache en premier plan
CMD ["apache2-foreground"]
