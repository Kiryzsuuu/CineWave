#!/bin/bash

# Azure deployment script for Laravel
echo "Starting Laravel deployment..."

# Install Composer dependencies
echo "Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

# Copy environment file
echo "Setting up environment..."
cp .env.production .env

# Generate application key if not set
echo "Generating application key..."
php artisan key:generate --force

# Clear and cache config
echo "Optimizing Laravel..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set proper permissions
echo "Setting permissions..."
chmod -R 755 storage bootstrap/cache

echo "Deployment completed!"