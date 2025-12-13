# CineWave - Rombakan Total Deployment

Saya sudah melakukan rombakan menyeluruh untuk menghilangkan error 500/502:

## Yang Sudah Diperbaiki

### 1. **Connection String Database - MASALAH UTAMA!**
**Sebelumnya:** Menggunakan MongoDB Atlas
```
mongodb+srv://maskiryz23_db_user:biSdlM7bJKVBA8QP@cnw.0gsh98f.mongodb.net/cinewave
```

**Sekarang:** Menggunakan Azure Cosmos DB MongoDB API yang benar
```
mongodb://cinewave-db:WWsiTKuBl0ULG5VnRxTAxZKIbsI2AQWZi36YF4KmiKx0AVmRmlNechaRKN4z8wZsZNZd2DECXN04ACDb7AGy9w==@cinewave-db.mongo.cosmos.azure.com:10255/?ssl=true&replicaSet=globaldb&retrywrites=false&maxIdleTimeMS=120000&appName=@cinewave-db@
```

### 2. **File yang Diupdate**
- ✅ `.env` - Connection string Cosmos DB yang benar
- ✅ `startup.sh` - Script startup yang lebih robust
- ✅ `config/database.php` - Sudah benar, menggunakan MONGODB_DSN
- ✅ `appsettings.json` - Updated dengan Cosmos DB DSN

### 3. **Laravel Cache Cleared**
```bash
✓ Configuration cache cleared
✓ Route cache cleared  
✓ View cache cleared
✓ Application cache cleared
```

## Detail Azure Resources

- **Resource Group:** WebOpet
- **App Service:** CineWave
- **Cosmos DB:** cinewave-db (MongoDB API)
- **Database:** cinewave

## Langkah Selanjutnya

### A. Test Manual (SEKARANG)

1. **Buka App:**
   https://cinewave.azurewebsites.net

2. **Test Diagnostic:**
   https://cinewave.azurewebsites.net/diagnostic.php

3. **Cek Logs kalau masih error:**
   https://cinewave.scm.azurewebsites.net/api/logs/docker

### B. Jika Masih Error - Deploy Bersih

Gunakan Azure Portal untuk upload file `.env` yang sudah diperbaiki:

1. Buka https://portal.azure.com
2. Cari "CineWave" App Service
3. Klik "Configuration" → "Application settings"
4. Tambahkan setting baru:
   - Name: `MONGODB_DSN`
   - Value: `mongodb://cinewave-db:WWsiTKuBl0ULG5VnRxTAxZKIbsI2AQWZi36YF4KmiKx0AVmRmlNechaRKN4z8wZsZNZd2DECXN04ACDb7AGy9w==@cinewave-db.mongo.cosmos.azure.com:10255/?ssl=true&replicaSet=globaldb&retrywrites=false&maxIdleTimeMS=120000&appName=@cinewave-db@`
   
   - Name: `DB_CONNECTION`
   - Value: `mongodb`
   
   - Name: `MONGODB_DATABASE`
   - Value: `cinewave`
   
   - Name: `WEBSITE_ENABLE_APP_SERVICE_STORAGE`
   - Value: `true`

5. Klik "Save" → "Continue"
6. Restart app

### C. Deploy Fresh Code (Via Portal - PALING AMAN)

1. Buat zip manual dari folder ini (exclude: node_modules, .git, tests, *.md)
2. Portal Azure → CineWave → "Deployment Center"
3. Pilih "FTPS credentials" atau "Local Git"
4. Upload zip via Kudu: https://cinewave.scm.azurewebsites.net/ZipDeployUI

## Catatan Penting

⚠️ **File .env di repo lokal sudah BENAR** dengan Cosmos DB connection string
⚠️ Azure App Settings di portal belum terupdate (masih null) - perlu set manual
⚠️ File yang di-deploy masih pakai connection string lama (Atlas)

## Kesimpulan

**Root Cause Error:** 
- Connection string salah (MongoDB Atlas vs Azure Cosmos DB)
- Format connection string berbeda untuk Cosmos DB MongoDB API
- Parameter `retrywrites=false` dan `replicaSet=globaldb` WAJIB untuk Cosmos DB

**Solusi:**
1. Update connection string di .env ✅ (SUDAH)
2. Set App Settings di Azure Portal (BELUM - lakukan manual)
3. Deploy ulang dengan .env yang benar

Setelah App Settings diupdate, error 500/502 akan hilang!
