#!/usr/bin/env bash

# Exit on error
set -o errexit

echo "Installing npm dependencies..."
npm install

echo "Building assets with Vite..."
npm run build

echo "Installing composer dependencies..."
composer install --optimize-autoloader --no-dev

echo "Generating app key if not set..."
php artisan key:generate --force

echo "Running database migrations..."
php artisan migrate --force

echo "Caching configuration..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Build completed successfully!"
