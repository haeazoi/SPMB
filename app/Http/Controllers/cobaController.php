<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Informasi;

class cobaController extends Controller
{
    public function index()
    {
        $totaldtf = Pendaftar::count();
        
        $dataLulus = Pendaftar::whereHas('pembayaran', function ($query) {
            $query->where('status_hasil', 'Lulus');
        })->get();

        $jumlahLulus = $dataLulus->count();
        $jumlahMenunggu = Pendaftar::where('status_berkas', 'Menunggu')->count();
        $jumlahBayar = Pembayaran::where('status_bayar', 'Proses Verifikasi')->count();

        $dataInformasi = Informasi::withCount('jml_siswa')->get();

        $labels = $dataInformasi->pluck('jenis'); 
        $totals = $dataInformasi->pluck('jml_siswa_count');

        if (session('role') == 'tu') {
            return view('tu.dashboard', compact('totaldtf', 'dataLulus', 'jumlahLulus', 'jumlahMenunggu', 'jumlahBayar', 'labels', 'totals'), [
                "title" => "Dashboard"
            ]);
        } else {
            return redirect()->back();
        }
    }
}
