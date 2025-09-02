# Manufacture System

Sistem manufaktur berbasis Laravel untuk manajemen *materials*, *products*, produksi, dan operasional gudang.

##  Fitur Utama
- Manajemen **Materials** (CRUD, stok, minimal stock)
- Manajemen **Products** (CRUD, harga jual, SKU, unit)
- Relasi **Produk ↔ Bahan Baku**
- Laporkan stok bahan baku rendah
- Otentikasi & proteksi akses (Laravel Breeze/Jetstream)
- Logging & validasi input

##  Instalasi

1. Clone repository  
   ```bash
   git clone https://github.com/Zikaharun/manufacture-system.git
   cd manufacture-system

   
2. ```Install dependensi PHP & JS
   composer install
   npm install && npm run dev


3. ```Setup Environment
   cp .env.example .env
# Edit .env: sesuaikan DB, APP_URL, dsb.


4. ```Generate key laravel
   php artisan key:generate

   
5. ```Jalankan migrasi dan seed
   php artisan migrate --seed

   
6. ```Mulai server
   php artisan serve

