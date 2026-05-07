<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Jurusan;
use App\Models\Informasi;
use App\Models\Baju;
use App\Models\Pembayaran;
use App\Models\Jalur;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Services\WhatsAppNotificationService;

class daftarController extends Controller
{
    public function index(Request $request)
    {
        $jalurId = $request->query('id_jalur');

        if (!$jalurId) {
            return redirect()->route('siswa.jalur')->with('error', 'Silakan pilih jalur terlebih dahulu.');
        }

        $jalur = Jalur::findOrFail($jalurId);
        $jurusan = Jurusan::all();
        $informasi = Informasi::all();
        $baju = Baju::all();

        return view('siswa.daftar', compact('jurusan', 'informasi', 'baju', 'jalur'));
    }
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'digits' => ':attribute harus berjumlah :digits digit.',
            'unique' => ':attribute sudah terdaftar di sistem.',
            'email' => 'Format :attribute tidak valid.',
            'numeric' => ':attribute harus berupa angka.',
            'date' => 'Tanggal pada :attribute tidak valid.',
            'exists' => ':attribute yang dipilih tidak tersedia.',
            'mimes' => ':attribute harus berupa file dengan format: :values.',
            'max' => 'Ukuran :attribute tidak boleh lebih dari :max KB.',
            'file' => ':attribute harus berupa file.',
            'in' => ':attribute yang dipilih tidak valid.',
        ];

        $attributes = [
            'aggrement' => 'Persetujuan Ketentuan',
            'nisn' => 'NISN',
            'nik' => 'NIK',
            'name' => 'Nama Lengkap',
            'email' => 'Alamat Email',
            'tinggi_badan' => 'Tinggi Badan',
            'berat_badan' => 'Berat Badan',
            'telp_rumah' => 'Telepon Rumah',
            'no_hp' => 'Nomor HP',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'agama' => 'Agama',
            'jenis_kelamin' => 'Jenis Kelamin',
            'kewarganegaraan' => 'Kewarganegaraan',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kota_kab' => 'Kota/Kabupaten',
            'provinsi' => 'Provinsi',
            'sekolah' => 'Asal Sekolah',
            'id_jurusan' => 'Jurusan',
            'id_baju' => 'Ukuran Baju',
            'id_info' => 'Info Pendaftaran',
            'transportasi' => 'Transportasi',
            'nama_ayah' => 'Nama Ayah',
            'no_hp_ayah' => 'Nomor HP Ayah',
            'ktp_ayah' => 'File KTP Ayah',
            'nama_ibu' => 'Nama Ibu',
            'no_hp_ibu' => 'Nomor HP Ibu',
            'ktp_ibu' => 'File KTP Ibu',
            'foto' => 'Pas Foto',
            'akte' => 'Akte Kelahiran',
            'suratbaik' => 'Surat Berkelakuan Baik',
            'suratlulus' => 'Ijazah/SKL',
            'rapor' => 'File Rapor',
            'kk' => 'Kartu Keluarga',
        ];

        $validator = Validator::make($request->all(), [

            'aggrement' => 'required',

            'nisn' => 'required|string|digits:10|unique:pendaftaran,nisn',
            'nik' => 'nullablle|string|digits:16|unique:pendaftaran,nik',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:pendaftaran,email',
            'tinggi_badan' => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
            'telp_rumah' => 'nullable|string|max:15',
            'no_hp' => 'required|string|max:15',
            'tempat_lahir' => 'required|string',
            'agama' => ['required', Rule::in(['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'kewarganegaraan' => ['nullable', Rule::in(['WNI', 'WNA'])],
            'kebutuhan_khusus' => 'nullable|string',
            'alamat' => 'required|string',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kota_kab' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'sekolah' => 'required|string',
            'kip' => 'nullable|string',
            'jenis_tinggal' => ['nullable', Rule::in(['Orang Tua', 'Wali', 'Sendiri'])],
            'jarak' => ['nullable', Rule::in(['Kurang', 'Lebih'])],
            'id_jurusan' => 'required|exists:jurusan,id',
            'transportasi' => ['nullable', Rule::in(['Jalan Kaki', 'Sepeda', 'Motor', 'Mobil', 'Transportasi Umum'])],
            'id_baju' => 'nullable|exists:baju,id',
            'id_info' => 'required|exists:informasi,id',
            'id_jalur' => 'required|exists:jalur,id',

            'nama_ayah' => 'nullable|string',
            'no_hp_ayah' => 'nullable|string|max:15',
            'status_ayah' => ['nullable', Rule::in(['Wafat', 'Hidup'])],
            'kewarganegaraan_ayah' => ['nullable', Rule::in(['WNI', 'WNA'])],
            'pendidikan_ayah' => ['nullable', Rule::in(['SD', 'SMP', 'SMA', 'S1', 'S2'])],
            'agama_ayah' => ['nullable', Rule::in(['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])],
            'pekerjaan_ayah' => 'nullable|string',
            'penghasilan_ayah' => ['nullable', Rule::in(['0', '100', '200', '500', '1000', '1500'])],
            'ktp_ayah' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',

            'nama_ibu' => 'nullable|string',
            'no_hp_ibu' => 'nullable|string|max:15',
            'status_ibu' => ['nullable', Rule::in(['Wafat', 'Hidup'])],
            'kewarganegaraan_ibu' => ['nullable', Rule::in(['WNI', 'WNA'])],
            'pendidikan_ibu' => ['nullable', Rule::in(['SD', 'SMP', 'SMA', 'S1', 'S2'])],
            'agama_ibu' => ['nullable', Rule::in(['Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])],
            'pekerjaan_ibu' => 'nullable|string',
            'penghasilan_ibu' => ['nullable', Rule::in(['0', '100', '200', '500', '1000', '1500'])],
            'ktp_ibu' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',

            'nama_wali' => 'nullable|string',
            'no_hp_wali' => 'nullable|string|max:15',
            'penghasilan_wali' => 'nullable|string',
            'ktp_wali' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',

            'foto' => 'nullable|file|mimes:jpeg,png,jpg|max:1024',
            'akte' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'suratbaik' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'suratlulus' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'rapor' => 'nullable|file|mimes:pdf|max:1024',
            'kk' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'lampiran_prestasi' => 'nullable|array',
            'lampiran_prestasi.*' => 'file|mimes:pdf,jpeg,png,jpg|max:1024',
            'undangan' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',

        ], $messages, $attributes);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $safeData = $validator->validated();

        try {
            $fotoPath = $request->hasFile('foto') ? $request->file('foto')->store('pendaftar_photos', 'public') : null;
            $ktp_ayahPath = $request->hasFile('ktp_ayah') ? $request->file('ktp_ayah')->store('pendaftar_ktpayah', 'public') : null;
            $ktp_ibuPath = $request->hasFile('ktp_ibu') ? $request->file('ktp_ibu')->store('pendaftar_ktpibu', 'public') : null;
            $aktePath = $request->hasFile('akte') ? $request->file('akte')->store('pendaftar_akte', 'public') : null;
            $suratbaikPath = $request->hasFile('suratbaik') ? $request->file('suratbaik')->store('pendaftar_suratbaik', 'public') : null;
            $suratlulusPath = $request->hasFile('suratlulus') ? $request->file('suratlulus')->store('pendaftar_suratlulus', 'public') : null;
            $raporPath = $request->hasFile('rapor') ? $request->file('rapor')->store('pendaftar_rapor', 'public') : null;
            $kkPath = $request->hasFile('kk') ? $request->file('kk')->store('pendaftar_kk', 'public') : null;

            $ktp_waliPath = $request->hasFile('ktp_wali') ? $request->file('ktp_wali')->store('pendaftar_ktpwali', 'public') : null;
            $lampiranPath = null;
            if ($request->hasFile('lampiran_prestasi')) {
                $lampiranPath = [];
                foreach ($request->file('lampiran_prestasi') as $lampiranFile) {
                    if ($lampiranFile) {
                        $lampiranPath[] = $lampiranFile->store('prestasi_pendaftar', 'public');
                    }
                }
                $lampiranPath = empty($lampiranPath) ? null : json_encode($lampiranPath);
            }
            $undanganPath = $request->hasFile('undangan') ? $request->file('undangan')->store('undangan_pendaftar', 'public') : null;

            $pendaftar = new Pendaftar();
            $pendaftar->no_pendaftaran = 'F-' . time();
            $pendaftar->status_berkas = 'Menunggu';
            $pendaftar->tanggal_pendaftaran = Carbon::now('Asia/Jakarta');

            $dataTeks = collect($safeData)->except([
                'aggrement',
                'foto',
                'lampiran_prestasi',
                'undangan',
                'ktp_ayah',
                'ktp_ibu',
                'ktp_wali',
                'akte',
                'kk',
                'rapor',
                'suratbaik',
                'suratlulus'
            ])->toArray();

            $pendaftar->fill($dataTeks);

            $pendaftar->foto = $fotoPath;
            $pendaftar->ktp_ayah = $ktp_ayahPath;
            $pendaftar->ktp_ibu = $ktp_ibuPath;
            $pendaftar->ktp_wali = $ktp_waliPath;
            $pendaftar->akte = $aktePath;
            $pendaftar->kk = $kkPath;
            $pendaftar->rapor = $raporPath;
            $pendaftar->suratbaik = $suratbaikPath;
            $pendaftar->suratlulus = $suratlulusPath;
            $pendaftar->lampiran_prestasi = $lampiranPath;
            $pendaftar->undangan = $undanganPath;

            $pendaftar->save();

            app(WhatsAppNotificationService::class)->send(
                $pendaftar->no_hp,
                "Halo {$pendaftar->name}, pendaftaran SPMB Anda sudah kami terima dengan nomor {$pendaftar->no_pendaftaran}. Status saat ini: Menunggu verifikasi berkas."
            );

            return redirect()->route('daftar.sukses')->with([
                'success' => 'Pendaftaran berhasil dikirim.',
                'no_pendaftaran' => $pendaftar->no_pendaftaran,
                'nisn' => $pendaftar->nisn
            ]);

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function sukses()
    {
        if (!session()->has('no_pendaftaran') || !session()->has('nisn')) {
            return redirect()->route('daftar.index');
        }
        return view('siswa.sukses');
    }

    public function ulang(Request $request)
    {
        return view('siswa.ulang');
    }
}
