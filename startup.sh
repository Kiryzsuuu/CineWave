#!/bin/bash

echo "Starting CineWave Laravel Application..."

cd /home/site/wwwroot

# Copy custom nginx config to override default
if [ -f "/home/site/wwwroot/default" ]; then
    echo "Copying custom nginx config..."
    cp /home/site/wwwroot/default /etc/nginx/sites-available/default
    cp /home/site/wwwroot/default /etc/nginx/sites-enabled/default
    nginx -t && nginx -s reload || true
fi

# Set permissions
chmod -R 755 storage bootstrap/cache 2>/dev/null || true
mkdir -p storage/framework/{sessions,views,cache} 2>/dev/null || true

# Clear caches
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true  
php artisan view:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Cache config and views only
php artisan config:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

echo "CineWave is ready!"

# Start PHP-FPM
php-fpm
