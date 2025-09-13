<h1 align="center"># 📦 Supply Chain Management (SCM) System</h1> 
<p align="center">
Sistem SCM ini dibangun menggunakan **Laravel 11**, **Vue 3 (Inertia.js + Vite)**, dan **TailwindCSS**.  
Tujuan sistem ini adalah untuk membantu perusahaan dalam mengelola **supplier, barang, transaksi barang masuk & keluar, serta laporan stok** secara efisien.
</p>

## 🚀 Fitur Utama

-   **Authentication & Role**
    -   Login & Logout
    -   Role: Admin & Karyawan (UI menyesuaikan role)
-   **Master Data**
    -   CRUD Supplier
    -   CRUD Barang (dengan harga, stok minimum, dan tanggal kadaluarsa)
-   **Transaksi**
    -   CRUD Barang Masuk (Incoming Goods) → update stok otomatis
    -   CRUD Barang Keluar (Outgoing Goods) → update stok otomatis
-   **Dashboard**
    -   Total Supplier, Barang, Barang Masuk, Barang Keluar
    -   Alert otomatis untuk stok minimum & barang mendekati kadaluarsa
    -   Ringkasan barang dengan stok menipis dan hampir expired
-   **UX Enhancement**
    -   SweetAlert2 untuk konfirmasi & alert
    -   Toast notification untuk feedback CRUD
-   **Laporan (Opsional Lanjutan)**
    -   Laporan transaksi barang masuk/keluar
    -   Export PDF & Excel

---

## 🛠️ Tech Stack

-   **Backend**: Laravel 11
-   **Frontend**: Vue 3 + Inertia.js + Vite
-   **Styling**: TailwindCSS
-   **Database**: MySQL / MariaDB
-   **Authentication**: Laravel Breeze (Vue preset)
-   **Notification**: SweetAlert2 + Toast

---

## 📂 Struktur Fitur Utama

- /app
- /Models
- /Http/Controllers
- /resources/js/Pages
- /Suppliers (CRUD Supplier)
- /Items (CRUD Barang + Alert)
- /IncomingGoods (Barang Masuk)
- /OutgoingGoods (Barang Keluar)
- /Dashboard.vue

👥 Roles & Akses

## Admin

<p>Kelola supplier, barang, transaksi, laporan</p>

## Karyawan

<p>Input barang masuk & barang keluar</p>
