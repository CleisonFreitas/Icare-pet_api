#!/usr/bin/env bash

set -e

echo "🧪 Running test environment..."

#######################################
# 1. Ensure Sail is running
#######################################
if ! ./vendor/bin/sail ps >/dev/null 2>&1; then
  echo "🐳 Sail is not running. Starting containers..."
  ./vendor/bin/sail up -d
  sleep 5
fi

#######################################
# 2. Ensure testing env exists
#######################################
if [ ! -f .env.testing ]; then
  echo "❌ .env.testing not found. Run install.sh first."
  exit 1
fi

#######################################
# 3. Reset testing database
#######################################
echo "🧹 Resetting testing database..."
./vendor/bin/sail artisan migrate:fresh --env=testing

#######################################
# 4. Run tests
#######################################
echo "🚦 Running tests..."
./vendor/bin/sail artisan test --env=testing

echo "✅ Tests completed successfully!"
