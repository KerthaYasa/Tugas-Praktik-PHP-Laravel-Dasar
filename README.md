<!-- Header -->
<p align="center">
  <img src="https://laravel.com/img/logomark.min.svg" width="90" alt="Laravel Logo">
</p>

<h1 align="center">🎓 Tugas Praktik PHP Laravel Dasar — Kampus APP</h1>

<p align="center">
  Aplikasi CRUD sederhana menggunakan <b>Laravel</b> untuk pengelolaan data mahasiswa.<br>
  <i>Disusun sebagai tugas mata kuliah Pemrograman Internet (Laravel Dasar)</i>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8+-777BB4?logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Database-SQLite%20%7C%20MySQL-003B57?logo=database&logoColor=white" alt="Database">
</p>

---

## 🚀 **Fitur Utama**

✨ CRUD Mahasiswa (Create, Read, Update, Delete)  
✨ Validasi input data dengan Laravel Validation  
✨ Fitur pencarian data mahasiswa  
✨ Pagination otomatis  
✨ Nomor urut dinamis walau data dihapus  
✨ Modal konfirmasi hapus menggunakan Bootstrap  
✨ Desain modern, clean, dan responsif dengan **Bootstrap 5**

---

## 🧩 **Teknologi yang Digunakan**

| Komponen | Keterangan |
|-----------|-------------|
| 🧠 **Framework** | Laravel 10 |
| 🧮 **Bahasa** | PHP 8+ |
| 🎨 **Frontend** | Bootstrap 5, Blade Template |
| 💾 **Database** | SQLite / MySQL |
| ⚙️ **Tools** | Composer, Artisan CLI |
| 🧰 **Server** | PHP Built-in (`php artisan serve`) |

---

## ⚙️ **Langkah Menjalankan Project**

1️⃣ **Clone Repository**
```bash
git clone https://github.com/KerthaYasa/Tugas-Praktik-PHP-Laravel-Dasar.git
cd Tugas-Praktik-PHP-Laravel-Dasar

```

### 2️⃣ **Install Dependency**
```bash
composer install
```

### 3️⃣ **Salin & Konfigurasi File `.env`**
```bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ **Atur Database**

#### 🧱 **Opsi A: SQLite (tanpa XAMPP)**
Tambahkan konfigurasi berikut di file `.env`:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```
💡 Buat file kosong bernama `database.sqlite` di folder `/database`.

#### 💻 **Opsi B: MySQL (pakai XAMPP)**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kampus
DB_USERNAME=root
DB_PASSWORD=
```

### 5️⃣ **Migrasi Database**
```bash
php artisan migrate
```

### 6️⃣ **Jalankan Server**
```bash
php artisan serve
```

💡 **Buka di browser:**  
👉 [http://127.0.0.1:8000/mahasiswa](http://127.0.0.1:8000/mahasiswa)

---

## 👤 **Informasi Mahasiswa**

| Informasi | Keterangan |
|-----------|------------|
| **Nama** | I Komang Cahya Kertha Yasa |
| **NIM** | 2405551034 |
| **Kelas** | Pemrograman Internet B |
| **Dosen Pengampu** | Ir. I Nyoman Piarsa, ST., MT., IPM. |

---

## 💡 **Catatan Tambahan**

- 🧭 Project ini dikembangkan dengan pendekatan **MVC (Model–View–Controller)** sepenuhnya
- 🧱 Tampilan didesain dengan UI/UX modern, menggunakan Bootstrap Icons dan modal interaktif
- 🧩 Dapat dijalankan tanpa XAMPP jika menggunakan SQLite
- 🌐 Cocok untuk pembelajaran dasar Laravel dan portofolio pribadi

---
