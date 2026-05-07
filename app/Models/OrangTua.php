<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'orangtua_siswa';
    protected $fillable = [
        'id_siswa',
        'nama_ayah',
        'no_hp_ayah',
        'agama_ayah',
        'kewarganegaraan_ayah',
        'pendidikan_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'status_ayah',
        'ktp_ayah',
        'nama_ibu',
        'no_hp_ibu',
        'agama_ibu',
        'kewarganegaraan_ibu',
        'pendidikan_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'status_ibu',
        'ktp_ibu',
        'nama_wali',
        'no_hp_wali',
        'penghasilan_wali',
        'ktp_wali',
    ];

     public function siswa()
    {
        return $this->belongsTo(Student::class, 'id_siswa');
    }
}
