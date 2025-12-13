#!/usr/bin/env pwsh
# Quick script to get Cosmos DB connection string

param(
    [string]$ResourceGroup = "CineWave_group",
    [string]$CosmosAccountName = "cinewave-db"
)

Write-Host "=== Getting Cosmos DB Connection String ===" -ForegroundColor Cyan

try {
    Write-Host "`nFetching from Azure..." -ForegroundColor Yellow
    
    # Get connection string
    $connectionString = az cosmosdb keys list `
        --resource-group $ResourceGroup `
        --name $CosmosAccountName `
        --type connection-strings `
        --query "connectionStrings[?description=='Primary MongoDB Connection String'].connectionString" `
        -o tsv
    
    if ($connectionString) {
        Write-Host "`n✓ Connection String Retrieved!" -ForegroundColor Green
        Write-Host "`nCopy this to your .env file as MONGODB_DSN:" -ForegroundColor Yellow
        Write-Host "`n$connectionString`n" -ForegroundColor White
        
        # Also show formatted version
        if ($connectionString -match "mongodb://([^:]+):([^@]+)@([^/]+)/") {
            $username = $matches[1]
            $password = $matches[2]
            $host = $matches[3]
            
            $formattedDSN = "mongodb://${username}:${password}@${host}/?ssl=true&retrywrites=false&replicaSet=globaldb&maxIdleTimeMS=120000&appName=@${CosmosAccountName}@"
            
            Write-Host "Optimized version for Azure App Service:" -ForegroundColor Yellow
            Write-Host "`n$formattedDSN`n" -ForegroundColor Cyan
            
            # Update .env file
            Write-Host "Would you like to update .env file automatically? (y/n): " -NoNewline -ForegroundColor Yellow
            $response = Read-Host
            
            if ($response -eq 'y' -or $response -eq 'Y') {
                $envPath = ".env"
                if (Test-Path $envPath) {
                    $envContent = Get-Content $envPath -Raw
                    
                    # Replace MONGODB_DSN line
                    $newEnvContent = $envContent -replace 'MONGODB_DSN="[^"]*"', "MONGODB_DSN=`"$formattedDSN`""
                    
                    Set-Content -Path $envPath -Value $newEnvContent -NoNewline
                    Write-Host "✓ .env file updated successfully!" -ForegroundColor Green
                } else {
                    Write-Host "✗ .env file not found!" -ForegroundColor Red
                }
            }
        }
    } else {
        Write-Host "✗ Could not retrieve connection string!" -ForegroundColor Red
        Write-Host "`nPlease check:" -ForegroundColor Yellow
        Write-Host "1. Resource group name: $ResourceGroup" -ForegroundColor White
        Write-Host "2. Cosmos DB account name: $CosmosAccountName" -ForegroundColor White
        Write-Host "3. Your Azure CLI is logged in: az login" -ForegroundColor White
    }
    
} catch {
    Write-Host "✗ Error: $_" -ForegroundColor Red
}

Write-Host "`n=== Done ===" -ForegroundColor Cyan
