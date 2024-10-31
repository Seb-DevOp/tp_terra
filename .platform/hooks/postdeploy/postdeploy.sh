#!/bin/bash
echo "Postdeploy script"
cd /var/app/current
if [ ! -d "vendor" ]; then
    composer install --no-dev --prefer-dist --optimize-autoloader
fi

echo "Création des dossiers dans /var/current"
mkdir -p /var/app/current/storage/framework/sessions
mkdir -p /var/app/current/storage/framework/views
mkdir -p /var/app/current/storage/framework/cache
mkdir -p /var/app/current/storage/logs

echo "Changement des permissions des dossiers dans /var/current"
chmod -R 777 /var/app/current/storage 
chmod -R 777 /var/app/current/storage/framework
chmod -R 777 /var/app/current/storage/framework/sessions
chmod -R 777 /var/app/current/storage/framework/views
chmod -R 777 /var/app/current/storage/framework/cache
chmod -R 777 /var/app/current/storage/logs
chmod -R 777 /var/app/current/resources/lang/
chmod -R 777 /var/app/current/bootstrap/cache/

echo "Changement droit utilisateurs et groupes des dossiers dans /var/current"
chown -R root:root /var/app/current/storage


echo "Changement droit utilisateurs et groupes des dossiers dans /var/www/html"
chown -R root:root /var/www/html/storage

echo "Suppression du public/storage et création d'un lien symbolique"
cd /var/www/html/
rm -f public/storage && php artisan storage:link