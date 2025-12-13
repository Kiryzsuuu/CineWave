# 🎉 CineWave - Deployment Azure SUKSES!

## ✅ Status Deployment

### Infrastructure (SELESAI)
- ✅ Azure App Service Plan: **CineWavePlan** (B1 Basic)
- ✅ Azure Web App: **CineWave**  
- ✅ URL Production: https://cinewave.azurewebsites.net
- ✅ Region: Indonesia Central
- ✅ Runtime: PHP 8.2

### Environment Variables (SELESAI)
- ✅ APP_KEY: Set dengan production key
- ✅ MongoDB URI: Configured
- ✅ Gmail SMTP: maskiryz23@gmail.com
- ✅ Mail Password: aethlqgkhuovpdsp (App Password ter-set)

### GitHub Integration (SELESAI)
- ✅ Repository: https://github.com/Kiryzsuuu/CineWave  
- ✅ GitHub Actions workflow: Created (.github/workflows/azure-deploy.yml)
- ✅ Latest commit pushed: 26c5a05
- ✅ Publish profile: Copied to clipboard

## 🚀 Langkah Terakhir (PENTING!)

### 1. Setup GitHub Secret untuk Auto-Deploy

Publish profile sudah di-copy ke clipboard. Sekarang:

1. **Browser sudah terbuka** di: https://github.com/Kiryzsuuu/CineWave/settings/secrets/actions/new

2. **Isi form:**
   - Name: `AZURE_WEBAPP_PUBLISH_PROFILE`
   - Secret: **PASTE dari clipboard** (Ctrl+V)

3. **Klik "Add secret"**

### 2. Whitelist IP di MongoDB Atlas (Jika belum)

1. Buka: https://cloud.mongodb.com
2. Cluster **CNW** → **Network Access**
3. **Add IP Address** → **Allow Access from Anywhere** (0.0.0.0/0)
4. Klik **Confirm**

### 3. Trigger Deployment

Setelah GitHub secret di-set:

```powershell
# Option A: Push empty commit untuk trigger GitHub Actions
git commit --allow-empty -m "Trigger deployment"; git push

# Option B: Atau manual trigger di GitHub
# https://github.com/Kiryzsuuu/CineWave/actions
```

### 4. Monitor Deployment

```powershell
# Watch GitHub Actions progress
start https://github.com/Kiryzsuuu/CineWave/actions

# Check Azure logs
az webapp log tail --name CineWave --resource-group WebOpet
```

### 5. Test Aplikasi

Setelah deployment selesai (sekitar 3-5 menit):

```powershell
# Open application
start https://cinewave.azurewebsites.net

# Test endpoints
# Landing page: https://cinewave.azurewebsites.net
# Admin login: https://cinewave.azurewebsites.net/login
#   Email: maskiryz23@gmail.com
#   Password: admin123
# Admin dashboard: https://cinewave.azurewebsites.net/admin
```

## 📋 Reference Commands

```powershell
# Restart app
az webapp restart --name CineWave --resource-group WebOpet

# View logs
az webapp log tail --name CineWave --resource-group WebOpet

# Check app status
az webapp show --name CineWave --resource-group WebOpet --query state

# List environment variables
az webapp config appsettings list --name CineWave --resource-group WebOpet

# Update environment variable
az webapp config appsettings set --name CineWave --resource-group WebOpet --settings KEY=VALUE

# Re-deploy from GitHub
git push origin main  # Automatic via GitHub Actions
```

## 🔐 Credentials Summary

### Azure
- **Subscription**: Azure for Students
- **Resource Group**: WebOpet  
- **App Service**: CineWave
- **App URL**: https://cinewave.azurewebsites.net

### MongoDB Atlas
- **Cluster**: CNW
- **Database**: cinewave
- **Username**: maskiryz23_db_user
- **Password**: biSdlM7bJKVBA8QP
- **Connection String**: mongodb+srv://maskiryz23_db_user:biSdlM7bJKVBA8QP@cnw.0gsh98f.mongodb.net/cinewave

### Email (Gmail SMTP)
- **Email**: maskiryz23@gmail.com
- **App Password**: aeth lqgk huov pdsp
- **SMTP Host**: smtp.gmail.com:587

### Admin Account
- **Email**: maskiryz23@gmail.com
- **Password**: admin123

## 🎯 What Happens Next

1. **Setelah GitHub Secret di-set** → GitHub Actions akan otomatis deploy setiap kali ada push ke `main`

2. **Deployment Process (Automatic):**
   - Checkout code from GitHub
   - Install Composer dependencies
   - Install NPM dependencies  
   - Build assets (Vite)
   - Create deployment package
   - Deploy to Azure App Service
   - App automatically restarts

3. **Aplikasi Live di:**
   - Production URL: https://cinewave.azurewebsites.net
   - Admin Panel: https://cinewave.azurewebsites.net/admin

## ✨ Features Available

- ✅ User Registration dengan OTP Email
- ✅ Login/Logout
- ✅ Browse Movies dengan filter & search
- ✅ Movie Details dengan rating & reviews
- ✅ Watchlist (+) button
- ✅ Community Discussions
- ✅ Rating System (1-5 stars)
- ✅ Comment System dengan nested replies
- ✅ Admin Dashboard untuk manage movies & users
- ✅ Responsive Design (Mobile-First)
- ✅ Email Notifications (Welcome, OTP, Forgot Password)

## 📞 Troubleshooting

### Jika halaman masih menampilkan "Your web app is running..."
```powershell
# Trigger manual deployment
start https://github.com/Kiryzsuuu/CineWave/actions/workflows/azure-deploy.yml
# Click "Run workflow"
```

### Jika ada error 500
```powershell
# Check logs
az webapp log tail --name CineWave --resource-group WebOpet

# Verify MongoDB whitelist
# Go to: https://cloud.mongodb.com → CNW → Network Access
```

### Jika email tidak terkirim
- Pastikan MAIL_PASSWORD sudah di-set di Azure environment variables
- Test Gmail App Password masih valid

---

**Status**: ⏳ Menunggu GitHub Secret Setup  
**Next Action**: Setup GitHub secret AZURE_WEBAPP_PUBLISH_PROFILE  
**Last Updated**: 2025-12-13  
**Deployment Method**: GitHub Actions → Azure App Service
