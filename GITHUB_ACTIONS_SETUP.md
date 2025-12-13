# Setup GitHub Actions - Panduan Lengkap

## 🚀 Deployment Otomatis Sudah Siap!

Workflow GitHub Actions sudah dikonfigurasi di `.github/workflows/azure-deploy.yml`

## 📝 Langkah Setup (HANYA 1 KALI):

### 1. Download Publish Profile dari Azure
```powershell
az webapp deployment list-publishing-profiles --resource-group WebOpet --name CineWave --xml
```

Copy output XML lengkap (dari `<publishData>` sampai `</publishData>`)

### 2. Setup GitHub Secrets

Buka: https://github.com/Kiryzsuuu/CineWave/settings/secrets/actions

Tambahkan secrets berikut (klik "New repository secret" untuk setiap item):

#### Secret 1: AZURE_WEBAPP_PUBLISH_PROFILE
**Nama:** `AZURE_WEBAPP_PUBLISH_PROFILE`  
**Value:** Paste seluruh XML dari langkah 1

#### Secret 2: MONGODB_DSN
**Nama:** `MONGODB_DSN`  
**Value:** 
```
mongodb://cinewave-db:WWsiTKuBl0ULG5VnRxTAxZKIbsI2AQWZi36YF4KmiKx0AVmRmlNechaRKN4z8wZsZNZd2DECXN04ACDb7AGy9w==@cinewave-db.mongo.cosmos.azure.com:10255/?ssl=true&replicaSet=globaldb&retrywrites=false&maxIdleTimeMS=120000&appName=@cinewave-db@
```

#### Secret 3: APP_KEY
**Nama:** `APP_KEY`  
**Value:** 
```
base64:NbzF3k5nZFhNh9LY2Hr4lYeN1XjyJsZ3idB+xLa7SDg=
```

#### Secret 4: MAIL_USERNAME
**Nama:** `MAIL_USERNAME`  
**Value:** 
```
maskiryz23@gmail.com
```

#### Secret 5: MAIL_PASSWORD
**Nama:** `MAIL_PASSWORD`  
**Value:** 
```
aeth lqgk huov pdsp
```

### 3. Commit & Push

Setelah semua secrets tersimpan, commit workflow file:

```powershell
git add .github/workflows/azure-deploy.yml
git commit -m "Setup automated deployment workflow"
git push origin main
```

## ✅ Cara Kerja Otomatis:

1. **Setiap kali push ke branch `main`** → deployment otomatis
2. **Build di GitHub:**
   - Install PHP dependencies (composer)
   - Build frontend assets (npm)
   - Optimize Laravel (cache config, routes, views)
   - Create .env dengan secrets
3. **Deploy ke Azure:**
   - Upload package ke CineWave App Service
   - Azure restart otomatis
4. **Warm up:**
   - Test endpoint otomatis

## 🔍 Monitor Deployment:

- **GitHub Actions:** https://github.com/Kiryzsuuu/CineWave/actions
- **Azure Logs:**
  ```powershell
  az webapp log tail --resource-group WebOpet --name CineWave
  ```

## 🎯 Manual Trigger (Jika Perlu):

1. Buka: https://github.com/Kiryzsuuu/CineWave/actions
2. Klik "Deploy to Azure App Service"
3. Klik "Run workflow" → "Run workflow"

## ⚠️ Troubleshooting:

Jika deployment gagal, cek:
1. Semua 5 secrets sudah tersimpan dengan benar
2. Publish profile valid (tidak expired)
3. GitHub Actions logs di tab "Actions"

---

**SETELAH SETUP:** Tinggal `git push` dan aplikasi otomatis deploy! 🎉
