#!/usr/bin/env pwsh
# Azure Deployment Script - Complete Clean Deploy for CineWave

param(
    [string]$ResourceGroup = "CineWave_group",
    [string]$AppName = "cinewave",
    [string]$CosmosAccountName = "cinewave-db",
    [string]$DatabaseName = "cinewave"
)

$ErrorActionPreference = "Stop"

Write-Host "=== CineWave Azure Clean Deployment ===" -ForegroundColor Cyan

# Step 1: Get Cosmos DB connection string
Write-Host "`n[1/7] Getting Cosmos DB connection string..." -ForegroundColor Yellow
try {
    $cosmosKeys = az cosmosdb keys list --resource-group $ResourceGroup --name $CosmosAccountName --type connection-strings --query "connectionStrings[?description=='Primary MongoDB Connection String'].connectionString" -o tsv
    
    if (-not $cosmosKeys) {
        Write-Host "ERROR: Could not retrieve Cosmos DB connection string!" -ForegroundColor Red
        Write-Host "Please run: az cosmosdb keys list --resource-group $ResourceGroup --name $CosmosAccountName --type connection-strings" -ForegroundColor Yellow
        exit 1
    }
    
    # Parse and reconstruct connection string with proper parameters
    if ($cosmosKeys -match "mongodb://([^:]+):([^@]+)@([^/]+)/") {
        $username = $matches[1]
        $password = $matches[2]
        $host = $matches[3]
        
        $mongoDBDSN = "mongodb://${username}:${password}@${host}/?ssl=true&retrywrites=false&replicaSet=globaldb&maxIdleTimeMS=120000&appName=@${CosmosAccountName}@"
        Write-Host "✓ Cosmos DB connection string configured" -ForegroundColor Green
    } else {
        Write-Host "ERROR: Could not parse connection string!" -ForegroundColor Red
        exit 1
    }
} catch {
    Write-Host "ERROR: Failed to get Cosmos DB keys: $_" -ForegroundColor Red
    exit 1
}

# Step 2: Clear Laravel caches locally
Write-Host "`n[2/7] Clearing Laravel caches locally..." -ForegroundColor Yellow
try {
    php artisan config:clear 2>$null
    php artisan route:clear 2>$null
    php artisan view:clear 2>$null
    php artisan cache:clear 2>$null
    Write-Host "✓ Laravel caches cleared" -ForegroundColor Green
} catch {
    Write-Host "Warning: Could not clear some caches (may be normal)" -ForegroundColor Yellow
}

# Step 3: Create deployment package
Write-Host "`n[3/7] Creating deployment package..." -ForegroundColor Yellow

# Remove old package if exists
if (Test-Path "cinewave-deploy.zip") {
    Remove-Item "cinewave-deploy.zip" -Force
}

# Create list of files to exclude
$excludePatterns = @(
    "node_modules/*",
    ".git/*",
    "tests/*",
    "storage/logs/*",
    "storage/framework/cache/*",
    "storage/framework/sessions/*",
    "storage/framework/views/*",
    ".env",
    ".env.*",
    "*.log",
    ".gitignore",
    ".gitattributes",
    "deploy*.ps1",
    "deploy*.sh",
    "*.md",
    "log.zip"
)

# Use Compress-Archive with exclusions
Write-Host "Compressing files (this may take a minute)..." -ForegroundColor Gray
Get-ChildItem -Path . -Recurse | Where-Object {
    $file = $_
    $shouldExclude = $false
    foreach ($pattern in $excludePatterns) {
        if ($file.FullName -like "*\$($pattern.Replace('/', '\'))") {
            $shouldExclude = $true
            break
        }
    }
    -not $shouldExclude -and -not $file.PSIsContainer
} | Compress-Archive -DestinationPath "cinewave-deploy.zip" -CompressionLevel Optimal

if (Test-Path "cinewave-deploy.zip") {
    $zipSize = (Get-Item "cinewave-deploy.zip").Length / 1MB
    Write-Host "✓ Package created: $([math]::Round($zipSize, 2)) MB" -ForegroundColor Green
} else {
    Write-Host "ERROR: Failed to create deployment package!" -ForegroundColor Red
    exit 1
}

# Step 4: Configure App Settings
Write-Host "`n[4/7] Configuring App Settings..." -ForegroundColor Yellow

