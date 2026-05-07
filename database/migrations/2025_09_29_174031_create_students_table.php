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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique();
            $table->string('nik')->unique();
            $table->string('name');
            $table->string('email');
            $table->integer('id_jurusan');
            $table->string('foto');
            $table->string('tempat_lahir');
            $table->enum('agama', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tinggi_badan');
            $table->string('berat_badan');
            $table->text('alamat');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kota_kab');
            $table->string('provinsi');
            $table->string('sekolah');
            $table->string('kip')->nullable();
            $table->string('telp_rumah')->nullable();
            $table->string('no_hp');
            $table->string('kebutuhan_khusus')->nullable();
            $table->enum('jarak', ['Kurang', 'Lebih']);
            $table->enum('jenis_tinggal', ['Orang Tua', 'Wali', 'Sendiri']);
            $table->integer('id_baju');
            $table->enum('transportasi', ['Jalan Kaki', 'Sepeda', 'Motor', 'Mobil', 'Transportasi Umum']);
            
            $table->string('lampiran_prestasi')->nullable();
            $table->string('undangan')->nullable();
            $table->string('akte');
            $table->string('suratbaik');
            $table->string('suratlulus');
            $table->string('rapor');
            $table->string('kk');
            
            $table->enum('status_aktif', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->enum('kelas', ['10', '11', '12'])->default('10');

            $table->timestamps();
        });

        Schema::create('orangtua_siswa', function (Blueprint $table) {
            $table->id();
            $table->integer('id_siswa');

             $table->string('nama_ayah');
            $table->string('no_hp_ayah', 15);
            $table->enum('agama_ayah', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('kewarganegaraan_ayah', ['WNI', 'WNA']);
            $table->enum('pendidikan_ayah', ['SD', 'SMP', 'SMA', 'S1', 'S2']);
            $table->string('pekerjaan_ayah');
            $table->enum('penghasilan_ayah', ['0', '100', '200', '500', '1000', '1500']);
            $table->enum('status_ayah', ['Wafat', 'Hidup']);
            $table->string('ktp_ayah');

            $table->string('nama_ibu');
            $table->string('no_hp_ibu', 15);
            $table->enum('agama_ibu', ['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('kewarganegaraan_ibu', ['WNI', 'WNA']);
            $table->enum('pendidikan_ibu', ['SD', 'SMP', 'SMA', 'S1', 'S2']);
            $table->string('pekerjaan_ibu');
            $table->enum('penghasilan_ibu', ['0', '100', '200', '500', '1000', '1500']);
            $table->enum('status_ibu', ['Wafat', 'Hidup']);
            $table->string('ktp_ibu');

            $table->string('nama_wali')->nullable();
            $table->string('no_hp_wali', 15)->nullable();
            $table->string('penghasilan_wali')->nullable();
            $table->string('ktp_wali')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('orangtua_siswa');
    }
};
