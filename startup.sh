#!/bin/bash
set -e

echo "=== Starting CineWave Laravel Application ==="

cd /home/site/wwwroot

# Create necessary directories
echo "Creating directories..."
mkdir -p storage/framework/{sessions,views,cache,testing}
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Set permissions
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Copy custom nginx config if exists
if [ -f "/home/site/wwwroot/default.conf" ]; then
    echo "Applying custom nginx config..."
    cp /home/site/wwwroot/default.conf /etc/nginx/sites-available/default
    cp /home/site/wwwroot/default.conf /etc/nginx/sites-enabled/default
    nginx -t && nginx -s reload
fi

# Install dependencies if needed
if [ ! -d "/home/site/wwwroot/vendor" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-dev --optimize-autoloader --no-interaction
fi

# Clear all caches
echo "Clearing caches..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan cache:clear || true

# Re-cache for production
echo "Caching configuration..."
php artisan config:cache || true
php artisan route:cache || true

# Create storage link
echo "Creating storage link..."
php artisan storage:link || true

# Test database connection
echo "Testing database connection..."
php artisan tinker --execute="try { DB::connection()->getPdo(); echo 'DB Connected!'; } catch(\Exception \$e) { echo 'DB Error: ' . \$e->getMessage(); }" || echo "DB test skipped"

echo "=== CineWave is ready! ==="
echo "Application URL: https://cinewave.azurewebsites.net"

# Start PHP-FPM
php-fpm
