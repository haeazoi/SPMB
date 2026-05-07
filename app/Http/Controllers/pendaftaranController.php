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
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Validator;

class PendaftaranController extends Controller
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

        return view('siswa.pendaftar', compact('jurusan', 'informasi', 'baju', 'jalur'));
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
            'nik' => 'required|string|digits:16|unique:pendaftaran,nik',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pendaftaran,email',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'telp_rumah' => 'nullable|string|max:15',
            'no_hp' => 'required|string|max:15',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string',
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'kewarganegaraan' => ['required', Rule::in(['WNI', 'WNA'])],
            'kebutuhan_khusus' => 'nullable|string',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kota_kab' => 'required|string',
            'provinsi' => 'required|string',
            'sekolah' => 'required|string',
            'kip' => 'nullable|string',
            'jenis_tinggal' => ['required', Rule::in(['Orang Tua', 'Wali', 'Sendiri'])],
            'jarak' => ['required', Rule::in(['Kurang', 'Lebih'])],
            'id_jurusan' => 'required|exists:jurusan,id',
            'transportasi' => ['required', Rule::in(['Jalan Kaki', 'Sepeda', 'Motor', 'Mobil', 'Transportasi Umum'])],
            'id_baju' => 'required|exists:baju,id',
            'id_info' => 'required|exists:informasi,id',
            'id_jalur' => 'required|exists:jalur,id',

            'nama_ayah' => 'required|string',
            'no_hp_ayah' => 'required|string|max:15',
            'status_ayah' => ['required', Rule::in(['Wafat', 'Hidup'])],
            'kewarganegaraan_ayah' => 'required|string',
            'pendidikan_ayah' => 'required|string',
            'agama_ayah' => 'required|string',
            'pekerjaan_ayah' => 'required|string',
            'penghasilan_ayah' => 'required|string',
            'ktp_ayah' => 'required|file|mimes:pdf,jpeg,png,jpg|max:1024',

            'nama_ibu' => 'required|string',
            'no_hp_ibu' => 'required|string|max:15',
            'status_ibu' => ['required', Rule::in(['Wafat', 'Hidup'])],
            'kewarganegaraan_ibu' => 'required|string',
            'pendidikan_ibu' => 'required|string',
            'agama_ibu' => 'required|string',
            'pekerjaan_ibu' => 'required|string',
            'penghasilan_ibu' => 'required|string',
            'ktp_ibu' => 'required|file|mimes:pdf,jpeg,png,jpg|max:1024',

            'nama_wali' => 'nullable|string',
            'no_hp_wali' => 'nullable|string|max:15',
            'penghasilan_wali' => 'nullable|string',
            'ktp_wali' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',

            'foto' => 'required|file|mimes:jpeg,png,jpg|max:1024',
            'akte' => 'required|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'suratbaik' => 'required|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'suratlulus' => 'required|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'rapor' => 'required|file|mimes:pdf|max:1024',
            'kk' => 'required|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'lampiran_prestasi' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',
            'undangan' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:1024',

        ], $messages, $attributes); 

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $safeData = $validator->validated();

        try {
            $fotoPath = $request->file('foto')->store('pendaftar_photos', 'public');
            $ktp_ayahPath = $request->file('ktp_ayah')->store('pendaftar_ktpayah', 'public');
            $ktp_ibuPath = $request->file('ktp_ibu')->store('pendaftar_ktpibu', 'public');
            $aktePath = $request->file('akte')->store('pendaftar_akte', 'public');
            $suratbaikPath = $request->file('suratbaik')->store('pendaftar_suratbaik', 'public');
            $suratlulusPath = $request->file('suratlulus')->store('pendaftar_suratlulus', 'public');
            $raporPath = $request->file('rapor')->store('pendaftar_rapor', 'public');
            $kkPath = $request->file('kk')->store('pendaftar_kk', 'public');

            $ktp_waliPath = $request->hasFile('ktp_wali') ? $request->file('ktp_wali')->store('pendaftar_ktpwali', 'public') : null;
            $lampiranPath = $request->hasFile('lampiran_prestasi') ? $request->file('lampiran_prestasi')->store('prestasi_pendaftar', 'public') : null;
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

            return redirect()->route('pendaftaran.sukses')->with([
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
            return redirect()->route('pendaftaran.index');
        }
        return view('siswa.sukses');
    }
}