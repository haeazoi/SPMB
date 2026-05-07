<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baju extends Model
{
      protected $fillable = [
        'ukuran_baju'
    ];
    public function jml_siswa()
    {
        return $this->hasMany(Student::class, 'id_baju');
    }
     protected $table = 'baju';
}
