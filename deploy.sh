#!/bin/bash

# Azure deployment script for Laravel

echo "Starting CineWave deployment..."

# Navigate to project directory
cd /home/site/wwwroot

# Install Composer dependencies
echo "Installing Composer dependencies..."
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --quiet
php -r "unlink('composer-setup.php');"
php composer.phar install --no-dev --optimize-autoloader --no-interaction

# Install npm dependencies and build assets
echo "Installing npm dependencies..."
npm install --production
npm run build

# Set proper permissions
echo "Setting permissions..."
chmod -R 755 storage bootstrap/cache

# Clear and cache configuration
echo "Optimizing Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache configuration for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (optional, be careful in production)
# php artisan migrate --force

echo "Deployment completed successfully!"
