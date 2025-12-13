# CineWave - Azure Deployment Guide

## Prerequisites
- Azure Account with active subscription
- Azure CLI installed
- Resource Group: WebOpet
- App Service created

## Deployment Steps

### 1. Login to Azure
```bash
az login
```

### 2. Set Azure Subscription
```bash
az account set --subscription "Your-Subscription-Name"
```

### 3. Create App Service (if not exists)
```bash
# Create App Service Plan (if needed)
az appservice plan create --name CineWavePlan --resource-group WebOpet --sku B1 --is-linux

# Create Web App
az webapp create --resource-group WebOpet --plan CineWavePlan --name CineWave --runtime "PHP:8.2"
```

### 4. Configure Deployment from GitHub
```bash
# Get GitHub repo URL
GITHUB_REPO="https://github.com/Kiryzsuuu/CineWave.git"

# Configure deployment source
az webapp deployment source config --name CineWave --resource-group WebOpet --repo-url $GITHUB_REPO --branch main --manual-integration
```

### 5. Configure App Settings (Environment Variables)
```bash
az webapp config appsettings set --name CineWave --resource-group WebOpet --settings \
  APP_NAME="CineWave" \
  APP_ENV="production" \
  APP_KEY="base64:YOUR_APP_KEY_HERE" \
  APP_DEBUG="false" \
  APP_URL="https://cinewave.azurewebsites.net" \
  DB_CONNECTION="mongodb" \
  DB_HOST="cnw.0gsh98f.mongodb.net" \
  DB_PORT="27017" \
  DB_DATABASE="cinewave" \
  DB_USERNAME="maskiryz23_db_user" \
  DB_PASSWORD="biSdlM7bJKVBA8QP" \
  MAIL_MAILER="smtp" \
  MAIL_HOST="smtp.gmail.com" \
  MAIL_PORT="587" \
  MAIL_USERNAME="maskiryz23@gmail.com" \
  MAIL_PASSWORD="your_app_password" \
  MAIL_ENCRYPTION="tls" \
  MAIL_FROM_ADDRESS="maskiryz23@gmail.com" \
  MAIL_FROM_NAME="CineWave" \
  SCM_DO_BUILD_DURING_DEPLOYMENT="true"
```

### 6. Enable MongoDB Extension
```bash
# Install PHP MongoDB extension (if needed)
az webapp config set --name CineWave --resource-group WebOpet --linux-fx-version "PHP|8.2"
```

### 7. Configure Startup Command
```bash
az webapp config set --name CineWave --resource-group WebOpet --startup-file "/home/site/wwwroot/deploy.sh"
```

### 8. Deploy from Local Git (Alternative)
```bash
# Get Git deployment URL
DEPLOY_URL=$(az webapp deployment source config-local-git --name CineWave --resource-group WebOpet --query url --output tsv)

# Add Azure remote
git remote add azure $DEPLOY_URL

# Push to Azure
git push azure main
```

## Manual Deployment via Azure Portal

### Option 1: GitHub Actions (Recommended)
1. Go to Azure Portal → App Services → CineWave
2. Click "Deployment Center"
3. Select "GitHub" as source
4. Authorize GitHub account
5. Select:
   - Organization: Kiryzsuuu
   - Repository: CineWave
   - Branch: main
6. Click "Save"

### Option 2: Local Git
1. Go to Azure Portal → App Services → CineWave
2. Click "Deployment Center"
3. Select "Local Git"
4. Get the Git URL
5. Add remote and push:
```bash
git remote add azure <AZURE_GIT_URL>
git push azure main
```

### Option 3: GitHub Direct Deploy
1. In Deployment Center, select "External Git"
2. Repository URL: https://github.com/Kiryzsuuu/CineWave.git
3. Branch: main
4. Click "Save"

## Environment Variables Setup

Go to: Configuration → Application Settings

