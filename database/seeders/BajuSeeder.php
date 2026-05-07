<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Baju;

class BajuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Baju::create([
            'ukuran_baju' => 'XS'
        ]);
        Baju::create([
            'ukuran_baju' => 'S'
        ]);
        Baju::create([
            'ukuran_baju' => 'M'
        ]);
        Baju::create([
            'ukuran_baju' => 'L'
        ]);
        Baju::create([
            'ukuran_baju' => 'XL'
        ]);
        Baju::create([
            'ukuran_baju' => 'XXL'
        ]);
    }
}
