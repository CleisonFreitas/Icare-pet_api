#!/usr/bin/env bash

set -e

echo "🚀 Starting Laravel Sail installation..."

#######################################
# 1. Create .env if missing
#######################################
if [ ! -f .env ]; then
  cp .env.example .env
  echo "✅ .env created from .env.example"
fi

#######################################
# 2. Install Composer dependencies via Docker
#######################################
if [ ! -d vendor ]; then
  echo "📦 Installing Composer dependencies..."
  docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php85-composer:latest \
    composer install --ignore-platform-reqs
fi

#######################################
# 3. Install Sail (only once)
#######################################
if [ ! -f docker-compose.yml ]; then
  echo "🐳 Installing Laravel Sail..."
  php artisan sail:install --no-interaction
fi

#######################################
# 4. Helpers to manage env files
#######################################
set_env() {
  local key=$1
  local value=$2

  if grep -q "^${key}=" .env; then
    sed -i "s/^${key}=.*/${key}=${value}/" .env
  else
    echo "${key}=${value}" >> .env
  fi
}

set_env_file() {
  local file=$1
  local key=$2
  local value=$3

  if grep -q "^${key}=" "$file"; then
    sed -i "s/^${key}=.*/${key}=${value}/" "$file"
  else
    echo "${key}=${value}" >> "$file"
  fi
}

get_env() {
  grep -E "^$1=" .env | cut -d '=' -f2-
}

#######################################
# 5. Generate database credentials
#######################################
DB_USERNAME=$(openssl rand -hex 20)
DB_PASSWORD=$(openssl rand -hex 16)
DB_DATABASE="icare_db"
FORWARD_DB_PORT=3307

set_env "DB_USERNAME" "$DB_USERNAME"
set_env "DB_PASSWORD" "$DB_PASSWORD"
set_env "DB_DATABASE" "$DB_DATABASE"
set_env "FORWARD_DB_PORT" "$FORWARD_DB_PORT"

echo "🔐 Database credentials generated:"
echo "User: $DB_USERNAME"
echo "Password: $DB_PASSWORD"
echo "Database: $DB_DATABASE"

#######################################
# 6. Prepare .env.testing
#######################################
if [ ! -f .env.testing ]; then
  cp .env .env.testing
  echo "🧪 .env.testing created"
fi

APP_KEY=$(get_env "APP_KEY")

set_env_file ".env.testing" "APP_ENV" "testing"
set_env_file ".env.testing" "APP_KEY" "$APP_KEY"
set_env_file ".env.testing" "DB_USERNAME" "$DB_USERNAME"
set_env_file ".env.testing" "DB_PASSWORD" "$DB_PASSWORD"
set_env_file ".env.testing" "DB_DATABASE" "icare_db_testing"

#######################################
# 7. Build and start containers
#######################################
./vendor/bin/sail build
./vendor/bin/sail up -d

echo "⏳ Waiting for containers..."
sleep 8

#######################################
# 8. Laravel setup
#######################################
./vendor/bin/sail artisan key:generate --force
./vendor/bin/sail artisan migrate --seed

echo "✅ Installation completed successfully!"
echo "You can now access your application at http://localhost:8000"