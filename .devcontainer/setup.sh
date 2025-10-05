#!/bin/bash

# Laravel Mini Shop Lite - Codespaces Setup Script
echo "🚀 Setting up Mini Shop Lite in GitHub Codespaces..."

# Install PHP extensions and dependencies
sudo apt-get update
sudo apt-get install -y mysql-server mysql-client

# Start MySQL service
sudo service mysql start

# Set up MySQL database
sudo mysql -e "CREATE DATABASE minishop;"
sudo mysql -e "CREATE USER 'minishop'@'localhost' IDENTIFIED BY 'password';"
sudo mysql -e "GRANT ALL PRIVILEGES ON minishop.* TO 'minishop'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

# Install Composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Node.js dependencies
npm install

# Set up environment
cp .env.example .env
php artisan key:generate

# Configure database in .env
sed -i 's/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/' .env
sed -i 's/# DB_HOST=127.0.0.1/DB_HOST=127.0.0.1/' .env
sed -i 's/# DB_PORT=3306/DB_PORT=3306/' .env
sed -i 's/# DB_DATABASE=laravel/DB_DATABASE=minishop/' .env
sed -i 's/# DB_USERNAME=root/DB_USERNAME=minishop/' .env
sed -i 's/# DB_PASSWORD=/DB_PASSWORD=password/' .env

# Run migrations and seed database
php artisan migrate --force
php artisan db:seed --force

# Create storage symlink
php artisan storage:link

# Build assets
npm run build

# Set permissions
chmod -R 775 storage bootstrap/cache

echo "✅ Mini Shop Lite setup complete!"
echo "🌟 Run 'php artisan serve' to start the application"
echo "🔗 Demo Accounts:"
echo "   Admin: admin@demo.com / password"
echo "   Customer: customer@demo.com / password"
