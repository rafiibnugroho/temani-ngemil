#!/bin/bash
echo "🚀 Starting Temani Ngemil Laravel App on Railway..."

# Jalankan perintah Laravel penting
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan server Laravel di port Railway (gunakan $PORT otomatis)
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
