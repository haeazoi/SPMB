<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Pembayaran;
use Carbon\Carbon;

class prestasiController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftar::with('jalur', 'jurusan', 'baju')
            ->where('id_jalur', 1)
            ->orderBy('status_berkas', 'ASC')
            ->get();

        return view('tu.prestasi', compact('pendaftar'), [
            "title" => "Seleksi Pendaftar"
        ]);
    }
    public function update(Request $r, $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        if ($pendaftar->status_berkas == 'Menunggu') {
            $pendaftar->status_berkas = 'Terverifikasi';
            $pendaftar->save();

            Pembayaran::firstOrCreate([
                'id_pendaftar' => $pendaftar->id
            ], [
                'tgl_terbit' => Carbon::now('Asia/Jakarta'),
                'status_bayar' => 'Belum Bayar',
            ]);

            return redirect()->back()->with('success', 'Berkas berhasil diverifikasi dan tagihan telah dibuat.');
        }
        return redirect()->back()->with('error', 'Status berkas tidak dapat diubah.');
    }

    public function reject(Request $request, $id) // Tambahkan Request $request
    {
        $pendaftar = Pendaftar::findOrFail($id);

        if ($pendaftar->status_berkas == 'Menunggu') {
            // Ambil teks dari input 'alasan_tolak' yang dikirim JavaScript
            $alasan = $request->input('alasan');

            $pendaftar->status_berkas = 'Ditolak';

            // Simpan ke kolom 'catatan' sesuai yang ada di database kamu
            $pendaftar->alasan = $alasan;

            $pendaftar->save();

            return redirect()->back()->with('info', 'Pendaftar telah ditolak.');
        }

        return redirect()->back()->with('error', 'Gagal memproses penolakan.');
    }
    // public function reject($id)
    // {
    //     $pendaftar = Pendaftar::findOrFail($id);

    //     if ($pendaftar->status_berkas == 'Menunggu') {
    //         $pendaftar->status_berkas = 'Ditolak';
    //         $pendaftar->save();

    //         return redirect()->back()->with('info', 'Pendaftar telah ditolak.');
    //     }
    //     return redirect()->back()->with('error', 'Gagal memproses penolakan.');
    // }
    public function bayar()
    {
        $pembayaran = Pembayaran::whereHas('pendaftar', function ($query) {
            $query->where('id_jalur', 1);
        })
            ->with(['pendaftar.jalur', 'pendaftar.jurusan'])
            ->get();

        return view('tu.bayarprestasi', compact('pembayaran'), [
            "title" => "Seleksi Pembayaran Jalur Prestasi"
        ]);
    }
    public function updateBayar(Request $r, $id)
    {
        return \DB::transaction(function () use ($id) {

            $pembayaran = Pembayaran::where('id_pendaftar', $id)->first();

            if ($pembayaran) {
                $pembayaran->update([
                    'status_bayar' => 'Lunas',
                    'status_hasil' => 'Lulus'
                ]);
                $rawData = $pembayaran->pendaftar->toArray();

                $studentModel = new Student();
                $fillableStudent = $studentModel->getFillable();
                $dataSiswaOnly = array_intersect_key($rawData, array_flip($fillableStudent));

                $dataSiswaOnly['status_aktif'] = 'Aktif';
                $dataSiswaOnly['kelas'] = '10';

                $student = Student::updateOrCreate(
                    ['nisn' => $rawData['nisn']],
                    $dataSiswaOnly
                );
                $dataOrtu = [
                    'id_siswa' => $student->id,
                    'nama_ayah' => $rawData['nama_ayah'],
                    'no_hp_ayah' => $rawData['no_hp_ayah'],
                    'agama_ayah' => $rawData['agama_ayah'],
                    'kewarganegaraan_ayah' => $rawData['kewarganegaraan_ayah'],
                    'pendidikan_ayah' => $rawData['pendidikan_ayah'],
                    'pekerjaan_ayah' => $rawData['pekerjaan_ayah'],
                    'penghasilan_ayah' => $rawData['penghasilan_ayah'],
                    'status_ayah' => $rawData['status_ayah'],
                    'ktp_ayah' => $rawData['ktp_ayah'],

                    'nama_ibu' => $rawData['nama_ibu'],
                    'no_hp_ibu' => $rawData['no_hp_ibu'],
                    'agama_ibu' => $rawData['agama_ibu'],
                    'kewarganegaraan_ibu' => $rawData['kewarganegaraan_ibu'],
                    'pendidikan_ibu' => $rawData['pendidikan_ibu'],
                    'pekerjaan_ibu' => $rawData['pekerjaan_ibu'],
                    'penghasilan_ibu' => $rawData['penghasilan_ibu'],
                    'status_ibu' => $rawData['status_ibu'],
                    'ktp_ibu' => $rawData['ktp_ibu'],

                    'nama_wali' => $rawData['nama_wali'] ?? null,
                    'no_hp_wali' => $rawData['no_hp_wali'] ?? null,
                    'penghasilan_wali' => $rawData['penghasilan_wali'] ?? null,
                    'ktp_wali' => $rawData['ktp_wali'] ?? 'default.jpg',
                ];
                OrangTua::updateOrCreate(
                    ['id_siswa' => $student->id],
                    $dataOrtu
                );
                return redirect()->back()->with('success', 'Pembayaran dikonfirmasi. Data Siswa & Orang Tua berhasil dipindahkan.');
            }
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        });
    }
    public function rejectBayar($id)
    {
        $pembayaran = Pembayaran::where('id_pendaftar', $id)->first();

        if ($pembayaran) {
            $pembayaran->update([
                'status_bayar' => 'Belum Bayar',
                'bukti_pembayaran' => null,
                'status_hasil' => 'Tidak Lulus'
            ]);

            return redirect()->back()->with('error', 'Pembayaran ditolak. Status pendaftaran diperbarui.');
        }

        return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan.');
    }
    public function prestasi()
    {
        $pendaftar = Pendaftar::with('jalur', 'jurusan', 'baju')
            ->where('id_jalur', 1)
            ->orderBy('status_berkas', 'ASC')
            ->get();

        return view('superadmin.prestasi', compact('pendaftar'), [
            "title" => "Seleksi Pendaftar"
        ]);
    }
    public function bayarPrestasi()
    {
        $pembayaran = Pembayaran::whereHas('pendaftar', function ($query) {
            $query->where('id_jalur', 1);
        })
            ->with(['pendaftar.jalur', 'pendaftar.jurusan'])
            ->get();

        return view('superadmin.bayarprestasi', compact('pembayaran'), [
            "title" => "Seleksi Pembayaran Jalur Prestasi"
        ]);
    }
}
