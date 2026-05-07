<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Pembayaran;

class pembayaranController extends Controller
{
   

public function index()
{
    $siswa_id = Auth::user()->id;

    $pembayaranSiswa = Pendaftar::with(['jalur', 'bayar'])->where('id', $siswa_id)->first();

    if (!$pembayaranSiswa) {
        return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
    }

    $nama = $pembayaranSiswa->name;
    $status = $pembayaranSiswa->status_berkas;
    $idJalurSiswa = $pembayaranSiswa->id_jalur; 

    $urutan = Pendaftar::where('id_jalur', $idJalurSiswa)
        ->where('id', '<=', $pembayaranSiswa->id)
        ->count();

    $biayaAsli = $pembayaranSiswa->jalur->biaya;
    $persenDiskon = 0;
    $namaJalur = strtolower($pembayaranSiswa->jalur->nama_jalur);

    if ($urutan <= 50) {
        if (str_contains($namaJalur, 'prestasi')) {
            $persenDiskon = 65;
        } elseif (str_contains($namaJalur, 'undangan')) {
            $persenDiskon = 55;
        } elseif (str_contains($namaJalur, 'reguler')) {
            $persenDiskon = 35;
        }
    }

    $nominalDiskon = ($persenDiskon / 100) * $biayaAsli;
    $totalBayar = $biayaAsli - $nominalDiskon;

    $tglAwal = $pembayaranSiswa->pembayaran->tgl_terbit ?? $pembayaranSiswa->created_at;
    $tglAkhir = \Carbon\Carbon::parse($tglAwal)->addDays(7);
    $tanggalTagihan = \Carbon\Carbon::parse($tglAwal)->translatedFormat('d F Y');
    $tanggalTerakhir = $tglAkhir->translatedFormat('d F Y');

    

    return view('siswa.coba', compact(
        'pembayaranSiswa',
        'nama',
        'status',
        'urutan',
        'biayaAsli',
        'persenDiskon',
        'totalBayar',
        'tanggalTagihan',
        'tanggalTerakhir'
    ));
}
   public function pembayaran()
    {
        $pembayaran = Pembayaran::where('id_pendaftar', Auth::user()->id)->first();

        $hasil = $pembayaran->status_hasil ?? '';
        $namaSiswa = $pembayaran->pendaftar->name ?? '';

        return view('siswa.hasil', compact('pembayaran', 'hasil', 'namaSiswa'));
    }
    public function store(Request $request)
    {
        $pendaftar = Pendaftar::where('id', Auth::user()->id)->first();

        if (!$pendaftar) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }
        $bukti = $request->file('bukti_pembayaran')->store('bukti_bayar', 'public');

        $pembayaran = Pembayaran::where('id_pendaftar', $pendaftar->id)->first();

        if ($pembayaran) {
            $pembayaran->update([
                'tanggal_pembayaran' => now(),
                'bukti_pembayaran' => $bukti,
                'status_bayar' => 'Proses Verifikasi'
            ]);
        } else {
            Pembayaran::create([
                'id_pendaftar' => $pendaftar->id,
                'tgl_terbit' => now(),
                'tanggal_pembayaran' => now(),
                'bukti_pembayaran' => $bukti,
                'status_hasil' => 'Menunggu'
            ]);
        }

        return redirect(route('hasil.pendaftaran'))->with('success', 'Bukti berhasil diunggah.');
    }
}