# Panduan Kontribusi

Terima kasih telah tertarik untuk berkontribusi pada **Manufacture System**! 🎉  
Kami sangat menghargai setiap bentuk kontribusi, baik itu perbaikan bug, penambahan fitur, maupun peningkatan dokumentasi.

---

## Cara Berkontribusi

1. **Fork Repository**
   - Klik tombol **Fork** di kanan atas halaman repository ini.
   - Repository akan tersalin ke akun GitHub kamu.

2. **Clone Repository**
   ```bash
   git clone https://github.com/<username>/manufacture-system.git
   cd manufacture-system

3. **Buat branch baru**
   ```Gunakan nama branch yang deskriptif untuk fitur atau perbaikan bug
   git checkout -b fitur/nama-fitur-baru

   git checkout -b fitur/tambah-authentication

4. **Install Dependencies**
   ```Pastikan sudah terinstall PHP, COmposer, dan Laravel
   composer install
   cp .env.example .env
   php artisan key:generate
5. **Push ke repository Fork**
   ```Tambahkan fitur, perbaiki bug, atau update dokumentasi sesuai kebutuhan.
   git add .
   git commit -m "Add fitur X/Fix bug Y"

6. **Commit perubahan**
   ```
   git push origin fitur/nama-fitur-baru

7. Buat pull Request (PR)
   ```
   - Masuk ke halaman github repository utama.
   - Klik New Pull Request dan jelaskan perubahan yang dibuat.

8. Aturan kontribusi
   - Gunakan bahasa yang jelas pada commit message.
   - Pastikan tidak ada error sebelum membuat PR:
     ```
     php artisan serve
     php artisan test
    - Diskusikan fitur besar melalui Issues sebelum mengerjakan.
    - DOkumentasikan kode atau fitur yang kamu tambahkan.



  **Tanya & DIskusi**
  Jika ada yang kurang jelas, silakan buka Issue di repository ini atau hubungi maintainer.

  Selamat berkontribusi!
