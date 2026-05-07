<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create([
            'nama_jurusan' => 'Teknik Pemboran Migas'
        ]);
        Jurusan::create([
            'nama_jurusan' => 'Teknik Produksi Migas'
        ]);
        Jurusan::create([
            'nama_jurusan' => 'Agribisnis Tanaman Perkebunan (Sawit)'
        ]);
        Jurusan::create([
            'nama_jurusan' => 'Manajemen Perkantoran'
        ]);
    }
}
