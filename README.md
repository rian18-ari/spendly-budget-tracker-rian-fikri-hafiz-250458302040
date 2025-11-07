# 🚀 Spendly

**Spendly** adalah aplikasi manajemen pengeluaran dan pemantauan anggaran dinas (budget *travelling*) berbasis web yang dibangun menggunakan **TALL Stack** (Tailwind CSS, Alpine.js, Laravel, Livewire). Spendly dirancang untuk memberikan visibilitas penuh kepada tim administrasi dalam mengelola dan melacak anggaran karyawan secara *real-time*.

## ✨ Fitur Utama

* **Manajemen Anggaran (Budget Allocation):** Admin dapat menugaskan anggaran (budget) spesifik ke satu atau lebih karyawan untuk periode dinas tertentu.
* **Pemantauan Real-time:** Melacak pengeluaran karyawan secara instan berkat teknologi Livewire, memungkinkan deteksi dini potensi *overspending*.
* **Manajemen Pengeluaran (Transaksi):** Karyawan dapat mencatat transaksi pengeluaran dinas mereka dengan detail (nominal, keterangan, tanggal).
* **Laporan Finansial:** Menghasilkan laporan terperinci berdasarkan budget, periode waktu, atau pengguna, yang memudahkan rekonsiliasi dan audit keuangan.
* **Otentikasi Berbasis Peran (Role-Based Auth):** Memisahkan akses antara pengguna **Admin** dan **Karyawan**.

## 💻 Teknologi yang Digunakan

Spendly dibangun di atas fondasi modern dan *reactive* dari TALL Stack:

| Teknologi | Peran dalam Spendly |
| :--- | :--- |
| **Laravel** (Backend) | Framework PHP yang tangguh dan elegan untuk logika bisnis dan API. |
| **Livewire** (Frontend Reactive) | Membuat antarmuka pengguna yang dinamis dan *reactive* tanpa menulis banyak JavaScript. |
| **Alpine.js** (Interaksi Frontend) | Menangani interaktivitas DOM minimal dan ringan. |
| **Tailwind CSS** (Styling) | Kerangka kerja CSS utilitas-pertama untuk desain yang cepat dan konsisten. |

## 📦 Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan Spendly di lingkungan lokal kamu:

### Persyaratan

Pastikan kamu telah menginstal:
* PHP (>= 8.1)
* Composer
* Node.js & NPM
* Database (MySQL, PostgreSQL, atau SQLite)

### Langkah-langkah

1.  **Clone Repositori:**
    ```bash
    git clone [LINK_REPO_KAMU]
    cd spendly
    ```

2.  **Instal Dependensi PHP:**
    ```bash
    composer install
    ```

3.  **Konfigurasi Lingkungan:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Edit file `.env` dan atur kredensial database.*

4.  **Instal Dependensi Frontend & Build Aset:**
    ```bash
    npm install
    npm run dev  # Gunakan npm run watch untuk pengembangan
    ```

5.  **Migrasi Database:**
    ```bash
    php artisan migrate
    ```

6.  **Seeder (Opsional):**
    *Untuk mengisi data awal (misalnya, akun Admin default), jalankan:*
    ```bash
    php artisan db:seed
    ```

7.  **Jalankan Aplikasi:**
    ```bash
    php artisan serve
    ```
    Aplikasi Spendly kini harus dapat diakses di `http://127.0.0.1:8000`.

## 🤝 Kontribusi

Kami menyambut kontribusi! Jika kamu menemukan *bug* atau memiliki ide fitur baru, silakan:
1.  *Fork* repositori ini.
2.  Buat *branch* baru (`git checkout -b fitur/nama-fitur`).
3.  Lakukan *commit* perubahan (`git commit -m 'Tambahkan Fitur X'`).
4.  *Push* ke *branch* (`git push origin fitur/nama-fitur`).
5.  Buka *Pull Request* (PR).
  
## ⚠️ Catatan / Disclaimer

CMIIW (Correct Me If I'm Wrong) 😅 Spendly masih dalam tahap **pengembangan**.  
Masih banyak hal yang bisa diperbaiki, fitur yang bisa ditambah, dan bug yang mungkin muncul.  

Jadi kalau kamu pakai atau mau kontribusi:  

- Semua masukan & PR **sangat welcome**!  
- Jangan kaget kalau ada beberapa fitur yang belum 100% rampung.  
- Tujuan utama: belajar bareng, kolaborasi, dan bikin Spendly makin kece! 🎉  

Kalau nemu bug atau ide keren, langsung buka **issue** atau **pull request**.  
Semakin banyak kontribusi, semakin mantul aplikasi ini! 🚀

   
---
