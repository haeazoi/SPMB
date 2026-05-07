<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pendaftar extends Authenticatable
{
    use HasFactory;

    protected $table = 'pendaftaran';

    // protected $fillable = [
    //     'nisn',
    //     'nik',
    //     'name',
    //     'email',
    //     'id_jurusan',
    //     'foto',
    //     'tanggal_lahir',
    //     'tempat_lahir',
    //     'agama',
    //     'kewarganegaraan',
    //     'jenis_kelamin',
    //     'tinggi_badan',
    //     'berat_badan',
    //     'id_jalur',

    //     'alamat',
    //     'rt',
    //     'rw',
    //     'kelurahan',
    //     'kecamatan',
    //     'kota_kab',
    //     'provinsi',
    //     'sekolah',
    //     'kip',
    //     'telp_rumah',
    //     'no_hp',
    //     'kebutuhan_khusus',
    //     'jarak',
    //     'jenis_tinggal',
    //     'baju',
    //     'transportasi',
    //     'id_info',
    //     'status_berkas',

    //     'no_pendaftaran',

    //     'nama_ayah',
    //     'no_hp_ayah',
    //     'agama_ayah',
    //     'kewarganegaraan_ayah',
    //     'pendidikan_ayah',
    //     'pekerjaan_ayah',
    //     'penghasilan_ayah',
    //     'status_ayah',

    //     'nama_ibu',
    //     'no_hp_ibu',
    //     'agama_ibu',
    //     'kewarganegaraan_ibu',
    //     'pendidikan_ibu',
    //     'pekerjaan_ibu',
    //     'penghasilan_ibu',
    //     'status_ibu',

    //     'nama_wali',
    //     'no_hp_wali',
    //     'penghasilan_wali',

    //     'lampiran_prestasi',
    //     'undangan',
    // ];

    protected $guarded = [];

    public function getLampiranPrestasiFilesAttribute(): array
    {
        if (empty($this->lampiran_prestasi)) {
            return [];
        }

        $decoded = json_decode($this->lampiran_prestasi, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return array_values(array_filter($decoded));
        }

        return [$this->lampiran_prestasi];
    }

    public function getLampiranPrestasiUtamaAttribute(): ?string
    {
        $files = $this->lampiran_prestasi_files;
        return $files[0] ?? null;
    }

    //relasi
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
    public function jalur()
    {
        return $this->belongsTo(Jalur::class, 'id_jalur');
    }
   public function bayar(){
       return $this->hasOne(Pembayaran::class, 'id_pendaftar');
   }
   public function pembayaran()
{
    return $this->hasOne(Pembayaran::class, 'id_pendaftar', 'id');
}
}