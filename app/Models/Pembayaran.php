<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
     protected $table = 'pembayaran';

    protected $fillable = [
        'id_pendaftar',
        'tgl_terbit',
        'status_hasil',
        'status_bayar',
        'tanggal_pembayaran',
        'bukti_pembayaran',
        'catatan',
    ];

  public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class, 'id_pendaftar', 'id');
    }
}
