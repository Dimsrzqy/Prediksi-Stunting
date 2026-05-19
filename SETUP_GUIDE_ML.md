# Panduan Integrasi Machine Learning - Aplikasi Prediksi Stunting

## 📋 Ringkasan Perubahan

### Penyederhanaan Form Input

Form halaman prediksi telah disederhanakan untuk **hanya mengumpulkan 4 data penting**:

- ✅ Jenis Kelamin (Laki-laki / Perempuan)
- ✅ Usia (dalam bulan)
- ✅ Berat Badan (kg)
- ✅ Tinggi Badan (cm)

**Dihapus:**

- ❌ Nama Lengkap
- ❌ Tanggal Lahir

Pendekatan ini lebih efisien dan langsung terhubung ke model machine learning.

### Integrasi API Machine Learning

- **Backend**: Laravel controller `GuestPrediksiController` menerjemahkan form ke format API
- **ML API**: FastAPI server di port `8001` melakukan prediksi menggunakan Random Forest model
- **Response Processing**: Backend memetakan hasil ML ke kategori risiko (Rendah/Sedang/Tinggi)

---

## 🚀 Cara Menjalankan Sistem

### 1️⃣ Persiapan Folder ML

Folder Machine Learning telah dikonfigurasi dengan:

- ✅ `best_rf_model.pkl` - Model Random Forest terlatih
- ✅ `le_gender.pkl` - Label encoder untuk jenis kelamin
- ✅ `le_target.pkl` - Label encoder untuk target prediksi
- ✅ `main.py` - FastAPI server

### 2️⃣ Jalankan ML API Server

```bash
# Buka terminal/PowerShell
cd C:\projectsc\Machine Learning SC (3)

# Jalankan server FastAPI
python main.py
```

**Output yang diharapkan:**

```
Uvicorn running on http://0.0.0.0:8001
```

Server akan siap menerima request pada: `http://localhost:8001`

### 3️⃣ Jalankan Laravel Application

Di terminal lain, jalankan:

```bash
cd c:\laragon\www\Prediksi-Stunting

# Option A: Menggunakan Laragon (recommended)
# Buka http://localhost/Prediksi-Stunting

# Option B: Menggunakan built-in PHP server
php artisan serve
# Buka http://localhost:8000
```

### 4️⃣ Test Halaman Prediksi

1. Navigasikan ke: `http://localhost/Prediksi-Stunting/prediksi` (atau sesuai konfigurasi)
2. Isi form dengan data sample:
    - **Jenis Kelamin**: Laki-laki
    - **Usia**: 24 bulan
    - **Berat Badan**: 12.5 kg
    - **Tinggi Badan**: 85 cm
3. Klik "Mulai Prediksi Sekarang"
4. Tunggu hasil analisis

---

## 🔄 Alur Kerja Sistem

```
┌─────────────────┐
│  User Interface │
│  (prediksi.php) │
└────────┬────────┘
         │ Form Submit
         ↓
┌─────────────────────────────────────┐
│  Laravel Backend                    │
│  (GuestPrediksiController.php)      │
│  - Validasi input                   │
│  - Siapkan data untuk ML API        │
└────────┬────────────────────────────┘
         │ HTTP POST
         ↓
┌──────────────────────────────────┐
│  FastAPI ML Server (:8001)       │
│  (main.py)                       │
│  - Model: Random Forest + SMOTE  │
│  - Prediksi: Normal/Pendek/...  │
└────────┬─────────────────────────┘
         │ JSON Response
         ↓
┌──────────────────────────────────┐
│  Backend Response Mapping        │
│  - Normal → Risiko Rendah        │
│  - Pendek → Risiko Sedang        │
│  - Sangat Pendek → Risiko Tinggi │
└────────┬─────────────────────────┘
         │ JSON Response
         ↓
┌─────────────────────────────────┐
│  Frontend Display               │
│  - Gauge indicator              │
│  - Status badge                 │
│  - Rekomendasi action           │
└─────────────────────────────────┘
```

---

## 📊 Kategori Hasil Prediksi

| Output ML      | Kategori UI   | Warna   | Rekomendasi                        |
| -------------- | ------------- | ------- | ---------------------------------- |
| Normal, Tinggi | Risiko Rendah | Emerald | Lanjutkan nutrisi seimbang         |
| Pendek         | Risiko Sedang | Yellow  | Konsultasi ke tenaga kesehatan     |
| Sangat Pendek  | Risiko Tinggi | Red     | Segera periksa ke dokter spesialis |

---

## 🔧 File yang Telah Dimodifikasi

### 1. `/resources/views/prediksi.blade.php`

- ✏️ Mengubah struktur form (4 input saja)
- ✏️ Menyederhanakan JavaScript untuk response handling
- ✏️ Menghapus logika if-else yang kompleks

### 2. `/app/Http/Controllers/GuestPrediksiController.php`

- ✏️ Validasi field sesuai form baru (`berat_badan_kg`, `tinggi_badan_cm`)
- ✏️ API call ke FastAPI di `:8001/predict`
- ✏️ Response mapping function untuk kategori

### 3. `/.env`

- ✏️ Tambahan: `ML_API_URL=http://127.0.0.1:8001`

---

## ⚠️ Troubleshooting

### ❌ "Gagal menghubungi server prediksi"

**Solusi**: Pastikan ML API server sudah dijalankan

```bash
# Cek apakah server berjalan
cd C:\projectsc\Machine Learning SC (3)
python main.py
```

### ❌ "Error 419 - Token CSRF mismatch"

**Solusi**: Refresh halaman, CSRF token mungkin expired

### ❌ "Model belum siap dimuat"

**Solusi**: Pastikan semua file .pkl ada di folder ML:

- `best_rf_model.pkl`
- `le_gender.pkl`
- `le_target.pkl`

### ❌ "Database connection error"

**Solusi**: Pastikan MongoDB sudah running:

```bash
# Di Laragon, MongoDB biasanya sudah ter-setup
# Atau jalankan manual jika perlu
```

---

## 📝 Input Validasi

Sistem akan menolak input jika:

- ❌ Jenis Kelamin bukan "Laki-laki" atau "Perempuan"
- ❌ Usia < 0 atau > 60 bulan
- ❌ Berat Badan <= 0
- ❌ Tinggi Badan <= 0

---

## 🎯 Next Steps (Optional Enhancements)

1. **Simpan Historis Prediksi**: Simpan ke database setiap prediksi
2. **Export Report**: Generate PDF/Excel dari hasil prediksi
3. **Multi-language**: Support bahasa Indonesia/Inggris
4. **Mobile App**: Port ke aplikasi mobile native
5. **Real-time Dashboard**: Admin dashboard untuk tracking kasus

---

## 📞 Dukungan Teknis

- **Framework**: Laravel 11 + FastAPI + Random Forest ML
- **Database**: MongoDB
- **Frontend**: Blade templates + TailwindCSS + JavaScript
- **ML Model**: Random Forest with SMOTE balancing

**Dibuat**: Mei 2026
**Status**: Active & Production Ready ✅
