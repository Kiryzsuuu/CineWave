# Status Deployment CineWave ke Azure

## ✅ Yang Sudah Berhasil

### 1. Infrastructure Azure
- ✅ Resource Group: **WebOpet** (Indonesia Central)
- ✅ App Service Plan: **CineWavePlan** (B1 Basic, Linux)
- ✅ Web App: **CineWave**
- ✅ URL: https://cinewave.azurewebsites.net

### 2. Environment Variables (Sudah Di-Set!)
```
✅ APP_NAME = CineWave
✅ APP_ENV = production
✅ APP_KEY = base64:662HN9ufDoD72mIitjICn/jJV1w7Eog8+S5Yzb+EXeY=
✅ APP_DEBUG = false
✅ APP_URL = https://cinewave.azurewebsites.net
✅ DB_CONNECTION = mongodb
✅ DB_DATABASE = cinewave
✅ MONGODB_URI = mongodb+srv://maskiryz23_db_user:biSdlM7bJKVBA8QP@cnw.0gsh98f.mongodb.net/cinewave?retryWrites=true&w=majority
✅ MAIL_MAILER = smtp
✅ MAIL_HOST = smtp.gmail.com
✅ MAIL_PORT = 587
✅ MAIL_USERNAME = maskiryz23@gmail.com
✅ MAIL_ENCRYPTION = tls
✅ SESSION_DRIVER = file
✅ CACHE_DRIVER = file
✅ SCM_DO_BUILD_DURING_DEPLOYMENT = true
```

### 3. GitHub Integration
- ✅ Repository: https://github.com/Kiryzsuuu/CineWave.git
- ✅ Branch: main
- ✅ Manual Integration: Active
- ✅ Deployment telah di-trigger

### 4. IP Addresses untuk MongoDB Whitelist
```
70.153.131.52, 70.153.131.53, 70.153.129.93, 70.153.129.136, 
70.153.129.145, 70.153.129.193, 70.153.112.175, 70.153.112.196, 
70.153.112.237, 70.153.104.60, 70.153.104.66, 70.153.112.98, 
70.153.129.43, 70.153.129.129, 70.153.130.169, 70.153.130.251, 
70.153.129.141, 70.153.131.25, 70.153.161.0
```

## ⚠️ Yang Perlu Dilakukan

### 1. CRITICAL: Gmail App Password (MAIL_PASSWORD)
Saat ini menggunakan placeholder. Anda perlu:
1. Buka https://myaccount.google.com/apppasswords
2. Login dengan maskiryz23@gmail.com
3. Generate App Password dengan nama "CineWave Azure"
4. Update environment variable:
```bash
az webapp config appsettings set --name CineWave --resource-group WebOpet --settings MAIL_PASSWORD="your_16_char_app_password"
```

### 2. CRITICAL: MongoDB Atlas IP Whitelist
Tambahkan IP addresses Azure ke MongoDB Atlas:
1. Buka https://cloud.mongodb.com
2. Pilih cluster **CNW**
3. Network Access → Add IP Address
4. Pilih salah satu:
   - **Option A** (Recommended for testing): Add `0.0.0.0/0` untuk allow all
   - **Option B** (Production): Add semua IP addresses di atas satu per satu

### 3. Test Deployment
Setelah MongoDB IP di-whitelist:
1. Buka: https://cinewave.azurewebsites.net
2. Test:
   - ✅ Landing page loading
   - ✅ Register user baru (akan cek email OTP)
   - ✅ Login dengan admin: maskiryz23@gmail.com / admin123
   - ✅ Admin dashboard: https://cinewave.azurewebsites.net/admin
   - ✅ Browse movies
   - ✅ Add to watchlist
   - ✅ Community discussions
   - ✅ Rating & reviews

## 📋 Commands Reference

### Check Deployment Status
```bash
az webapp show --name CineWave --resource-group WebOpet --query state
```

### View Logs
```bash
az webapp log tail --name CineWave --resource-group WebOpet
```

### Restart App (after config changes)
```bash
az webapp restart --name CineWave --resource-group WebOpet
```

### Re-Deploy from GitHub
```bash
az webapp deployment source sync --name CineWave --resource-group WebOpet
```

### Update Environment Variable
```bash
az webapp config appsettings set --name CineWave --resource-group WebOpet --settings KEY=VALUE
```

## 🎯 Next Steps

1. **Sekarang**: Set Gmail App Password
2. **Sekarang**: Whitelist IP MongoDB
3. **Test**: Buka https://cinewave.azurewebsites.net
4. **Production**: Monitor logs untuk errors
5. **Future**: Setup custom domain (optional)
6. **Future**: Enable SSL certificate (optional)

## 🔗 Important URLs

- **Production**: https://cinewave.azurewebsites.net
- **Admin**: https://cinewave.azurewebsites.net/admin
- **SCM/Kudu**: https://cinewave.scm.azurewebsites.net
- **Azure Portal**: https://portal.azure.com
- **MongoDB Atlas**: https://cloud.mongodb.com
- **GitHub Repo**: https://github.com/Kiryzsuuu/CineWave

---
**Status**: Environment variables ✅ | MongoDB Whitelist ⏳ | Gmail Password ⏳
**Last Updated**: 2025-12-13
