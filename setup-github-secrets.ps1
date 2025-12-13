# GitHub Secrets Setup Helper
# This script will open GitHub secrets page and show you what to paste

Write-Host "=" -ForegroundColor Cyan
Write-Host "===== GitHub Actions Setup - Otomatis Deployment =====" -ForegroundColor Cyan
Write-Host "=" -ForegroundColor Cyan

Write-Host "`n[1/2] Opening GitHub Secrets Page..." -ForegroundColor Yellow
Start-Process "https://github.com/Kiryzsuuu/CineWave/settings/secrets/actions/new"

Write-Host "`n[2/2] Secrets yang perlu ditambahkan:" -ForegroundColor Yellow
Write-Host ""

# Secret 1
Write-Host "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "SECRET 1 of 5: AZURE_WEBAPP_PUBLISH_PROFILE" -ForegroundColor Green
Write-Host "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "Isi file publish-profile-github.xml (sudah dibuat)" -ForegroundColor White
Write-Host ""
Read-Host "Tekan ENTER setelah Secret 1 tersimpan"

# Secret 2
Write-Host "`n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "SECRET 2 of 5: MONGODB_DSN" -ForegroundColor Green
Write-Host "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "Getting connection string from Azure..." -ForegroundColor Yellow
$mongodsn = (az cosmosdb keys list --resource-group WebOpet --name cinewave-db --type connection-strings --query "connectionStrings[0].connectionString" -o tsv)
if ($mongodsn) {
    Write-Host $mongodsn -ForegroundColor White
    Set-Clipboard -Value $mongodsn
    Write-Host "✅ Copied to clipboard! Paste dengan Ctrl+V" -ForegroundColor Cyan
} else {
    Write-Host "❌ Failed to get connection string. Run manually:" -ForegroundColor Red
    Write-Host "az cosmosdb keys list --resource-group WebOpet --name cinewave-db --type connection-strings" -ForegroundColor Yellow
}
Read-Host "Tekan ENTER setelah Secret 2 tersimpan"

# Secret 3
Write-Host "`n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "SECRET 3 of 5: APP_KEY" -ForegroundColor Green
Write-Host "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "Reading from .env file..." -ForegroundColor Yellow
$envContent = Get-Content .env -Raw
$appkey = ($envContent | Select-String -Pattern 'APP_KEY=(.*)').Matches.Groups[1].Value.Trim()
if ($appkey) {
    Write-Host $appkey -ForegroundColor White
    Set-Clipboard -Value $appkey
    Write-Host "✅ Copied to clipboard! Paste dengan Ctrl+V" -ForegroundColor Cyan
} else {
    Write-Host "❌ APP_KEY not found in .env" -ForegroundColor Red
}
Read-Host "Tekan ENTER setelah Secret 3 tersimpan"

# Secret 4
Write-Host "`n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "SECRET 4 of 5: MAIL_USERNAME" -ForegroundColor Green
Write-Host "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "Reading from .env file..." -ForegroundColor Yellow
$mailusername = ($envContent | Select-String -Pattern 'MAIL_USERNAME=(.*)').Matches.Groups[1].Value.Trim()
if ($mailusername) {
    Write-Host $mailusername -ForegroundColor White
    Set-Clipboard -Value $mailusername
    Write-Host "✅ Copied to clipboard! Paste dengan Ctrl+V" -ForegroundColor Cyan
} else {
    Write-Host "❌ MAIL_USERNAME not found in .env" -ForegroundColor Red
}
Read-Host "Tekan ENTER setelah Secret 4 tersimpan"

# Secret 5
Write-Host "`n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "SECRET 5 of 5: MAIL_PASSWORD" -ForegroundColor Green
Write-Host "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "Reading from .env file..." -ForegroundColor Yellow
$mailpassword = ($envContent | Select-String -Pattern 'MAIL_PASSWORD="(.*)"').Matches.Groups[1].Value.Trim()
if ($mailpassword) {
    Write-Host $mailpassword -ForegroundColor White
    Set-Clipboard -Value $mailpassword
    Write-Host "✅ Copied to clipboard! Paste dengan Ctrl+V" -ForegroundColor Cyan
} else {
    Write-Host "❌ MAIL_PASSWORD not found in .env" -ForegroundColor Red
}
Read-Host "Tekan ENTER setelah Secret 5 tersimpan"

Write-Host "`n" -ForegroundColor Green
Write-Host "✅ SEMUA SECRETS SUDAH TERSIMPAN!" -ForegroundColor Green
Write-Host ""
Write-Host "Langkah selanjutnya:" -ForegroundColor Yellow
Write-Host "1. Commit workflow file:" -ForegroundColor White
Write-Host "   git add ." -ForegroundColor Cyan
Write-Host "   git commit -m 'Setup automated deployment'" -ForegroundColor Cyan
Write-Host "   git push origin main" -ForegroundColor Cyan
Write-Host ""
Write-Host "2. Monitor deployment di:" -ForegroundColor White
Write-Host "   https://github.com/Kiryzsuuu/CineWave/actions" -ForegroundColor Cyan
Write-Host ""
Write-Host "🎉 Deployment otomatis akan berjalan setiap kali push!" -ForegroundColor Green
