# 🚀 Langkah-Langkah Setup Final CineWave di Azure

## Status Saat Ini
✅ Azure App Service sudah running di https://cinewave.azurewebsites.net
✅ Environment variables sudah di-set
✅ GitHub deployment sudah terhubung
✅ PHP 8.2 runtime sudah aktif

## ⚠️ 2 Langkah WAJIB Sebelum Aplikasi Bisa Jalan:

### 📧 LANGKAH 1: Setup Gmail App Password (5 menit)

Browser sudah terbuka di: https://myaccount.google.com/apppasswords

**Cara Setup:**
1. Login dengan akun: **maskiryz23@gmail.com**
2. Klik "Create app password" atau "Buat sandi aplikasi"
3. Di "App name", ketik: **CineWave Azure**
4. Klik "Create" atau "Buat"
5. **COPY** password 16 karakter yang muncul (contoh: `abcd efgh ijkl mnop`)
6. Hapus spasi, jadi: `abcdefghijklmnop`
7. **Jalankan command di bawah** (ganti dengan password Anda):

```powershell
az webapp config appsettings set --name CineWave --resource-group WebOpet --settings MAIL_PASSWORD="abcdefghijklmnop"
```

---

### 🗄️ LANGKAH 2: Whitelist IP di MongoDB Atlas (3 menit)

Browser sudah terbuka di: https://cloud.mongodb.com

**Cara Setup (MUDAH - For Testing):**
1. Login ke MongoDB Atlas
2. Pilih cluster **CNW**
3. Klik tab **"Network Access"** di sidebar kiri
4. Klik tombol **"ADD IP ADDRESS"**
5. Klik **"ALLOW ACCESS FROM ANYWHERE"**
6. Akan muncul IP: `0.0.0.0/0`
7. Klik **"Confirm"**

**✅ SELESAI!** MongoDB sekarang bisa diakses dari Azure.

**Cara Setup (PRODUCTION - Lebih Aman):**
Jika ingin lebih secure, tambahkan IP satu per satu:
```
70.153.131.52
70.153.131.53
70.153.129.93
70.153.129.136
70.153.129.145
70.153.129.193
70.153.112.175
70.153.112.196
70.153.112.237
70.153.104.60
70.153.104.66
70.153.112.98
70.153.129.43
70.153.129.129
70.153.130.169
70.153.130.251
70.153.129.141
70.153.131.25
70.153.161.0
```

---

## 🎯 Setelah Kedua Langkah Selesai

Jalankan command berikut untuk restart aplikasi:

```powershell
# Restart app
az webapp restart --name CineWave --resource-group WebOpet

# Tunggu 30 detik, lalu test
timeout /t 30

# Buka aplikasi di browser
start https://cinewave.azurewebsites.net
```

---

## 🧪 Testing Checklist

Setelah aplikasi terbuka, test fitur-fitur ini:

- [ ] **Landing Page** - Apakah tampil dengan baik?
- [ ] **Register** - Buat akun baru, cek email OTP
- [ ] **Login Admin** - maskiryz23@gmail.com / admin123
- [ ] **Admin Dashboard** - https://cinewave.azurewebsites.net/admin
- [ ] **Browse Movies** - List film tampil?
- [ ] **Movie Details** - Klik film, lihat detail
- [ ] **Watchlist** - Tambah ke watchlist (tombol +)
- [ ] **Rating** - Beri rating bintang
- [ ] **Comment** - Tulis komentar
- [ ] **Community** - https://cinewave.azurewebsites.net/community

---

## 🔧 Troubleshooting

### Jika halaman error 500:
```powershell
# Lihat error logs
az webapp log tail --name CineWave --resource-group WebOpet
```

### Jika database connection error:
- Pastikan MongoDB IP whitelist sudah di-set
- Cek MONGODB_URI di environment variables

### Jika email tidak terkirim:
- Pastikan MAIL_PASSWORD sudah di-set dengan Gmail App Password

---

## 📞 Command Reference

```powershell
# Check app status
az webapp show --name CineWave --resource-group WebOpet --query state

# View logs
az webapp log tail --name CineWave --resource-group WebOpet

# Restart app
az webapp restart --name CineWave --resource-group WebOpet

# Update setting
az webapp config appsettings set --name CineWave --resource-group WebOpet --settings KEY=VALUE

# Re-deploy from GitHub
az webapp deployment source sync --name CineWave --resource-group WebOpet
```

---

**🎉 Setelah setup selesai, CineWave akan fully functional di Azure!**
