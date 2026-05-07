<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Informasi;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Informasi::create(
            [
                'jenis' => 'Brosur',
            ]
        );
        Informasi::create(
            [
                'jenis' => 'Spanduk',
            ]
        );
        Informasi::create(
            [
                'jenis' => 'Sosial Media',
            ]
        );
        Informasi::create(
            [
                'jenis' => 'Pencarian Google',
            ]
        );
    }
}