Add these settings:
- `APP_NAME` = CineWave
- `APP_ENV` = production
- `APP_KEY` = (generate with `php artisan key:generate --show`)
- `APP_DEBUG` = false
- `APP_URL` = https://cinewave.azurewebsites.net
- `DB_CONNECTION` = mongodb
- `DB_HOST` = cnw.0gsh98f.mongodb.net
- `DB_DATABASE` = cinewave
- `DB_USERNAME` = maskiryz23_db_user
- `DB_PASSWORD` = biSdlM7bJKVBA8QP
- `MAIL_MAILER` = smtp
- `MAIL_HOST` = smtp.gmail.com
- `MAIL_PORT` = 587
- `MAIL_USERNAME` = maskiryz23@gmail.com
- `MAIL_PASSWORD` = (your Gmail app password)
- `MAIL_ENCRYPTION` = tls
- `SCM_DO_BUILD_DURING_DEPLOYMENT` = true
- `WEBSITE_DYNAMIC_CACHE` = 0

## Post-Deployment Tasks

### 1. Generate Application Key
```bash
az webapp ssh --name CineWave --resource-group WebOpet
cd /home/site/wwwroot
php artisan key:generate --force
```

### 2. Clear and Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Set Storage Permissions
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 4. Test MongoDB Connection
```bash
php artisan tinker
> DB::connection()->getMongoDB()->listCollections()
```

## Troubleshooting

### Check Logs
```bash
# Stream logs
az webapp log tail --name CineWave --resource-group WebOpet

# Download logs
az webapp log download --name CineWave --resource-group WebOpet --log-file logs.zip
```

### Common Issues

**Issue: 500 Error**
- Check storage permissions
- Verify APP_KEY is set
- Check logs: `storage/logs/laravel.log`

**Issue: MongoDB Connection Failed**
- Verify MongoDB Atlas IP whitelist (add 0.0.0.0/0 for Azure)
- Check DB credentials
- Test connection string

**Issue: Assets Not Loading**
- Run `npm run build` locally
- Commit `public/build` folder
- Verify APP_URL is correct

**Issue: Email Not Sending**
- Use Gmail App Password, not regular password
- Check MAIL settings
- Verify port 587 is open

## Custom Domain (Optional)

### Add Custom Domain
```bash
az webapp config hostname add --webapp-name CineWave --resource-group WebOpet --hostname www.yourdomain.com
```

### Configure SSL
```bash
az webapp config ssl bind --name CineWave --resource-group WebOpet --certificate-thumbprint <thumbprint> --ssl-type SNI
```

## Scaling

### Scale Up (Increase resources)
```bash
az appservice plan update --name CineWavePlan --resource-group WebOpet --sku P1V2
```

### Scale Out (Add instances)
```bash
az appservice plan update --name CineWavePlan --resource-group WebOpet --number-of-workers 2
```

## Monitoring

### Enable Application Insights
```bash
az monitor app-insights component create --app CineWave-insights --location eastus --resource-group WebOpet --application-type web
```

### View Metrics
- Go to Azure Portal → App Services → CineWave → Metrics
- Monitor: CPU, Memory, HTTP requests, Response time

## Backup

### Configure Backup
```bash
az webapp config backup create --resource-group WebOpet --webapp-name CineWave --backup-name backup1 --storage-account-url <url>
```

## Important Notes

1. **MongoDB Atlas**: Ensure IP 0.0.0.0/0 is whitelisted for Azure connections
2. **Session Driver**: Use 'database' or 'redis' instead of 'file' for multi-instance
3. **Queue Driver**: Configure queue driver (database/redis) for background jobs
4. **File Storage**: Use Azure Blob Storage for user uploads
5. **Cache**: Consider using Redis Cache for better performance

## Quick Deploy Commands

```bash
# One-line deploy
git add . && git commit -m "Deploy to Azure" && git push azure main

# Or push to GitHub (if using GitHub Actions)
git add . && git commit -m "Deploy to Azure" && git push origin main
```

## URLs

- **App URL**: https://cinewave.azurewebsites.net
- **Admin**: https://cinewave.azurewebsites.net/admin
- **API**: https://cinewave.azurewebsites.net/api

## Credentials

- **Admin Email**: maskiryz23@gmail.com
- **Admin Password**: admin123

---

**Deployment Date**: December 13, 2025
**Version**: 1.0.0
