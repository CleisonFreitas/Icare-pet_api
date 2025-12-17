#!/usr/bin/env bash

set -e

echo "🚀 Starting Laravel Sail setup..."

# Copy .env if it does not exist
if [ ! -f .env ]; then
  cp .env.example .env
  echo ".env file created from .env.example"
fi

# Install Composer dependencies using Docker
if [ ! -d vendor ]; then
  echo "📦 Installing Composer dependencies..."
  docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
fi

php artisan sail:install --no-interaction

# Generate random user and password
DB_USERNAME=$(openssl rand -hex 20)
DB_PASSWORD=$(openssl rand -hex 16)
DB_DATABASE="icare_db"
DB_PORT=3307

# Helper function to set or update env variables
set_env() {
  local key=$1
  local value=$2

  if grep -q "^${key}=" .env; then
    sed -i "s/^${key}=.*/${key}=${value}/" .env
  else
    echo "${key}=${value}" >> .env
  fi
}

# Store credentials in .env
set_env DB_USERNAME "$DB_USERNAME"
set_env DB_PASSWORD "$DB_PASSWORD"
set_env DB_DATABASE "$DB_DATABASE"
set_env FORWARD_DB_PORT "$DB_PORT"

echo "🔐 Credentials generated"
echo "User (plain): $DB_USERNAME"
echo "Password (plain): $DB_PASSWORD"
echo "Database: $DB_DATABASE"

# Build and start Sail
./vendor/bin/sail build
./vendor/bin/sail up -d

# Wait a bit for containers
sleep 5

# Run migrations and seeders
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed

echo "✅ Installation completed successfully!"
