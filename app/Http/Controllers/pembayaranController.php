<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Pembayaran;
use App\Models\Baju;
use App\Services\WhatsAppNotificationService;
use Illuminate\Validation\Rule;

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

    public function formDaftarUlang()
    {
        $pendaftar = Pendaftar::findOrFail(Auth::user()->id);
        $baju = Baju::all();
        $pembayaran = Pembayaran::firstOrCreate(
            ['id_pendaftar' => $pendaftar->id],
            ['tgl_terbit' => now(), 'status_bayar' => 'Belum Bayar', 'status_hasil' => 'Menunggu']
        );

        if ($pendaftar->status_berkas !== 'Terverifikasi') {
            return redirect()->route('status.pendaftaran')->with('error', 'Daftar ulang hanya untuk siswa yang lulus seleksi berkas.');
        }

        if ($this->isDaftarUlangLocked($pembayaran)) {
            return redirect()->route('hasil.pendaftaran')->with('error', 'Data daftar ulang sudah dikunci karena pembayaran telah diverifikasi dan dinyatakan lulus.');
        }

        return view('siswa.ulang', compact('pendaftar', 'pembayaran', 'baju'));
    }

    public function submitDaftarUlang(Request $request)
    {
        $pendaftar = Pendaftar::findOrFail(Auth::user()->id);

        if ($pendaftar->status_berkas !== 'Terverifikasi') {
            return redirect()->route('status.pendaftaran')->with('error', 'Status Anda belum dapat melakukan daftar ulang.');
        }

        $pembayaranExisting = Pembayaran::where('id_pendaftar', $pendaftar->id)->first();
        if ($pembayaranExisting && $this->isDaftarUlangLocked($pembayaranExisting)) {
            return redirect()->route('hasil.pendaftaran')->with('error', 'Data daftar ulang sudah dikunci karena pembayaran telah diverifikasi dan dinyatakan lulus.');
        }

        $request->merge($this->normalizeDaftarUlangInput($request->all()));

        $validated = $request->validate([
            'nik' => 'required|string|digits:16',
            'email' => 'required|email|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => ['required', Rule::in(['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])],
            'kewarganegaraan' => ['required', Rule::in(['WNI', 'WNA'])],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kota_kab' => 'required|string',
            'provinsi' => 'required|string',
            'jenis_tinggal' => ['required', Rule::in(['Orang Tua', 'Wali', 'Sendiri'])],
            'jarak' => ['required', Rule::in(['Kurang', 'Lebih'])],
            'transportasi' => ['required', Rule::in(['Jalan Kaki', 'Sepeda', 'Motor', 'Mobil', 'Transportasi Umum'])],
            'id_baju' => 'required|exists:baju,id',
            'nama_ayah' => 'required|string',
            'no_hp_ayah' => 'required|string|max:15',
            'agama_ayah' => ['required', Rule::in(['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])],
            'kewarganegaraan_ayah' => ['required', Rule::in(['WNI', 'WNA'])],
            'pendidikan_ayah' => ['required', Rule::in(['SD', 'SMP', 'SMA', 'S1', 'S2'])],
            'pekerjaan_ayah' => 'required|string',
            'penghasilan_ayah' => ['required', Rule::in(['0', '100', '200', '500', '1000', '1500'])],
            'status_ayah' => ['required', Rule::in(['Wafat', 'Hidup'])],
            'nama_ibu' => 'required|string',
            'no_hp_ibu' => 'required|string|max:15',
            'agama_ibu' => ['required', Rule::in(['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])],
            'kewarganegaraan_ibu' => ['required', Rule::in(['WNI', 'WNA'])],
            'pendidikan_ibu' => ['required', Rule::in(['SD', 'SMP', 'SMA', 'S1', 'S2'])],
            'pekerjaan_ibu' => 'required|string',
            'penghasilan_ibu' => ['required', Rule::in(['0', '100', '200', '500', '1000', '1500'])],
            'status_ibu' => ['required', Rule::in(['Wafat', 'Hidup'])],
            'foto' => ($pendaftar->foto ? 'nullable' : 'required') . '|file|mimes:jpeg,png,jpg|max:1024',
            'akte' => ($pendaftar->akte ? 'nullable' : 'required') . '|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'suratbaik' => ($pendaftar->suratbaik ? 'nullable' : 'required') . '|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'suratlulus' => ($pendaftar->suratlulus ? 'nullable' : 'required') . '|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'rapor' => ($pendaftar->rapor ? 'nullable' : 'required') . '|file|mimes:pdf|max:1024',
            'kk' => ($pendaftar->kk ? 'nullable' : 'required') . '|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'ktp_ayah' => ($pendaftar->ktp_ayah ? 'nullable' : 'required') . '|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'ktp_ibu' => ($pendaftar->ktp_ibu ? 'nullable' : 'required') . '|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'bukti_pembayaran' => (($pembayaranExisting && $pembayaranExisting->bukti_pembayaran) ? 'nullable' : 'required') . '|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $pendaftar->fill(collect($validated)->except([
            'foto', 'akte', 'suratbaik', 'suratlulus', 'rapor', 'kk', 'ktp_ayah', 'ktp_ibu', 'bukti_pembayaran',
        ])->toArray());

        if ($request->hasFile('foto')) {
            $pendaftar->foto = $request->file('foto')->store('pendaftar_photos', 'public');
        }
        if ($request->hasFile('akte')) {
            $pendaftar->akte = $request->file('akte')->store('pendaftar_akte', 'public');
        }
        if ($request->hasFile('suratbaik')) {
            $pendaftar->suratbaik = $request->file('suratbaik')->store('pendaftar_suratbaik', 'public');
        }
        if ($request->hasFile('suratlulus')) {
            $pendaftar->suratlulus = $request->file('suratlulus')->store('pendaftar_suratlulus', 'public');
        }
        if ($request->hasFile('rapor')) {
            $pendaftar->rapor = $request->file('rapor')->store('pendaftar_rapor', 'public');
        }
        if ($request->hasFile('kk')) {
            $pendaftar->kk = $request->file('kk')->store('pendaftar_kk', 'public');
        }
        if ($request->hasFile('ktp_ayah')) {
            $pendaftar->ktp_ayah = $request->file('ktp_ayah')->store('pendaftar_ktpayah', 'public');
        }
        if ($request->hasFile('ktp_ibu')) {
            $pendaftar->ktp_ibu = $request->file('ktp_ibu')->store('pendaftar_ktpibu', 'public');
        }
        $pendaftar->save();

        $bukti = $pembayaranExisting?->bukti_pembayaran;
        if ($request->hasFile('bukti_pembayaran')) {
            $bukti = $request->file('bukti_pembayaran')->store('bukti_bayar', 'public');
        }

        $statusBayar = $pembayaranExisting?->status_bayar === 'Belum Bayar' && !$bukti
            ? 'Belum Bayar'
            : 'Proses Verifikasi';

        Pembayaran::updateOrCreate(
            ['id_pendaftar' => $pendaftar->id],
            [
                'tgl_terbit' => now(),
                'tanggal_pembayaran' => now(),
                'bukti_pembayaran' => $bukti,
                'status_bayar' => $statusBayar,
                'status_hasil' => 'Menunggu',
            ]
        );

        app(WhatsAppNotificationService::class)->send(
            $pendaftar->no_hp,
            "Halo {$pendaftar->name}, data daftar ulang dan bukti pembayaran Anda sudah diterima. Status saat ini: Menunggu verifikasi."
        );

        return redirect()->route('hasil.pendaftaran')->with('success', 'Daftar ulang berhasil dikirim dan pembayaran menunggu verifikasi.');
    }

    private function normalizeDaftarUlangInput(array $data): array
    {
        $mapSimple = [
            'kewarganegaraan' => [
                'INDONESIA' => 'WNI',
                'WARGA NEGARA INDONESIA' => 'WNI',
                'WNI' => 'WNI',
                'ASING' => 'WNA',
                'WNA' => 'WNA',
            ],
            'kewarganegaraan_ayah' => [
                'INDONESIA' => 'WNI',
                'WARGA NEGARA INDONESIA' => 'WNI',
                'WNI' => 'WNI',
                'ASING' => 'WNA',
                'WNA' => 'WNA',
            ],
            'kewarganegaraan_ibu' => [
                'INDONESIA' => 'WNI',
                'WARGA NEGARA INDONESIA' => 'WNI',
                'WNI' => 'WNI',
                'ASING' => 'WNA',
                'WNA' => 'WNA',
            ],
            'jenis_tinggal' => [
                'RUMAH ORANG TUA' => 'Orang Tua',
                'ORANG TUA' => 'Orang Tua',
                'WALI' => 'Wali',
                'SENDIRI' => 'Sendiri',
            ],
            'jarak' => [
                '1 KM' => 'Kurang',
                '< 1 KM' => 'Kurang',
                'KURANG DARI 1 KM' => 'Kurang',
                'KURANG' => 'Kurang',
                '> 1 KM' => 'Lebih',
                'LEBIH DARI 1 KM' => 'Lebih',
                'LEBIH' => 'Lebih',
            ],
            'transportasi' => [
                'PRIBADI' => 'Motor',
                'JALAN KAKI' => 'Jalan Kaki',
                'SEPEDA' => 'Sepeda',
                'MOTOR' => 'Motor',
                'MOBIL' => 'Mobil',
                'TRANSPORTASI UMUM' => 'Transportasi Umum',
            ],
            'pendidikan_ayah' => [
                'SLTA' => 'SMA',
                'SMA' => 'SMA',
                'SMP' => 'SMP',
                'SD' => 'SD',
                'S1' => 'S1',
                'S2' => 'S2',
            ],
            'pendidikan_ibu' => [
                'SLTA' => 'SMA',
                'SMA' => 'SMA',
                'SMP' => 'SMP',
                'SD' => 'SD',
                'S1' => 'S1',
                'S2' => 'S2',
            ],
        ];

        foreach ($mapSimple as $field => $map) {
            if (isset($data[$field])) {
                $key = strtoupper(trim((string) $data[$field]));
                if (isset($map[$key])) {
                    $data[$field] = $map[$key];
                }
            }
        }

        foreach (['penghasilan_ayah', 'penghasilan_ibu'] as $field) {
            if (!isset($data[$field])) {
                continue;
            }
            $num = (int) preg_replace('/\D/', '', (string) $data[$field]);
            if ($num <= 0) {
                $data[$field] = '0';
            } elseif ($num <= 100000) {
                $data[$field] = '100';
            } elseif ($num <= 200000) {
                $data[$field] = '200';
            } elseif ($num <= 500000) {
                $data[$field] = '500';
            } elseif ($num <= 1000000) {
                $data[$field] = '1000';
            } else {
                $data[$field] = '1500';
            }
        }

        return $data;
    }

    private function isDaftarUlangLocked(Pembayaran $pembayaran): bool
    {
        return $pembayaran->status_hasil === 'Lulus' || $pembayaran->status_bayar === 'Lunas';
    }
}