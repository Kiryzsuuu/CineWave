# CineWave Clean Deployment Script
# This script creates a clean deployment package and deploys to Azure

Write-Host "===== CineWave Clean Deployment =====" -ForegroundColor Cyan

# Step 1: Create clean deployment directory
Write-Host "`n[1/5] Creating clean deployment directory..." -ForegroundColor Yellow
$deployDir = ".\deploy-temp"
if (Test-Path $deployDir) {
    Remove-Item $deployDir -Recurse -Force
}
New-Item -ItemType Directory -Path $deployDir | Out-Null

# Step 2: Copy application files (exclude vendor, node_modules, etc.)
Write-Host "[2/5] Copying application files..." -ForegroundColor Yellow
$exclude = @('vendor', 'node_modules', '.git', 'deploy-temp', '*.zip', 'log.zip', 'storage/logs/*')
$items = Get-ChildItem -Path . -Exclude $exclude

foreach ($item in $items) {
    if ($item.Name -notin $exclude) {
        Copy-Item -Path $item.FullName -Destination $deployDir -Recurse -Force
    }
}

# Step 3: Create .deployment file for Azure
Write-Host "[3/5] Creating deployment configuration..." -ForegroundColor Yellow
@"
[config]
SCM_DO_BUILD_DURING_DEPLOYMENT = true
"@ | Out-File -FilePath "$deployDir\.deployment" -Encoding ASCII

# Step 4: Create deployment zip
Write-Host "[4/5] Creating deployment package..." -ForegroundColor Yellow
$zipPath = ".\cinewave-deploy.zip"
if (Test-Path $zipPath) {
    Remove-Item $zipPath -Force
}

Compress-Archive -Path "$deployDir\*" -DestinationPath $zipPath -Force

# Step 5: Deploy to Azure
Write-Host "[5/5] Deploying to Azure App Service..." -ForegroundColor Yellow
az webapp deploy --resource-group WebOpet --name CineWave --src-path $zipPath --type zip --async true

# Cleanup
Write-Host "`nCleaning up temporary files..." -ForegroundColor Yellow
Remove-Item $deployDir -Recurse -Force

Write-Host "`n===== Deployment Complete =====" -ForegroundColor Green
Write-Host "The application is being deployed. This may take a few minutes." -ForegroundColor Cyan
Write-Host "`nIMPORTANT: You must set the following App Settings in Azure Portal:" -ForegroundColor Red
Write-Host "1. Go to: https://portal.azure.com"
Write-Host "2. Navigate to: CineWave App Service > Configuration > Application settings"
Write-Host "3. Add these settings:"
Write-Host "   - MONGODB_DSN = [Get from Azure: az cosmosdb keys list --resource-group WebOpet --name cinewave-db --type connection-strings]" -ForegroundColor Yellow
Write-Host "   - DB_CONNECTION = mongodb" -ForegroundColor Yellow
Write-Host "   - MONGODB_DATABASE = cinewave" -ForegroundColor Yellow
Write-Host "   - APP_ENV = production" -ForegroundColor Yellow
Write-Host "   - APP_DEBUG = false" -ForegroundColor Yellow
Write-Host "   - APP_KEY = base64:NbzF3k5nZFhNh9LY2Hr4lYeN1XjyJsZ3idB+xLa7SDg=" -ForegroundColor Yellow
Write-Host "4. Click 'Save' and wait for the app to restart"
Write-Host "`nAfter settings are saved, monitor deployment with:"
Write-Host "   az webapp log tail --resource-group WebOpet --name CineWave"
