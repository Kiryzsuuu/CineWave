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
chmod -R 755 storage bootstrap/cache

# Clear and cache config
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Copy custom nginx config
cp /home/site/wwwroot/nginx-default.conf /etc/nginx/sites-available/default 2>/dev/null || true

# Reload nginx
nginx -s reload 2>/dev/null || service nginx restart

# Start PHP-FPM
php-fpm
