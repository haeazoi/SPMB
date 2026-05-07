<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = [
        'nama_jurusan'
    ];
    public function jml_siswa()
    {
        // Asumsi kolom foreign key di tabel pendaftars adalah 'id_jurusan'
        return $this->hasMany(Student::class, 'id_jurusan');
    }
    // public function daftar()
    // {
    //     return $this->belongsTo(Pendaftar::class, 'id_jurusan', 'id');
    // }
     protected $table = 'jurusan';
}
