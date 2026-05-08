#!/usr/bin/env bash

# Pre-deployment verification script for Render.com
# Run this locally before pushing to GitHub/GitLab

echo "=========================================="
echo "Pre-Deployment Verification for Render"
echo "=========================================="
echo ""

# Check if .env file exists
echo "✓ Checking .env file..."
if [ -f .env ]; then
    echo "  ✓ .env file found"
else
    echo "  ✗ .env file NOT found - copying from .env.example"
    cp .env.example .env
fi
echo ""

# Check if APP_KEY is set
echo "✓ Checking APP_KEY..."
if grep -q "APP_KEY=" .env && [ -n "$(grep 'APP_KEY=' .env | cut -d'=' -f2)" ]; then
    echo "  ✓ APP_KEY is set"
else
    echo "  ⚠ APP_KEY not set - generating..."
    php artisan key:generate
fi
echo ""

# Check if vendor directory exists
echo "✓ Checking PHP dependencies..."
if [ -d vendor ]; then
    echo "  ✓ vendor directory found"
else
    echo "  ⚠ Installing composer dependencies..."
    composer install
fi
echo ""

# Check if node_modules exists
echo "✓ Checking Node dependencies..."
if [ -d node_modules ]; then
    echo "  ✓ node_modules directory found"
else
    echo "  ⚠ Installing npm dependencies..."
    npm install
fi
echo ""

# Check if public/build exists (Vite build)
echo "✓ Checking Vite build..."
if [ -d public/build ]; then
    echo "  ✓ public/build directory found"
else
    echo "  ⚠ Building assets..."
    npm run build
fi
echo ""

# Check if migrations are ready
echo "✓ Checking database migrations..."
if [ -d database/migrations ] && [ "$(ls -A database/migrations)" ]; then
    echo "  ✓ Migrations found"
else
    echo "  ⚠ No migrations found"
fi
echo ""

# Check Git status
echo "✓ Checking Git status..."
if command -v git &> /dev/null; then
    if git rev-parse --git-dir > /dev/null 2>&1; then
        echo "  ✓ Git repository found"
        echo ""
        echo "Uncommitted changes:"
        git status --short
    else
        echo "  ⚠ Not a Git repository - initializing..."
        git init
    fi
else
    echo "  ✗ Git is not installed"
fi
echo ""

echo "=========================================="
echo "Pre-deployment verification complete!"
echo "=========================================="
echo ""
echo "Next steps:"
echo "1. Review the .env file and update with Render values"
echo "2. Commit all changes: git add . && git commit -m 'Prepare for Render deployment'"
echo "3. Push to main branch: git push origin main"
echo "4. Create a Web Service in Render.com connected to your repository"
echo ""
