# RENDER.COM DEPLOYMENT GUIDE

This guide walks you through deploying your Laravel application to Render.com.

## Prerequisites

- GitHub or GitLab account with your code pushed
- Render.com account (free tier available)
- Application App Key generated (`php artisan key:generate`)

## Configuration Files

All necessary deployment files have been created:

- **build.sh** - Runs during build phase on Render
- **Procfile** - Tells Render how to start the application
- **render.yaml** - Infrastructure-as-code configuration (optional)
- **RENDER_ENV_VARS.sh** - Reference for environment variables to set
- **public/health-check.php** - Health check endpoint for verification

## Step 1: Push Code to Git

```bash
# Initialize git if not already done
git init

# Add all files
git add .

# Commit
git commit -m "Prepare for Render deployment"

# Add remote (replace with your repo)
git remote add origin https://github.com/yourusername/nextgen.git

# Push to main branch
git branch -M main
git push -u origin main
```

## Step 2: Create Render Web Service

1. Go to https://render.com and log in
2. Click "New +" → "Web Service"
3. Select your GitHub/GitLab repository
4. Choose the branch (main)
5. Fill in the configuration:
   - **Name:** nextgen-shop
   - **Environment:** Docker
   - **Build Command:** `bash build.sh`
   - **Start Command:** `vendor/bin/heroku-php-apache2 public/`

## Step 3: Set Environment Variables

In Render dashboard, go to Environment tab and add:

### Required Variables:
```
APP_NAME=NextGen Shop
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_URL=https://nextgen-xxxxx.onrender.com
LOG_LEVEL=error
CACHE_STORE=database
SESSION_DRIVER=cookie
QUEUE_CONNECTION=database
```

### Database Variables:
```
DB_CONNECTION=mysql
DB_HOST=your-database-host
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### Optional Mail Variables:
```
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=noreply@example.com
```

## Step 4: Generate APP_KEY Locally

```bash
php artisan key:generate --show
```

Copy the output (should start with "base64:") and paste as APP_KEY in Render environment.

## Step 5: Set Up Database

### Option A: Render's Managed Database
1. In Render dashboard, create a PostgreSQL or MySQL database
2. Copy connection details and set in environment variables

### Option B: External Database (AWS RDS, Planetscale, etc.)
1. Create database on your provider
2. Set connection details in Render environment

### Option C: SQLite (for simple projects)
```
DB_CONNECTION=sqlite
DB_DATABASE=/var/data/database.sqlite
```

## Step 6: Deploy

1. Make sure all code is committed and pushed
2. In Render dashboard, click "Deploy"
3. Monitor build logs for errors
4. Once deployed, your app will be available at the provided URL

## Step 7: Verify Deployment

1. Visit: `https://your-app.onrender.com/health-check.php`
2. This should return a JSON health check
3. Visit your main application URL
4. Test key features (login, shopping cart, etc.)

## Step 8: Run Post-Deployment Tasks

After successful deployment, you may need to:

```bash
# Via Render Shell (SSH into container):
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan cache:clear
php artisan config:cache
```

## Monitoring & Logs

1. Go to Render dashboard → Logs
2. View real-time application logs
3. Check error logs for issues
4. Monitor resource usage

## Troubleshooting

### Build Fails
- Check build.sh permissions
- Review build logs in Render dashboard
- Ensure all dependencies are specified in composer.json

### Database Connection Error
- Verify DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD
- Ensure database accepts connections from Render IP
- Check if database exists

### Application Errors
- Check `/var/data/logs/laravel.log` via Render Shell
- Review APP_DEBUG setting (should be false in production)
- Verify APP_KEY is properly set

### Static Assets Not Loading
- Run `php artisan storage:link` during build
- Check if `public/build` directory exists
- Verify FILESYSTEM_DISK setting

## Updating Your Application

After making changes to your app:

1. Commit changes: `git commit -m "Description of changes"`
2. Push to main: `git push origin main`
3. Render automatically deploys the new version
4. Check Render dashboard for build status

## Rollback

If deployment fails:

1. Go to Render dashboard
2. Click "Deployments" tab
3. Select previous working deployment
4. Click "Deploy"

## Custom Domain

To use a custom domain:

1. In Render dashboard → Settings
2. Add your custom domain
3. Update DNS records as shown in Render
4. Update APP_URL in environment variables

## Performance Tips

1. Enable caching: `CACHE_DRIVER=redis`
2. Use queue for long tasks: `QUEUE_CONNECTION=database`
3. Optimize database queries
4. Enable gzip compression in Apache config
5. Set up CDN for static assets

## Security Checklist

- [ ] APP_DEBUG=false in production
- [ ] APP_KEY is set and secured
- [ ] Database credentials are secure
- [ ] SSL/TLS is enabled (Render auto-provides)
- [ ] Environment variables are not exposed
- [ ] `.env` file is in `.gitignore`
- [ ] Log files don't contain sensitive data

## Support

- Render Documentation: https://render.com/docs
- Laravel Documentation: https://laravel.com/docs
- Contact Render Support: https://render.com/help

---

Generated for NextGen Laravel Application
Deployment Date: May 8, 2026
