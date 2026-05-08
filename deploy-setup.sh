#!/usr/bin/env bash

# Complete Deployment Setup Script for Render.com
# Run this script to prepare your application for deployment
# Usage: bash deploy-setup.sh

set -e

echo ""
echo "╔════════════════════════════════════════════════════════════════╗"
echo "║         NextGen Shop - Render.com Deployment Setup            ║"
echo "╚════════════════════════════════════════════════════════════════╝"
echo ""

# Color codes
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}▶${NC} $1"
}

print_success() {
    echo -e "${GREEN}✓${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

print_error() {
    echo -e "${RED}✗${NC} $1"
}

# Step 1: Check prerequisites
print_status "Checking prerequisites..."
echo ""

if ! command -v git &> /dev/null; then
    print_error "Git is not installed"
    exit 1
fi
print_success "Git installed"

if ! command -v php &> /dev/null; then
    print_error "PHP is not installed"
    exit 1
fi
print_success "PHP installed ($(php -v | head -n1))"

if ! command -v composer &> /dev/null; then
    print_error "Composer is not installed"
    exit 1
fi
print_success "Composer installed"

if ! command -v node &> /dev/null; then
    print_error "Node.js is not installed"
    exit 1
fi
print_success "Node.js installed ($(node -v))"

echo ""

# Step 2: Setup Laravel application
print_status "Setting up Laravel application..."
echo ""

# Copy .env file
if [ ! -f .env ]; then
    print_warning ".env file not found, copying from .env.example"
    cp .env.example .env
else
    print_success ".env file exists"
fi

# Generate APP_KEY if not set
if ! grep -q "APP_KEY=base64:" .env; then
    print_warning "APP_KEY not set, generating..."
    php artisan key:generate
    print_success "APP_KEY generated"
else
    print_success "APP_KEY already set"
fi

echo ""

# Step 3: Install dependencies
print_status "Installing dependencies..."
echo ""

if [ ! -d vendor ]; then
    print_warning "Installing Composer dependencies (this may take a few minutes)..."
    composer install
    print_success "Composer dependencies installed"
else
    print_success "Composer dependencies already installed"
fi

if [ ! -d node_modules ]; then
    print_warning "Installing NPM dependencies (this may take a few minutes)..."
    npm install
    print_success "NPM dependencies installed"
else
    print_success "NPM dependencies already installed"
fi

echo ""

# Step 4: Build assets
print_status "Building frontend assets..."
echo ""

print_warning "Building assets with Vite..."
npm run build
print_success "Assets built successfully"

echo ""

# Step 5: Cache configuration
print_status "Preparing application for deployment..."
echo ""

php artisan config:cache
print_success "Configuration cached"

php artisan route:cache
print_success "Routes cached"

echo ""

# Step 6: Git initialization
print_status "Preparing Git repository..."
echo ""

if ! git rev-parse --git-dir > /dev/null 2>&1; then
    print_warning "Initializing Git repository..."
    git init
fi
print_success "Git repository ready"

if ! git remote get-url origin > /dev/null 2>&1; then
    print_warning "No remote repository configured"
    read -p "Enter your GitHub/GitLab repository URL: " repo_url
    git remote add origin "$repo_url"
    print_success "Remote repository added"
else
    print_success "Remote repository already configured: $(git remote get-url origin)"
fi

echo ""

# Step 7: Show deployment information
print_status "Deployment Information"
echo ""

APP_KEY=$(grep "APP_KEY=" .env | cut -d'=' -f2)
print_success "APP_KEY is set: ${APP_KEY:0:20}..."

DB_HOST=$(grep "DB_HOST=" .env | cut -d'=' -f2)
print_warning "Database Host: $DB_HOST"
print_warning "Update this in Render dashboard before deployment"

echo ""

# Step 8: Show next steps
print_status "Next Steps:"
echo ""
echo "1. Update .env file with your production database credentials:"
echo "   nano .env"
echo ""
echo "2. Review RENDER_ENV_VARS.sh for all required environment variables"
echo ""
echo "3. Commit and push your code:"
echo "   git add ."
echo "   git commit -m 'Prepare for Render deployment'"
echo "   git push -u origin main"
echo ""
echo "4. In Render Dashboard:"
echo "   • Create a new Web Service"
echo "   • Connect your GitHub/GitLab repository"
echo "   • Set Build Command: bash build.sh"
echo "   • Set Start Command: vendor/bin/heroku-php-apache2 public/"
echo "   • Add all environment variables from RENDER_ENV_VARS.sh"
echo ""
echo "5. Deploy and monitor at https://dashboard.render.com"
echo ""
echo "6. After deployment, verify with:"
echo "   curl https://your-app.onrender.com/health-check.php"
echo ""

echo "╔════════════════════════════════════════════════════════════════╗"
echo "║                    Setup Complete! ✓                           ║"
echo "║                 Ready to Deploy to Render.com                  ║"
echo "╚════════════════════════════════════════════════════════════════╝"
echo ""
