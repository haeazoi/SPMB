<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jalur;

class jalurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Jalur::create([
            'nama_jalur' => 'Prestasi',
            'biaya' => '3800000',
            'deskripsi' => 'Apresiasi bagi siswa dengan capaian akademik maupun non-akademik tingkat daerah hingga nasional.'
        ]);
       Jalur::create([
            'nama_jalur' => 'Undangan',
            'biaya' => '3800000',
            'deskripsi' => 'Kesempatan khusus bagi siswa terpilih dari sekolah untuk bergabung tanpa seleksi.'
        ]);
       Jalur::create([
            'nama_jalur' => 'Reguler',
            'biaya' => '3800000',
            'deskripsi' => 'Jalur penerimaan umum bagi seluruh lulusan SMP/Sederajat melalui mekanisme seleksi standar.'
        ]);
    }
}
