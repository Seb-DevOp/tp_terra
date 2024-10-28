# Utiliser l'image PHP 8.2 avec FPM comme image de base
FROM php:8.2-fpm

# Installer les dépendances système et les extensions PHP
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    iputils-ping \
    netcat-openbsd && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Obtenir la dernière version de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers Composer et installer les dépendances
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress

# Copier les fichiers de l'application
COPY . .

# Installer Mailhog sendmail et configurer PHP pour l'utiliser
RUN curl -sSL https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64 -o mhsendmail && \
    chmod +x mhsendmail && \
    mv mhsendmail /usr/local/bin/mhsendmail && \
    echo "sendmail_path = /usr/local/bin/mhsendmail" > /usr/local/etc/php/conf.d/mailhog.ini

# Changer la propriété des fichiers de l'application
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Commande pour démarrer PHP-FPM
CMD ["php-fpm"]

# Pour attendre MySQL avant de lancer Artisan
COPY wait-for-it.sh /usr/local/bin/wait-for-it.sh
RUN chmod +x /usr/local/bin/wait-for-it.sh
