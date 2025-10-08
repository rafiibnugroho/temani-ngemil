#!/bin/bash

# Pastikan composer dependencies terinstal
composer install --no-interaction --prefer-dist --optimize-autoloader

# Jalankan migrasi (opsional)
# php artisan migrate --force

# Jalankan Laravel
php artisan serve --host=0.0.0.0 --port=8080
