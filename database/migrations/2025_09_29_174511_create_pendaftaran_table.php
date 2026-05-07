<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran')->unique()->foreign('no_pendaftaran') // Kolom di tabel users
                ->references(columns: 'no_pendaftaran') // Kolom yang dituju di tabel pendaftaran
                ->on('users') // Nama tabel yang dituju
                ->onDelete('set null');
            $table->integer('id_jalur');
            $table->string('nisn', 10)->unique();
            $table->string('nik', 16)->unique()->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->integer('id_jurusan');
            $table->string('foto')->nullable();
            $table->string('tempat_lahir');
            $table->enum('agama', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('kewarganegaraan', ['WNI', 'WNA'])->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->text('alamat');
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota_kab')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('sekolah');
            $table->string('kip')->nullable();
            $table->string('telp_rumah', 15)->nullable();
            $table->string('no_hp', 15);
            $table->string('kebutuhan_khusus')->nullable();
            $table->enum('jarak', ['Kurang', 'Lebih'])->nullable();
            $table->enum('jenis_tinggal', ['Orang Tua', 'Wali', 'Sendiri'])->nullable();
            $table->integer('id_baju')->nullable();
            $table->enum('transportasi', ['Jalan Kaki', 'Sepeda', 'Motor', 'Mobil', 'Transportasi Umum'])->nullable();
            $table->integer('id_info');
            $table->enum('status_berkas', ['Menunggu', 'Terverifikasi', 'Ditolak'])->default('Menunggu');
            $table->date('tanggal_pendaftaran');

            $table->string('nama_ayah');
            $table->string('no_hp_ayah', 15);
            $table->enum('agama_ayah', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])->nullable();
            $table->enum('kewarganegaraan_ayah', ['WNI', 'WNA'])->nullable();
            $table->enum('pendidikan_ayah', ['SD', 'SMP', 'SMA', 'S1', 'S2'])->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->enum('penghasilan_ayah', ['0', '100', '200', '500', '1000', '1500'])->nullable();
            $table->enum('status_ayah', ['Wafat', 'Hidup'])->nullable();
            $table->string('ktp_ayah')->nullable();

            $table->string('nama_ibu');
            $table->string('no_hp_ibu', 15);
            $table->enum('agama_ibu', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])->nullable();
            $table->enum('kewarganegaraan_ibu', ['WNI', 'WNA'])->nullable();
            $table->enum('pendidikan_ibu', ['SD', 'SMP', 'SMA', 'S1', 'S2'])->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->enum('penghasilan_ibu', ['0', '100', '200', '500', '1000', '1500'])->nullable();
            $table->enum('status_ibu', ['Wafat', 'Hidup'])->nullable();
            $table->string('ktp_ibu')->nullable();

            $table->string('nama_wali')->nullable();
            $table->string('no_hp_wali', 15)->nullable();
            $table->string('penghasilan_wali')->nullable();
            $table->string('ktp_wali')->nullable();

            $table->string('lampiran_prestasi')->nullable();
            $table->string('undangan')->nullable();
            $table->string('akte')->nullable();
            $table->string('suratbaik')->nullable();
            $table->string('suratlulus')->nullable();
            $table->string('rapor')->nullable();
            $table->string('kk')->nullable();
            
            $table->string('alasan')->nullable();

            $table->timestamps();
        });

        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pendaftar');
            $table->dateTime('tgl_terbit');
            $table->enum('status_hasil', ['Menunggu', 'Lulus', 'Tidak Lulus'])->default('Menunggu');
            $table->enum('status_bayar', ['Belum Bayar', 'Proses Verifikasi', 'Lunas', 'Dibatalkan'])->default('Belum Bayar');
            $table->date('tanggal_pembayaran')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });

        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jurusan');
            $table->timestamps();
        });

        Schema::create('jalur', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jalur');
            $table->string('biaya');
            $table->string('deskripsi');
            $table->timestamps();
        });

        Schema::create('baju', function (Blueprint $table) {
            $table->id();
            $table->string('ukuran_baju');
            $table->timestamps();
        });

        Schema::create('informasi', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
        Schema::dropIfExists('jalur');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('jurusan');
        Schema::dropIfExists('baju');
        Schema::dropIfExists('informasi');
    }
};
