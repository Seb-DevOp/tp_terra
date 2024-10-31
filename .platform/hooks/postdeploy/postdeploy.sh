#!/bin/bash

# Vérifier l'existence du répertoire /var/app/current et attendre s'il n'existe pas
while [ ! -d /var/app/current ]; do
  echo "Waiting for /var/app/current to be available..."
  sleep 60  # Attendre 5 secondes avant de vérifier à nouveau
done

echo "/var/app/current is now available. Proceeding with the script."

# 01 - Create necessary storage directories
echo "Creating necessary storage directories..."
sudo  mkdir -p /var/app/current/storage/framework/sessions || exit 1
sudo mkdir -p /var/app/current/storage/framework/views || exit 1
sudo mkdir -p /var/app/current/storage/framework/cache || exit 1
sudo mkdir -p /var/app/current/storage/logs || exit 1
sudo mkdir -p /var/app/current/storage/uploads/logo || exit 1
echo "Storage directories created."

# 02 - Set permissions on storage and cache directories
echo "Setting permissions on storage and cache directories..."
sudo chmod -R 777 /var/app/current/storage || exit 1
sudo chmod -R 777 /var/app/current/storage/framework/cache || exit 1
sudo chmod -R 777 /var/app/current/storage/framework/views || exit 1
sudo chmod -R 777 /var/app/current/storage/framework/sessions || exit 1
sudo chmod -R 777 /var/app/current/bootstrap/cache || exit 1
echo "Permissions set."

# 03 - Verify permissions and directories
echo "Verifying permissions and directories..."
ls -l /var/app/current/storage || exit 1
ls -l /var/app/current/bootstrap/cache || exit 1
echo "Verification completed."

# Supprimer le lien symbolique s'il existe déjà
echo "Removing existing storage link..."
sudo rm public/storage || exit 1

# Naviguer dans le répertoire de l'application
cd /var/app/current || exit 1

# Exécuter la commande artisan storage:link
echo "Running php artisan storage:link..."
php artisan storage:link || { echo 'Error executing storage:link'; exit 1; }

# Ajuster les permissions pour le répertoire storage
echo "Adjusting permissions..."
sudo chmod -R 777 /var/app/current/storage || exit 1
sudo chown -R apache:apache /var/app/current/storage || exit 1  # Remplace 'apache' par l'utilisateur approprié si nécessaire

echo "Postdeploy script finished successfully."