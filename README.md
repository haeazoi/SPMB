# SPMB (Laravel)

Aplikasi **Sistem Penerimaan Murid Baru (SPMB)** berbasis Laravel.

## Prasyarat

- PHP **8.2+**
- Composer
- MySQL/MariaDB
- Node.js (opsional, jika ada kebutuhan build asset)

## Setup (Local Development)

1. Install dependency:

```bash
composer install
```

2. Buat file `.env`:

- Copy dari `.env.example` → `.env`
- Atur koneksi database (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)

3. Generate app key:

```bash
php artisan key:generate
```

4. Migrasi + seed:

```bash
php artisan migrate --seed
```

5. Storage link untuk upload:

```bash
php artisan storage:link
```

6. Jalankan server:

```bash
php artisan serve
```

App akan berjalan di `http://127.0.0.1:8000`.

## Seeder yang tersedia

Seeder ada di `database/seeders/` dan dipanggil dari `DatabaseSeeder`:

- `JurusanSeeder`
- `BajuSeeder`
- `InformasiSeeder`
- `jalurSeeder`

## Alur SPMB

### Tahap 1 — Pendaftaran awal (data ringkas)

- Siswa memilih jalur dan mengisi data inti.
- Status berkas awal: `Menunggu`.

### Tahap 2 — Seleksi berkas (TU / Superadmin)

- `Terverifikasi`: siswa boleh **Daftar Ulang**
- `Ditolak`: siswa gagal seleksi berkas

### Tahap 3 — Daftar Ulang (data lengkap + dokumen + pembayaran)

- Route siswa:
  - `GET /daftar_ulang` (form stepper)
  - `POST /daftar_ulang` (submit)
- Daftar ulang terdiri dari step:
  1. Data Siswa
  2. Data Ortu/Wali
  3. Dokumen
  4. Pembayaran

**Edit daftar ulang**:
- Siswa masih bisa edit selama pembayaran belum final (`status_bayar != Lunas` dan `status_hasil != Lulus`).
- Setelah pembayaran diverifikasi dan dinyatakan lulus, data terkunci.

### Tahap 4 — Verifikasi pembayaran (TU / Superadmin)

- Siswa upload bukti → `status_bayar = Proses Verifikasi`
- Jika disetujui → `status_bayar = Lunas` dan `status_hasil = Lulus`
- Jika ditolak → siswa bisa upload ulang bukti

## Lampiran Prestasi (multiple)

Field `lampiran_prestasi` pada `pendaftaran` menyimpan **JSON array path file**.

Accessor di model `Pendaftar`:
- `lampiran_prestasi_files` → array semua file
- `lampiran_prestasi_utama` → file pertama (kompatibilitas tampilan lama)

## WhatsApp Notification

Notifikasi WA dikirim via service `app/Services/WhatsAppNotificationService.php`.

Konfigurasi ada di `.env`:

```env
WHATSAPP_ENABLED=true
WHATSAPP_API_URL=https://api.fonnte.com/send
WHATSAPP_TOKEN=ISI_TOKEN_DEVICE_FONNTE
```

Catatan:
- Untuk Fonnte, gunakan **token device** yang sudah connect ke WhatsApp.
- Log pengiriman ada di `storage/logs/laravel.log` dengan keyword:
  - `WhatsApp send dipanggil`
  - `WhatsApp API sukses`
  - `WhatsApp API gagal`

## Troubleshooting

- **Config tidak kebaca setelah ubah `.env`**:

```bash
php artisan config:clear
```

## Lisensi

Internal project.
