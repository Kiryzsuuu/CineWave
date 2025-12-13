# Direct Deployment Script untuk CineWave
# Menggunakan ZIP Deploy untuk memastikan semua file ter-deploy

Write-Host "📦 Preparing deployment package..." -ForegroundColor Cyan

# Create deployment package (exclude unnecessary files)
$exclude = @('.git', 'node_modules', 'vendor', '.env', 'storage/logs/*', 'bootstrap/cache/*', 'tests', '.github')

# Create temp directory
$tempDir = "C:\Users\Rizky\AppData\Local\Temp\cinewave-deploy"
if (Test-Path $tempDir) {
    Remove-Item $tempDir -Recurse -Force
}
New-Item -ItemType Directory -Path $tempDir | Out-Null

Write-Host "  Copying files..." -ForegroundColor Gray
Copy-Item -Path ".\*" -Destination $tempDir -Recurse -Exclude $exclude

# Create .deployment file
@"
[config]
SCM_DO_BUILD_DURING_DEPLOYMENT=true
"@ | Out-File -FilePath "$tempDir\.deployment" -Encoding ASCII

# Create deployment script
@"
#!/bin/bash
php -r "file_exists('.env') || copy('.env.example', '.env');"
composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
php artisan key:generate --force || true
php artisan config:cache
php artisan route:cache
php artisan view:cache
"@ | Out-File -FilePath "$tempDir\deploy.sh" -Encoding ASCII

Write-Host "  Creating ZIP package..." -ForegroundColor Gray
$zipPath = "C:\Users\Rizky\AppData\Local\Temp\cinewave.zip"
if (Test-Path $zipPath) {
    Remove-Item $zipPath -Force
}

Compress-Archive -Path "$tempDir\*" -DestinationPath $zipPath

Write-Host "✅ Package created: $zipPath" -ForegroundColor Green

# Deploy using ZIP Deploy
Write-Host "`n🚀 Deploying to Azure..." -ForegroundColor Cyan
az webapp deploy --resource-group WebOpet --name CineWave --src-path $zipPath --type zip

Write-Host "`n⏳ Waiting for deployment to complete (60 seconds)..." -ForegroundColor Yellow
Start-Sleep -Seconds 60

# Restart app
Write-Host "`n🔄 Restarting application..." -ForegroundColor Cyan
az webapp restart --name CineWave --resource-group WebOpet

Write-Host "`n⏳ Waiting for app to start (20 seconds)..." -ForegroundColor Yellow
Start-Sleep -Seconds 20

# Test
Write-Host "`n🧪 Testing deployment..." -ForegroundColor Cyan
try {
    $response = Invoke-WebRequest -Uri "https://cinewave.azurewebsites.net" -UseBasicParsing
    Write-Host "✅ Status: $($response.StatusCode)" -ForegroundColor Green
    
    if ($response.Content -like "*CineWave*" -or $response.Content -like "*Laravel*") {
        Write-Host "🎉 SUCCESS! Laravel app is running!" -ForegroundColor Green
        Write-Host "`n🌐 Opening website..." -ForegroundColor Cyan
        start "https://cinewave.azurewebsites.net"
    } else {
        Write-Host "⚠️  Website responds but might not be Laravel yet" -ForegroundColor Yellow
        Write-Host "Check logs: az webapp log tail --name CineWave --resource-group WebOpet" -ForegroundColor Gray
    }
} catch {
    Write-Host "❌ Error testing website: $($_.Exception.Message)" -ForegroundColor Red
}

# Cleanup
Write-Host "`n🧹 Cleaning up..." -ForegroundColor Gray
Remove-Item $tempDir -Recurse -Force
Remove-Item $zipPath -Force

Write-Host "`n✅ Deployment complete!" -ForegroundColor Green
