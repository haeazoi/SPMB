<?php

namespace App\Http\Controllers;

use App\Models\Baju;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Pembayaran;
use App\Models\Student;
use App\Services\WhatsAppNotificationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class regulerController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftar::with('jalur', 'jurusan', 'baju')
            ->where('id_jalur', 3)
            ->orderBy('status_berkas', 'ASC')
            ->get();

        return view('tu.reguler', compact('pendaftar'), [
            "title" => "Seleksi Pendaftar"
        ]);
    }
    public function update(Request $r, $id)
    {
        // Cari pendaftar berdasarkan ID
        $pendaftar = Pendaftar::findOrFail($id);

        if ($pendaftar->status_berkas == 'Menunggu') {
            // Update status berkas
            $pendaftar->status_berkas = 'Terverifikasi';
            $pendaftar->save();

            // Buat data pembayaran secara otomatis
            Pembayaran::firstOrCreate([
                'id_pendaftar' => $pendaftar->id
            ], [
                'tgl_terbit' => Carbon::now('Asia/Jakarta'),
                'status_bayar' => 'Belum Bayar',
            ]);

            app(WhatsAppNotificationService::class)->send(
                $pendaftar->no_hp,
                "Halo {$pendaftar->name}, selamat Anda LULUS seleksi berkas jalur Reguler. Silakan lanjutkan daftar ulang dan upload bukti pembayaran."
            );

            return redirect()->back()->with('success', 'Berkas berhasil diverifikasi dan tagihan telah dibuat.');
        }

        return redirect()->back()->with('error', 'Status berkas tidak dapat diubah.');
    }

    // 3. Tolak Pendaftar
    public function reject($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);

        if ($pendaftar->status_berkas == 'Menunggu') {
            $pendaftar->status_berkas = 'Ditolak';
            $pendaftar->save();

            app(WhatsAppNotificationService::class)->send(
                $pendaftar->no_hp,
                "Halo {$pendaftar->name}, mohon maaf Anda belum lulus seleksi berkas jalur Reguler."
            );

            return redirect()->back()->with('info', 'Pendaftar telah ditolak.');
        }

        return redirect()->back()->with('error', 'Gagal memproses penolakan.');
    }
    public function bayar()
    {
        $pembayaran = Pembayaran::whereHas('pendaftar', function ($query) {
            $query->where('id_jalur', 3);
        })
            ->with(['pendaftar.jalur', 'pendaftar.jurusan'])
            ->get();

        return view('tu.bayarreguler', compact('pembayaran'), [
            "title" => "Seleksi Pembayaran Jalur Reguler"
        ]);
    }
    public function updateBayar(Request $r, $id)
    {
        // Gunakan DB Transaction agar jika salah satu gagal (siswa/ortu), data tidak nanggung
        return DB::transaction(function () use ($id) {

            $pembayaran = Pembayaran::where('id_pendaftar', $id)->first();

            if ($pembayaran) {
                // 1. Update status di tabel Pembayaran
                $pembayaran->update([
                    'status_bayar' => 'Lunas',
                    'status_hasil' => 'Lulus'
                ]);

                // 2. Ambil data pendaftar (Raw Data dari DD Anda)
                $rawData = $pembayaran->pendaftar->toArray();

                // 3. Simpan/Update Data Student
                // Kita filter hanya kolom yang ada di fillable Student
                $studentModel = new Student();
                $fillableStudent = $studentModel->getFillable();
                $dataSiswaOnly = array_intersect_key($rawData, array_flip($fillableStudent));

                // Set default jika tidak ada di pendaftar
                $dataSiswaOnly['status_aktif'] = 'Aktif';
                $dataSiswaOnly['kelas'] = '10';

                // Gunakan updateOrCreate agar jika diklik 2x tidak error/duplikat
                $student = Student::updateOrCreate(
                    ['nisn' => $rawData['nisn']],
                    $dataSiswaOnly
                );

                // 4. Simpan Data Orang Tua
                // Tentukan kolom mana saja yang masuk ke tabel orangtua_siswa
                $dataOrtu = [
                    'id_siswa' => $student->id, // Ambil ID dari student yang baru dibuat/diupdate
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

                // Simpan ke tabel orangtua_siswa melalui Model-nya
                // Pastikan Anda sudah membuat model OrangtuaSiswa
                OrangTua::updateOrCreate(
                    ['id_siswa' => $student->id],
                    $dataOrtu
                );

                app(WhatsAppNotificationService::class)->send(
                    $pembayaran->pendaftar->no_hp,
                    "Halo {$pembayaran->pendaftar->name}, daftar ulang dan pembayaran Anda sudah diverifikasi. Status: LULUS."
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
            // 1. Kembalikan status bayar ke Belum Bayar atau Ditolak
            $pembayaran->update([
                'status_bayar' => 'Belum Bayar', // Agar siswa bisa upload ulang
                'bukti_pembayaran' => null, // Opsional: hapus bukti lama agar bisa upload baru
                'status_hasil' => 'Tidak Lulus'
            ]);

            app(WhatsAppNotificationService::class)->send(
                $pembayaran->pendaftar->no_hp,
                "Halo {$pembayaran->pendaftar->name}, verifikasi pembayaran belum berhasil. Silakan perbaiki data daftar ulang dan upload ulang bukti pembayaran."
            );

            return redirect()->back()->with('error', 'Pembayaran ditolak. Status pendaftaran diperbarui.');
        }

        return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan.');
    }

     public function reguler()
    {
        $pendaftar = Pendaftar::with('jalur', 'jurusan', 'baju')
            ->where('id_jalur', 3)
            ->orderBy('status_berkas', 'ASC')
            ->get();

        return view('superadmin.reguler', compact('pendaftar'), [
            "title" => "Seleksi Pendaftar"
        ]);
    }
    public function bayarReguler()
    {
        $pembayaran = Pembayaran::whereHas('pendaftar', function ($query) {
            $query->where('id_jalur', 3);
        })
            ->with(['pendaftar.jalur', 'pendaftar.jurusan']) // Eager load relasi pendaftar, jalur, dan jurusan
            ->get();

        return view('superadmin.bayarreguler', compact('pembayaran'), [
            "title" => "Seleksi Pembayaran Jalur Reguler"
        ]);
    }
}
