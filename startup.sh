#!/bin/bash
echo "🚀 Starting Laravel app on Railway..."
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan serve --host=0.0.0.0 --port=8080
