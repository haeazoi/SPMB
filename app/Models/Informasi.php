<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
     protected $fillable = [
        'jenis'
    ];
    public function jml_siswa()
    {
        return $this->hasMany(Pendaftar::class, 'id_info');
    }
     protected $table = 'informasi';
}
