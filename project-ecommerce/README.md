# Project 1 & Project 2 - Web E-Commerce & CRUD API PT. NusaMart Digital Nusantara

## Identitas Mahasiswa
- **Nama**: Revin Erdiansyah
- **NPM / Kelas**: *(Isi NPM & Kelas Anda)*

---

## Struktur Direktori Repository
```text
project-ecommerce/
├── project-1/                  # Aplikasi Web E-Commerce (PHP, MySQL, Bootstrap 5, JS)
│   ├── css/
│   │   └── style.css
│   ├── includes/
│   │   ├── header.php
│   │   └── footer.php
│   ├── js/
│   │   └── script.js
│   ├── dashboard.php
│   ├── database.sql
│   ├── detail.php
│   ├── index.php
│   ├── koneksi.php
│   ├── login.php
│   ├── logout.php
│   └── register.php
├── project-2/                  # REST CRUD API Produk
│   └── API/
│       └── produk.php
├── Srceenshot/                 # Dokumentasi Screenshot Pengujian Web & API
│   ├── ss api/
│   └── ss web/
└── README.md
```

---

## Project 1: Web E-Commerce (PHP, MySQL, Bootstrap 5, JavaScript)

### Fitur & Halaman Utama
1. **Halaman Utama (`project-1/index.php`)**: Menampilkan profil perusahaan **PT. NusaMart Digital Nusantara** serta katalog produk yang diambil dari database MySQL (`db_nusamart`).
2. **Halaman Detail Informasi (`project-1/detail.php`)**: Menampilkan detail lengkap spesifikasi produk saat pengguna memilih salah satu item dari Halaman Utama.
3. **Halaman Login (`project-1/login.php`)**: Validasi form di sisi klien menggunakan JavaScript dengan struktur percabangan `if / else if / else` serta autentikasi akun ke database MySQL.
4. **Halaman Registrasi (`project-1/register.php`)**: Pendaftaran akun pelanggan baru ke database MySQL.
5. **Halaman Menu Utama / Dashboard (`project-1/dashboard.php`)**: Halaman utama khusus member setelah berhasil login, dilengkapi daftar produk siap pesan dan tombol logout.

### Akun Login
| Role | Username | Password |
| :--- | :--- | :--- |
| **Admin (Default)** | `admin` | `123456` |
| **User / Member** | `cihuy` | `kerjabagus` |

---

### Screenshot Hasil Project 1 (Web E-Commerce)

#### 1. Halaman Utama (`index.php`)
![Halaman Utama](Srceenshot/ss%20web/Screenshot_21-11-2026_205850_localhost.jpeg)

#### 2. Halaman Detail Informasi (`detail.php`)
![Halaman Detail](Srceenshot/ss%20web/Screenshot_21-11-2026_21028_localhost.jpeg)

#### 3. Halaman Login (`login.php`)
![Halaman Login](Srceenshot/ss%20web/Screenshot_21-11-2026_21046_localhost.jpeg)

#### 4. Halaman Registrasi (`register.php`)
![Halaman Registrasi](Srceenshot/ss%20web/Screenshot_21-11-2026_2111_localhost.jpeg)

#### 5. Halaman Menu Utama / Dashboard (`dashboard.php`)
![Halaman Dashboard](Srceenshot/ss%20web/Screenshot_21-11-2026_21128_localhost.jpeg)

---

## Project 2: REST CRUD API Produk (`project-2/API/produk.php`)

### Daftar Endpoint API
Base URL: `http://localhost/project-ecommerce/project-2/API/produk.php`

| Method | Endpoint | Keterangan |
| :--- | :--- | :--- |
| `GET` | `/produk.php` | Mengambil seluruh daftar produk dari database |
| `GET` | `/produk.php?id={id}` | Mengambil detail 1 produk berdasarkan ID |
| `POST` | `/produk.php` | Menambahkan data produk baru (Body JSON) |
| `PUT` | `/produk.php?id={id}` | Mengubah data produk berdasarkan ID (Body JSON) |
| `DELETE` | `/produk.php?id={id}` | Menghapus data produk berdasarkan ID |

---

### Screenshot Hasil Uji CRUD API (Postman / Bruno)

#### 1. GET All Produk (`GET /produk.php`)
![GET All Produk](Srceenshot/ss%20api/ss%20get.png)

#### 2. GET Detail Produk by ID (`GET /produk.php?id=...`)
![GET Detail Produk](Srceenshot/ss%20api/ss%20read.png)

#### 3. POST Create Produk (`POST /produk.php`)
![POST Create Produk](Srceenshot/ss%20api/ss%20create.png)

#### 4. PUT Update Produk (`PUT /produk.php?id=...`)
![PUT Update Produk](Srceenshot/ss%20api/ss%20update.png)

#### 5. DELETE Produk (`DELETE /produk.php?id=...`)
![DELETE Produk](Srceenshot/ss%20api/ss%20delete.png)

---

## Cara Menjalankan Project
1. Simpan folder `project-ecommerce` ke dalam direktori `htdocs` (XAMPP) atau `www` (Laragon).
2. Jalankan layanan **Apache** dan **MySQL**.
3. Import file `project-1/database.sql` ke **phpMyAdmin** / **HeidiSQL** untuk membuat database `db_nusamart`.
4. Buka web di browser melalui `http://localhost/project-ecommerce/project-1/index.php`.
5. Login menggunakan akun `cihuy` / `kerjabagus` (atau `admin` / `123456`).
6. Uji endpoint CRUD API melalui Postman / Bruno pada URL `http://localhost/project-ecommerce/project-2/API/produk.php`.