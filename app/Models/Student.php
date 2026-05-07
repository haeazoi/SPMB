<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nisn',
        'nik',
        'name',
        'email',
        'id_jurusan',
        'foto',
        'tanggal_lahir',
        'tempat_lahir',
        'agama',
        'kewarganegaraan',
        'jenis_kelamin',
        'tinggi_badan',
        'berat_badan',
        'alamat',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kota_kab',
        'provinsi',
        'sekolah',
        'kip',
        'telp_rumah',
        'no_hp',
        'kebutuhan_khusus',
        'jarak',
        'jenis_tinggal',
        'id_baju',
        'id_info',
        'transportasi',
        
        'lampiran_prestasi',
        'undangan',
        'akte',
        'suratbaik',
        'suratlulus',
        'rapor',
        'kk',
        
        'status_aktif',
        'kelas',
    ];

    protected $guarded = ['id'];

    protected $table = 'students';

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    public function info()
    {
        return $this->belongsTo(Informasi::class, 'id_info');
    }
    public function baju()
    {
        return $this->belongsTo(Baju::class, 'id_baju');
    }
}
