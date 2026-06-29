# E-Inventory Management System

## Deskripsi

E-Inventory Management System merupakan aplikasi berbasis web yang dikembangkan sebagai proyek **Ujian Akhir Semester (UAS)** mata kuliah **Pemrograman Web 2**. Aplikasi ini bertujuan untuk membantu proses pengelolaan data inventaris barang secara digital sehingga proses pencatatan, pencarian, dan pengelolaan data menjadi lebih mudah, cepat, dan efisien.

Aplikasi dibangun menggunakan konsep **Single Page Application (SPA)** dengan **Vue.js 3** sebagai Frontend dan **CodeIgniter 4** sebagai Backend REST API. Data disimpan menggunakan database **MySQL** dan komunikasi antara frontend dan backend dilakukan melalui REST API.

---

# Status Project

| Komponen                 | Status                       |
| ------------------------ | ---------------------------- |
| Frontend Vue.js          | ✅ Selesai                    |
| Backend CodeIgniter 4    | ✅ Selesai                    |
| REST API                 | ✅ Berjalan pada Localhost    |
| Database MySQL           | ✅ Berjalan                   |
| GitHub Repository        | ✅ Selesai                    |
| Deploy Frontend (Vercel) | ✅ Berhasil                   |
| Deploy Backend (Railway) | ⚠️ Terkendala Runtime Apache |

---

# Demo

## Frontend

https://uas-web2-one.vercel.app

## Backend

Backend telah dikonfigurasi untuk deployment menggunakan Railway. Proses build Docker berhasil dilakukan, namun hingga tahap akhir masih terdapat kendala pada konfigurasi runtime Apache sehingga service belum dapat diakses secara publik.

---

# Fitur

## Dashboard

* Menampilkan ringkasan data inventaris
* Menampilkan statistik jumlah barang
* Informasi stok barang

## Manajemen Barang

* Menampilkan daftar barang
* Menambahkan barang
* Mengubah data barang
* Menghapus data barang
* Pencarian barang

## Manajemen Kategori

* CRUD kategori barang

## Manajemen Supplier

* CRUD supplier

## Manajemen User

* Login
* Logout
* Autentikasi menggunakan REST API

---

# Teknologi

## Frontend

* Vue.js 3
* Vue Router
* Axios
* Vite
* HTML
* CSS
* JavaScript

## Backend

* CodeIgniter 4
* PHP 8
* REST API

## Database

* MySQL

## Deployment

### Frontend

* Vercel

### Backend

* Railway
* Docker

---

# Struktur Project

```
UAS_Web2
│
├── backend-api/
│   ├── app/
│   ├── public/
│   ├── writable/
│   ├── composer.json
│   ├── Dockerfile
│   └── spark
│
├── frontend-spa/
│   ├── src/
│   ├── public/
│   ├── package.json
│   └── vite.config.js
│
├── README.md
├── Context.md
└── Tasks.md
```

---

# Instalasi

## Clone Repository

```bash
git clone https://github.com/MhmdHfyxnll/UAS_Web2.git

cd UAS_Web2
```

---

# Backend Installation

Masuk ke folder backend

```bash
cd backend-api
```

Install dependency

```bash
composer install
```

Salin file environment

```bash
cp env .env
```

Atur konfigurasi database pada file `.env`

```env
database.default.hostname = localhost
database.default.database = inventory
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

Jalankan server

```bash
php spark serve
```

Backend berjalan pada

```
http://localhost:8080
```

---

# Frontend Installation

Masuk ke folder frontend

```bash
cd frontend-spa
```

Install dependency

```bash
npm install
```

Jalankan project

```bash
npm run dev
```

Frontend berjalan pada

```
http://localhost:5173
```

---

# API Endpoint

## Login

```
POST /login
```

## Barang

```
GET /barang

POST /barang

PUT /barang/{id}

DELETE /barang/{id}
```

## Kategori

```
GET /kategori

POST /kategori

PUT /kategori/{id}

DELETE /kategori/{id}
```

## Supplier

```
GET /supplier

POST /supplier

PUT /supplier/{id}

DELETE /supplier/{id}
```

---

# Database

Database menggunakan MySQL.

### Tabel Utama

* users
* barang
* kategori
* supplier

### Relasi

```
Kategori
     │
     │
 Barang
     │
     │
 Supplier
```

---

# Deployment

## Frontend

Frontend berhasil dideploy menggunakan **Vercel** dan dapat diakses melalui:

https://uas-web2-one.vercel.app

## Backend

Backend dikonfigurasi menggunakan **Railway** dengan Docker.

Proses deployment berhasil melewati tahap build, namun service mengalami crash ketika runtime sehingga API belum dapat diakses secara publik.

---

# Kendala Selama Deployment

Selama proses deployment backend ke Railway ditemukan beberapa kendala teknis, di antaranya:

* Railway awalnya tidak dapat mendeteksi project karena struktur repository menggunakan monorepo (`frontend-spa` dan `backend-api`).
* Root Directory perlu diarahkan ke folder `backend-api`.
* Dependency PHP `ext-intl` yang dibutuhkan CodeIgniter 4 belum tersedia sehingga proses Composer gagal.
* Dockerfile perlu disesuaikan agar menginstal extension PHP seperti `intl`, `mysqli`, `pdo_mysql`, dan `zip`.
* Apache DocumentRoot harus diarahkan ke folder `public`.
* Setelah proses build berhasil, container mengalami runtime error dengan pesan:

```
AH00534: apache2: Configuration error: More than one MPM loaded.
```

Akibatnya backend belum dapat berjalan secara publik meskipun source code, REST API, serta seluruh fitur aplikasi telah berjalan dengan baik pada lingkungan lokal (localhost).

---

# Pengujian

Pengujian dilakukan pada lingkungan lokal menggunakan:

* PHP 8
* Apache
* MySQL
* CodeIgniter 4
* Vue.js 3

Hasil pengujian menunjukkan bahwa:

* Login berhasil
* CRUD Barang berhasil
* CRUD Kategori berhasil
* CRUD Supplier berhasil
* REST API berjalan dengan baik
* Integrasi Frontend dan Backend berjalan normal pada localhost

---

# Repository

GitHub

https://github.com/MhmdHfyxnll/UAS_Web2

Frontend (Vercel)

https://uas-web2-one.vercel.app

---

# Screenshot

## Login

<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/02186949-eb21-41f6-9c35-52b071107d08" />


## Dashboard
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/5fcd83d4-af76-400b-ac84-38bf394979d0" />


## Barang

<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/615d1567-9e7f-40f1-a2d3-d284d205be74" />


## Kategori

<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/5160a2ff-b846-45f6-b448-092ecc5258a1" />


## Supplier

<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/1952670b-e468-4fe0-a8a3-ae3a3b66aa82" />


# Lisensi

Project ini dibuat untuk memenuhi tugas **Ujian Akhir Semester (UAS)** mata kuliah **Pemrograman Web 2**.

© 2026
