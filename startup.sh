#!/bin/bash

echo "Starting CineWave Laravel Application..."

# Navigate to app directory
cd /home/site/wwwroot

# Check if vendor exists, if not install dependencies
if [ ! -d "vendor" ]; then
    echo "Installing Composer dependencies..."
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install --no-dev --optimize-autoloader --ignore-platform-req=ext-mongodb
fi

# Set permissions
chmod -R 755 storage bootstrap/cache 2>/dev/null || true

# Clear all caches first
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Only cache config (NOT routes - causes 404 issues with nginx)
php artisan config:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# DO NOT cache routes - it breaks with Azure nginx proxy
# php artisan route:cache

echo "Laravel application started!"
