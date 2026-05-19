# 🚀 QUICK START GUIDE - Machine Learning Integration

## ⚡ 30-Second Setup

```bash
# Terminal 1: Start ML Server
cd C:\projectsc\Machine Learning SC (3)
python main.py

# Terminal 2: Start Laravel (optional, if not using Laragon)
cd c:\laragon\www\Prediksi-Stunting
php artisan serve
```

**Then open**: `http://localhost/Prediksi-Stunting/prediksi`

---

## 📝 Form (4 Fields Only)

```
┌─────────────────────────────────┐
│  Jenis Kelamin (required)       │
│  ○ Laki-laki  ○ Perempuan     │
├─────────────────────────────────┤
│  Usia (bulan)                   │
│  [____] (0-60)                  │
├─────────────────────────────────┤
│  Berat Badan (kg)               │
│  [____] (e.g. 12.5)             │
├─────────────────────────────────┤
│  Tinggi Badan (cm)              │
│  [____] (e.g. 85.5)             │
├─────────────────────────────────┤
│  [Mulai Prediksi Sekarang →]   │
└─────────────────────────────────┘
```

---

## 🎯 Results

### Green ✅ (Risiko Rendah)

```
Hasil: Normal / Tinggi
Saran: Lanjutkan nutrisi seimbang
```

### Yellow ⚠️ (Risiko Sedang)

```
Hasil: Pendek
Saran: Konsultasi ke tenaga kesehatan
```

### Red 🔴 (Risiko Tinggi)

```
Hasil: Sangat Pendek
Saran: Segera periksa ke dokter spesialis
```

---

## 🔗 URLs

| Purpose       | URL                                           |
| ------------- | --------------------------------------------- |
| Prediksi Form | `http://localhost/Prediksi-Stunting/prediksi` |
| ML API        | `http://localhost:8001`                       |
| ML API Docs   | `http://localhost:8001/docs`                  |
| ML Health     | `http://localhost:8001`                       |

---

## 📋 Test Data

**Valid Input Example**:

```
Jenis Kelamin: Laki-laki
Usia: 24 bulan
Berat Badan: 12.5 kg
Tinggi Badan: 85 cm
```

**Expected Result**: Normal / Risiko Rendah (Green)

---

## ❌ Common Errors

| Error                      | Fix                                   |
| -------------------------- | ------------------------------------- |
| "Gagal menghubungi server" | Start ML: `python main.py`            |
| "Invalid gender"           | Use exact: "Laki-laki" or "Perempuan" |
| "Port 8001 in use"         | Kill process or use different port    |
| "Token mismatch"           | Refresh page                          |

---

## 📊 Files Modified

```
✏️  prediksi.blade.php       - Form simplified, JS updated
✏️  GuestPrediksiController.php - Field names updated
✏️  .env                     - Added ML_API_URL
📄 SETUP_GUIDE_ML.md        - Complete guide (NEW)
📄 INTEGRATION_SUMMARY.md   - Architecture overview (NEW)
📄 README.md                - ML API documentation (NEW)
```

---

## 🎪 Architecture in a Nutshell

```
User Form (4 inputs)
        ↓
Laravel Backend (validate & call ML)
        ↓
FastAPI ML Server (predict)
        ↓
Backend Maps Response (category)
        ↓
Frontend Shows Result (gauge + badge)
```

---

## 🔐 Security

✅ CSRF Protected  
✅ Input Validated  
✅ Error Handled  
⚠️ No Authentication (public endpoint)

---

## ⚙️ Configuration

**.env**:

```env
ML_API_URL=http://127.0.0.1:8001
```

**main.py** (ML):

```python
uvicorn.run("main:app", host="0.0.0.0", port=8001)
```

---

## 📞 Support

1. Check `SETUP_GUIDE_ML.md` for detailed guide
2. Check ML `README.md` for API details
3. Check `INTEGRATION_SUMMARY.md` for architecture
4. Test via Swagger: `http://localhost:8001/docs`

---

## ✨ What Changed

| Aspect        | Before     | After                |
| ------------- | ---------- | -------------------- |
| Form Fields   | 6          | **4** ✅             |
| If-Else Logic | Complex    | **Removed** ✅       |
| API           | None       | **FastAPI** ✅       |
| Model         | Local calc | **Random Forest** ✅ |
| Response      | Complex    | **Simple** ✅        |

---

## 🎯 Status: READY ✅

**All systems go!**

- Frontend: ✅
- Backend: ✅
- ML Model: ✅
- Documentation: ✅

**Start servers and test now!** 🚀
