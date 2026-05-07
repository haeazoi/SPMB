<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pendaftar;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        for ($i = 1; $i <= 50; $i++) {
            Pendaftar::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,

                // Data Identitas
                'nisn' => $faker->unique()->numerify('00########'),
                'nik' => $faker->unique()->numerify('3216############'),
                'id_jurusan' => $faker->numberBetween(1, 4),
                'id_jalur' => $faker->numberBetween(1, 3),
                'foto' => 'default.jpg',
                'tempat_lahir' => $faker->city . ', ' . Carbon::parse($faker->date())->format('d-m-y'),
                'agama' => 'Islam',
                'kewarganegaraan' => 'WNI',
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tinggi_badan' => $faker->numberBetween(150, 180),
                'berat_badan' => $faker->numberBetween(45, 75),

                // Data Alamat
                'alamat' => $faker->streetAddress,
                'rt' => $faker->numerify('0##'),
                'rw' => $faker->numerify('0##'),
                'kota_kab' => $faker->city,
                'kelurahan' => $faker->randomElement(['Mekarsari', 'Sukamaju', 'Margahayu', 'Cibaduyut']),
                'kecamatan' => $faker->randomElement(['Cicendo', 'Coblong', 'Lengkong', 'Andir']),
                'provinsi' => $faker->randomElement(['Jawa Barat', 'Jawa Tengah', 'Jawa Timur', 'DKI Jakarta']),
                'sekolah' => 'SMPN ' . $faker->numberBetween(1, 5) . ' ' . $faker->city,
                'kip' => $faker->randomElement([null, $faker->numerify('#######')]),
                'telp_rumah' => $faker->numerify('08##########'),
                'no_hp' => $faker->numerify('08##########'),

                // Status & Sistem
                'kebutuhan_khusus' => 'Tidak Ada',
                'jarak' => 'Kurang',
                'jenis_tinggal' => 'Orang Tua',
                'id_baju' => $faker->numberBetween(1, 4),
                'transportasi' => $faker->randomElement(['Motor', 'Jalan Kaki']),
                'id_info' => $faker->numberBetween(1, 4),
                'status_berkas' => 'Menunggu',
                'no_pendaftaran' => 'F-' . time() . $i,
                'tanggal_pendaftaran' => now(),

                // Data Ayah
                'nama_ayah' => $faker->name('male'),
                'no_hp_ayah' => $faker->numerify('08##########'),
                'agama_ayah' => 'Islam',
                'kewarganegaraan_ayah' => 'WNI',
                'pendidikan_ayah' => 'SMA',
                'pekerjaan_ayah' => $faker->jobTitle,
                'penghasilan_ayah' => '1000',
                'status_ayah' => 'Hidup',

                // Data Ibu
                'nama_ibu' => $faker->name('female'),
                'no_hp_ibu' => $faker->numerify('08##########'),
                'agama_ibu' => 'Islam',
                'kewarganegaraan_ibu' => 'WNI',
                'pendidikan_ibu' => 'SMA',
                'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                'penghasilan_ibu' => '0',
                'status_ibu' => 'Hidup',

                // 'guru' => 'Pak Udin',
                // 'sosmed' => '@kepoaja',

                // Wali & Lampiran (Dikosongkan dulu)
                'nama_wali' => null,
                'no_hp_wali' => null,
                'penghasilan_wali' => null,
                'lampiran_prestasi' => null,
                'undangan' => null,

                'kk' => 'default.jpg',
                'akte' => 'default.jpg',
                'suratbaik' => 'default.jpg',
                'suratlulus' => 'default.jpg',
                'ktp_ayah' => 'default.jpg',
                'ktp_ibu' => 'default.jpg',
                'ktp_wali' => 'default.jpg',
                'rapor' => 'default.pdf',
            ]);
        }
    }
}
