#!/bin/bash

echo "=== Starting CineWave Laravel Application ==="

cd /home/site/wwwroot

# Create necessary directories
echo "Creating directories..."
mkdir -p storage/framework/{sessions,views,cache,testing} 2>/dev/null || true
mkdir -p storage/logs 2>/dev/null || true
mkdir -p bootstrap/cache 2>/dev/null || true

# Set permissions
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache 2>/dev/null || true
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# Copy custom nginx config
if [ -f "/home/site/wwwroot/default.conf" ]; then
    echo "Applying custom nginx config..."
    cp /home/site/wwwroot/default.conf /etc/nginx/sites-available/default 2>/dev/null || true
    cp /home/site/wwwroot/default.conf /etc/nginx/sites-enabled/default 2>/dev/null || true
    nginx -t && nginx -s reload 2>/dev/null || true
fi

# Check if composer installed dependencies
if [ ! -d "/home/site/wwwroot/vendor" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-dev --optimize-autoloader --no-interaction 2>/dev/null || true
fi

# Clear all Laravel caches first
echo "Clearing Laravel caches..."
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Re-cache for production
echo "Caching Laravel configuration..."
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

# Storage link
echo "Creating storage link..."
php artisan storage:link 2>/dev/null || true

echo "=== CineWave is ready! ==="

# Start PHP-FPM
php-fpm
