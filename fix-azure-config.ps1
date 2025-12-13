# Fix Azure App Service Configuration
# Mengatasi masalah startup command yang salah

Write-Host "🔧 Fixing CineWave Azure Configuration..." -ForegroundColor Cyan

# 1. Set environment variables satu per satu
Write-Host "`n📝 Setting environment variables..." -ForegroundColor Yellow

$settings = @{
    "APP_NAME" = "CineWave"
    "APP_ENV" = "production"
    "APP_KEY" = "base64:NbzF3k5nZFhNh9LY2Hr4lYeN1XjyJsZ3idB+xLa7SDg="
    "APP_DEBUG" = "false"
    "APP_URL" = "https://cinewave.azurewebsites.net"
    "DB_CONNECTION" = "mongodb"
    "MONGODB_DSN" = "mongodb+srv://maskiryz23_db_user:biSdlM7bJKVBA8QP@cnw.0gsh98f.mongodb.net/cinewave?retryWrites=true&w=majority"
    "MONGODB_DATABASE" = "cinewave"
    "MAIL_MAILER" = "smtp"
    "MAIL_HOST" = "smtp.gmail.com"
    "MAIL_PORT" = "587"
    "MAIL_USERNAME" = "maskiryz23@gmail.com"
    "MAIL_PASSWORD" = "aeth lqgk huov pdsp"
    "MAIL_ENCRYPTION" = "tls"
    "MAIL_FROM_ADDRESS" = "maskiryz23@gmail.com"
    "MAIL_FROM_NAME" = "CineWave"
    "SESSION_DRIVER" = "file"
    "CACHE_DRIVER" = "file"
    "SCM_DO_BUILD_DURING_DEPLOYMENT" = "true"
    "ENABLE_ORYX_BUILD" = "true"
}

foreach ($key in $settings.Keys) {
    Write-Host "  Setting $key..." -ForegroundColor Gray
    az webapp config appsettings set `
        --name CineWave `
        --resource-group WebOpet `
        --settings "$key=$($settings[$key])" `
        --output none
}

Write-Host "✅ Environment variables set!" -ForegroundColor Green

# 2. Remove startup command (let Azure auto-detect Laravel)
Write-Host "`n🗑️  Removing incorrect startup command..." -ForegroundColor Yellow
az webapp config set `
    --name CineWave `
    --resource-group WebOpet `
    --startup-file "null" `
    --output none

Write-Host "✅ Startup command removed!" -ForegroundColor Green

# 3. Restart app
Write-Host "`n🔄 Restarting application..." -ForegroundColor Yellow
az webapp restart --name CineWave --resource-group WebOpet --output none
Write-Host "✅ Application restarted!" -ForegroundColor Green

Write-Host "`n⏳ Waiting for app to initialize (30 seconds)..." -ForegroundColor Cyan
Start-Sleep -Seconds 30

# 4. Test deployment
Write-Host "`n🧪 Testing deployment..." -ForegroundColor Cyan
try {
    $response = Invoke-WebRequest -Uri "https://cinewave.azurewebsites.net" -UseBasicParsing
    if ($response.StatusCode -eq 200) {
        Write-Host "✅ Website is UP! Status: $($response.StatusCode)" -ForegroundColor Green
        if ($response.Content -like "*CineWave*" -or $response.Content -like "*Laravel*") {
            Write-Host "✅ Laravel app detected!" -ForegroundColor Green
        } else {
            Write-Host "⚠️  Response received but content might not be correct" -ForegroundColor Yellow
        }
    }
} catch {
    Write-Host "❌ Error testing website: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host "`n🎉 Configuration fix complete!" -ForegroundColor Green
Write-Host "🌐 Open: https://cinewave.azurewebsites.net" -ForegroundColor Cyan
