# MiniPOS [Mini Projek BE]

API untuk aplikasi POS sederhana yang mengelola data barang, pelanggan, dan transaksi penjualan.

## Live Access

- **Base URL:** https://jmiryas.my.id/api/v1
- **Frontend:** https://mini-pos-tawny.vercel.app

## Tech Stack

- **Framework:** Laravel 11
- **Database:** MySQL

## Main Features

- **Master Data:** CRUD Barang & Customers.
- **Transactions:** Pencatatan transaksi penjualan.
- **Reporting:** Dashboard ringkasan data penjualan.

## API Documentation

Dokumentasi endpoint lengkap tersedia dalam format Postman Collection:

- **File:** `Mini Projek BE.json` (Impor file ini ke Postman untuk melihat detail request/response).

## Installation

1. **Persiapan:**
    - Clone projek.
    - Buka terminal di dalam folder projek tersebut.

2. **Install & Setup:**
    - Jalankan `composer install`
    - Salin `.env.example` menjadi `.env`
    - Jalankan `php artisan key:generate`

3. **Database:**
    - Buat database baru di MySQL lokal.
    - Sesuaikan konfigurasi database di file `.env`.
    - Jalankan `php artisan migrate --seed`

4. **Run Server:**
    - Jalankan `php artisan serve`
