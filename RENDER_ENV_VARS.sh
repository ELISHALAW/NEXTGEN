#!/bin/bash
# Environment variables to configure in Render Dashboard
# Copy these variable names and set their values in Render environment

APP_NAME="NextGen Shop"
APP_ENV="production"
APP_DEBUG="false"
APP_URL="https://YOUR_RENDER_URL.onrender.com"

APP_LOCALE="en"
APP_FALLBACK_LOCALE="en"
APP_FAKER_LOCALE="en_US"

BCRYPT_ROUNDS="12"

LOG_CHANNEL="stack"
LOG_STACK="single"
LOG_DEPRECATIONS_CHANNEL="null"
LOG_LEVEL="error"

# Database Configuration - UPDATE WITH YOUR DATABASE DETAILS
DB_CONNECTION="mysql"
DB_HOST="YOUR_DB_HOST"
DB_PORT="3306"
DB_DATABASE="YOUR_DB_NAME"
DB_USERNAME="YOUR_DB_USER"
DB_PASSWORD="YOUR_DB_PASSWORD"

SESSION_DRIVER="cookie"
SESSION_LIFETIME="120"
SESSION_ENCRYPT="false"
SESSION_PATH="/"

BROADCAST_CONNECTION="log"
FILESYSTEM_DISK="local"
QUEUE_CONNECTION="database"

CACHE_STORE="database"
MEMCACHED_HOST="127.0.0.1"

REDIS_CLIENT="phpredis"
REDIS_HOST="127.0.0.1"
REDIS_PASSWORD="null"
REDIS_PORT="6379"

# Mail Configuration
MAIL_MAILER="smtp"
MAIL_SCHEME="tls"
MAIL_HOST="YOUR_MAIL_HOST"
MAIL_PORT="587"
MAIL_USERNAME="YOUR_MAIL_USERNAME"
MAIL_PASSWORD="YOUR_MAIL_PASSWORD"
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="NextGen Shop"

# AWS Configuration (optional)
AWS_ACCESS_KEY_ID=""
AWS_SECRET_ACCESS_KEY=""
AWS_DEFAULT_REGION="us-east-1"
AWS_BUCKET=""
AWS_USE_PATH_STYLE_ENDPOINT="false"

VITE_APP_NAME="NextGen Shop"

# Note: Generate APP_KEY locally using: php artisan key:generate --show
# Then copy the value (base64:...) and paste it in Render dashboard as APP_KEY
