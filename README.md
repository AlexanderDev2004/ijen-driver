Website Ijen Driver adalah website untuk melakukan pemesanan Tour melalui form yang bersedia misal nama, email, telpon, berapa orang, tanggal berapa, Bawa Anak. setelah melakukan form akan di cek kembali dan bisa di edit jika sudah mengubah form atau tidak ada maka akan menekan tombol Kirim maka akan di bawah di arahkan di wa dan akan menirimkan pesan sesuai form dan mereka akan berdiksusi lebih lanjut dan selain dapat memesan Tour para wisatawan Bisa melihat Hasil dari perjalanan sebelumnya. 

# Technology
- PHP
- Laravel
- TailwindCSS
- mysql
- whatsapp

# FEATURES

- [x]  Menambahkan Login Admin
- [x]  Membuat Dashboard Admin
- [x]  membuat Dashboard Public
- [x]  membuat CRUD Tour

# BUGS, Error, And FIX

- [x]  Memperbaiki Bug Toggle Aktif Tour
- [x]  Memperbaiki Database di Tour di bagian delete_at (Karena Tidak di butuhkan)
- [x]  Menambahkan Toggle visibilitas harga Tour sesuai kondisi
- [x]  Fixing UI Responsive

# CI/CD (Analysis & Setup)

## Hasil Analisis Sebelum Membuat CI/CD
- Project berbasis Laravel 12 dengan requirement PHP `^8.2`.
- Build frontend menggunakan Vite (`npm run build`).
- Test menggunakan PHPUnit, environment testing diarahkan ke MySQL.
- Risiko utama pipeline: service MySQL harus ready sebelum migrate/test berjalan.
- Deployment target belum didefinisikan secara hardcoded, jadi CD dibuat aman berbasis secrets.

## Workflow yang Dibuat
- CI: `.github/workflows/ci.yml`
	- Trigger: `push` ke `main/master/develop` dan `pull_request`.
	- Langkah: setup PHP 8.2 + `pdo_mysql`, jalankan service MySQL, setup env Laravel, migrate DB testing MySQL, jalankan PHPUnit, build Vite, upload artifact `public/build`.

- CD: `.github/workflows/cd.yml`
	- Trigger: `workflow_dispatch` dan push tag `v*`.
	- Langkah: validasi secrets, build release, rsync ke server, lalu `php artisan migrate --force`, `config:cache`, `route:cache`, `view:cache`.

## Secrets Wajib untuk CD
- `DEPLOY_HOST`
- `DEPLOY_USER`
- `DEPLOY_PATH`
- `DEPLOY_SSH_KEY`

## Secrets Wajib untuk CI (MySQL)
- `CI_DB_DATABASE`
- `CI_DB_USERNAME`
- `CI_DB_PASSWORD`

Tanpa secrets di atas, workflow CD akan berhenti otomatis agar tidak menimbulkan deploy yang setengah jalan.
