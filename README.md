

# Ijen Driver - Tour Booking Web Application

## Deskripsi
Aplikasi web untuk pemesanan tour ke Kawah Ijen dan destinasi wisata lain. Dibangun menggunakan Laravel, dengan frontend Blade dan Tailwind CSS.

## Fitur Utama
- Formulir pemesanan tour (nama, email, telpon, jumlah orang, tanggal, bawa anak, catatan)
- Preview sebelum mengirim ke WhatsApp
- Validasi data dan pesan error
- Manajemen data trip dan user
- Migrasi database dan seeder

## Struktur Folder
- `app/` - Kode utama aplikasi (Controllers, Models, Policies, Providers)
- `resources/views/` - Blade templates untuk tampilan
- `routes/` - Definisi rute aplikasi (`web.php`, `console.php`)
- `database/` - Migrasi, seeder, dan database lokal
- `public/` - File publik (gambar, index.php, storage)
- `config/` - Konfigurasi aplikasi
- `tests/` - Unit dan feature tests

## Instalasi
1. Clone repository
2. Jalankan `composer install` untuk menginstal dependensi PHP
3. Jalankan `npm install && npm run dev` untuk frontend
4. Copy `.env.example` ke `.env` dan sesuaikan konfigurasi
5. Jalankan migrasi dan seeder:
	```powershell
	php artisan migrate --seed
	```
6. Buat symbolic link storage:
	```powershell
	php artisan storage:link
	```
7. Jalankan server lokal:
	```powershell
	php artisan serve
	```

## Cara Penggunaan
- Buka halaman utama
- Isi formulir pemesanan tour
- Klik "Review" untuk melihat ringkasan
- Edit jika perlu, lalu kirim ke WhatsApp

## Testing
- Jalankan unit dan feature test:
  ```powershell
  php artisan test
  ```

## Konfigurasi Tambahan
- Konfigurasi database di `.env`
- Konfigurasi email di `config/mail.php`

## Lisensi
Proyek ini menggunakan lisensi MIT.