$appSettings = @(
    "DB_CONNECTION=mongodb"
    "MONGODB_DSN=$mongoDBDSN"
    "MONGODB_DATABASE=$DatabaseName"
    "APP_ENV=production"
    "APP_DEBUG=false"
    "APP_URL=https://${AppName}.azurewebsites.net"
    "LOG_LEVEL=debug"
    "SESSION_DRIVER=database"
    "CACHE_STORE=database"
    "QUEUE_CONNECTION=database"
    "WEBSITE_ENABLE_APP_SERVICE_STORAGE=true"
    "WEBSITES_ENABLE_APP_SERVICE_STORAGE=true"
    "SCM_DO_BUILD_DURING_DEPLOYMENT=false"
)

try {
    $settingsString = $appSettings -join " "
    az webapp config appsettings set --resource-group $ResourceGroup --name $AppName --settings $appSettings | Out-Null
    Write-Host "✓ App settings configured" -ForegroundColor Green
} catch {
    Write-Host "ERROR: Failed to set app settings: $_" -ForegroundColor Red
    exit 1
}

# Step 5: Stop the app
Write-Host "`n[5/7] Stopping web app..." -ForegroundColor Yellow
try {
    az webapp stop --resource-group $ResourceGroup --name $AppName | Out-Null
    Start-Sleep -Seconds 5
    Write-Host "✓ App stopped" -ForegroundColor Green
} catch {
    Write-Host "Warning: Could not stop app: $_" -ForegroundColor Yellow
}

# Step 6: Deploy package
Write-Host "`n[6/7] Deploying package to Azure..." -ForegroundColor Yellow
Write-Host "This will take 2-3 minutes..." -ForegroundColor Gray

try {
    az webapp deploy --resource-group $ResourceGroup --name $AppName --src-path "cinewave-deploy.zip" --type zip --async false
    Write-Host "✓ Deployment completed" -ForegroundColor Green
} catch {
    Write-Host "ERROR: Deployment failed: $_" -ForegroundColor Red
    Write-Host "Attempting to start app anyway..." -ForegroundColor Yellow
}

# Step 7: Start the app
Write-Host "`n[7/7] Starting web app..." -ForegroundColor Yellow
try {
    az webapp start --resource-group $ResourceGroup --name $AppName | Out-Null
    Start-Sleep -Seconds 10
    Write-Host "✓ App started" -ForegroundColor Green
} catch {
    Write-Host "ERROR: Could not start app: $_" -ForegroundColor Red
}

# Final status check
Write-Host "`n=== Deployment Summary ===" -ForegroundColor Cyan
Write-Host "App URL: https://${AppName}.azurewebsites.net" -ForegroundColor Green
Write-Host "Kudu URL: https://${AppName}.scm.azurewebsites.net" -ForegroundColor Green
Write-Host "Diagnostic URL: https://${AppName}.azurewebsites.net/diagnostic.php" -ForegroundColor Green

Write-Host "`nWaiting 30 seconds for app to warm up..." -ForegroundColor Gray
Start-Sleep -Seconds 30

Write-Host "`nTesting endpoints..." -ForegroundColor Yellow
try {
    $response = Invoke-WebRequest -Uri "https://${AppName}.azurewebsites.net" -Method Head -TimeoutSec 30 -ErrorAction SilentlyContinue
    if ($response.StatusCode -eq 200) {
        Write-Host "✓ Main site is responding!" -ForegroundColor Green
    } else {
        Write-Host "⚠ Main site returned status: $($response.StatusCode)" -ForegroundColor Yellow
    }
} catch {
    Write-Host "⚠ Main site check failed: $_" -ForegroundColor Yellow
    Write-Host "Please check manually: https://${AppName}.azurewebsites.net" -ForegroundColor Yellow
}

Write-Host "`n=== Deployment Complete! ===" -ForegroundColor Cyan
Write-Host "`nIf you still see errors, check logs at:" -ForegroundColor White
Write-Host "https://${AppName}.scm.azurewebsites.net/api/logs/docker" -ForegroundColor Gray

# Cleanup
Write-Host "`nCleaning up deployment package..." -ForegroundColor Gray
Remove-Item "cinewave-deploy.zip" -Force -ErrorAction SilentlyContinue
Write-Host "✓ Done!" -ForegroundColor Green
