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
$mongodsn = "mongodb://cinewave-db:WWsiTKuBl0ULG5VnRxTAxZKIbsI2AQWZi36YF4KmiKx0AVmRmlNechaRKN4z8wZsZNZd2DECXN04ACDb7AGy9w==@cinewave-db.mongo.cosmos.azure.com:10255/?ssl=true&replicaSet=globaldb&retrywrites=false&maxIdleTimeMS=120000&appName=@cinewave-db@"
Write-Host $mongodsn -ForegroundColor White
Set-Clipboard -Value $mongodsn
Write-Host "✅ Copied to clipboard! Paste dengan Ctrl+V" -ForegroundColor Cyan
Read-Host "Tekan ENTER setelah Secret 2 tersimpan"

# Secret 3
Write-Host "`n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "SECRET 3 of 5: APP_KEY" -ForegroundColor Green
Write-Host "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
$appkey = "base64:NbzF3k5nZFhNh9LY2Hr4lYeN1XjyJsZ3idB+xLa7SDg="
Write-Host $appkey -ForegroundColor White
Set-Clipboard -Value $appkey
Write-Host "✅ Copied to clipboard! Paste dengan Ctrl+V" -ForegroundColor Cyan
Read-Host "Tekan ENTER setelah Secret 3 tersimpan"

# Secret 4
Write-Host "`n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "SECRET 4 of 5: MAIL_USERNAME" -ForegroundColor Green
Write-Host "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
$mailusername = "maskiryz23@gmail.com"
Write-Host $mailusername -ForegroundColor White
Set-Clipboard -Value $mailusername
Write-Host "✅ Copied to clipboard! Paste dengan Ctrl+V" -ForegroundColor Cyan
Read-Host "Tekan ENTER setelah Secret 4 tersimpan"

# Secret 5
Write-Host "`n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
Write-Host "SECRET 5 of 5: MAIL_PASSWORD" -ForegroundColor Green
Write-Host "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor DarkGray
$mailpassword = "aeth lqgk huov pdsp"
Write-Host $mailpassword -ForegroundColor White
Set-Clipboard -Value $mailpassword
Write-Host "✅ Copied to clipboard! Paste dengan Ctrl+V" -ForegroundColor Cyan
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
