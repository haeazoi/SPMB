<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPMB &mdash; Daftar Ulang</title>
    <link href="{{ asset('/asset/img/logo.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('/asset/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="app-header">
        <div class="logo-section">
            <a href="{{ '/' }}">
                <img src="{{ asset('asset/img/logo.png') }}" width="40" alt="Logo">
            </a>
            <span class="logo-text">Sistem Penerimaan Murid Baru (SPMB)</span>
        </div>
        <div class="tahun-ajaran">SPMB Tahun Ajaran 2026/2027</div>
    </header>

    <div class="container">
        <div class="stepper" id="stepper">
            <div class="step active" data-step="1"><span class="step-number">1</span> Data Siswa</div>
            <div class="step" data-step="2"><span class="step-number">2</span> Data Ortu / Wali</div>
            <div class="step" data-step="3"><span class="step-number">3</span> Dokumen</div>
            <div class="step" data-step="4"><span class="step-number">4</span> Pembayaran</div>
        </div>

        <form action="{{ route('daftar_ulang.submit') }}" class="content-box" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div style="background-color:#fdd;border:1px solid red;padding:10px;margin:10px auto;max-width:800px;">
                    <p style="font-weight:bold;">Terjadi Kesalahan Validasi:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="content-step active" data-step="1">
                <div class="subheader-box">Data Siswa (Daftar Ulang)</div>
                <div class="form-row"><div class="form-label-col required">NIK</div><div class="form-input-col"><input type="text" name="nik" value="{{ old('nik', $pendaftar->nik) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Email</div><div class="form-input-col"><input type="email" name="email" value="{{ old('email', $pendaftar->email) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Tanggal Lahir</div><div class="form-input-col"><input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pendaftar->tanggal_lahir) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Agama</div><div class="form-input-col"><input type="text" name="agama" value="{{ old('agama', $pendaftar->agama) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Kewarganegaraan</div><div class="form-input-col"><input type="text" name="kewarganegaraan" value="{{ old('kewarganegaraan', $pendaftar->kewarganegaraan) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Jenis Kelamin</div><div class="form-input-col"><input type="text" name="jenis_kelamin" value="{{ old('jenis_kelamin', $pendaftar->jenis_kelamin) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Tinggi Badan</div><div class="form-input-col"><input type="number" name="tinggi_badan" value="{{ old('tinggi_badan', $pendaftar->tinggi_badan) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Berat Badan</div><div class="form-input-col"><input type="number" name="berat_badan" value="{{ old('berat_badan', $pendaftar->berat_badan) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Alamat</div><div class="form-input-col"><input type="text" name="alamat" value="{{ old('alamat', $pendaftar->alamat) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">RT / RW</div><div class="form-input-col"><input type="text" name="rt" value="{{ old('rt', $pendaftar->rt) }}" required><input type="text" name="rw" value="{{ old('rw', $pendaftar->rw) }}" required style="margin-top:8px;"></div></div>
                <div class="form-row"><div class="form-label-col required">Kelurahan</div><div class="form-input-col"><input type="text" name="kelurahan" value="{{ old('kelurahan', $pendaftar->kelurahan) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Kecamatan</div><div class="form-input-col"><input type="text" name="kecamatan" value="{{ old('kecamatan', $pendaftar->kecamatan) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Kota/Kabupaten</div><div class="form-input-col"><input type="text" name="kota_kab" value="{{ old('kota_kab', $pendaftar->kota_kab) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Provinsi</div><div class="form-input-col"><input type="text" name="provinsi" value="{{ old('provinsi', $pendaftar->provinsi) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Jenis Tinggal</div><div class="form-input-col"><input type="text" name="jenis_tinggal" value="{{ old('jenis_tinggal', $pendaftar->jenis_tinggal) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Jarak</div><div class="form-input-col"><input type="text" name="jarak" value="{{ old('jarak', $pendaftar->jarak) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Transportasi</div><div class="form-input-col"><input type="text" name="transportasi" value="{{ old('transportasi', $pendaftar->transportasi) }}" required></div></div>
                <div class="form-row">
                    <div class="form-label-col required">Ukuran Baju</div>
                    <div class="form-input-col">
                        <select name="id_baju" required>
                            <option value="">Pilih Ukuran Baju</option>
                            @foreach ($baju as $size)
                                <option value="{{ $size->id }}" {{ old('id_baju', $pendaftar->id_baju) == $size->id ? 'selected' : '' }}>{{ $size->ukuran_baju }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="nav-buttons"><button type="button" class="btn btn-primary" onclick="nextStep(2)">Lanjut</button></div>
            </div>

            <div class="content-step" data-step="2">
                <div class="subheader-box">Data Orang Tua / Wali</div>
                <div class="form-row"><div class="form-label-col required">Nama Ayah</div><div class="form-input-col"><input type="text" name="nama_ayah" value="{{ old('nama_ayah', $pendaftar->nama_ayah) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">No HP Ayah</div><div class="form-input-col"><input type="text" name="no_hp_ayah" value="{{ old('no_hp_ayah', $pendaftar->no_hp_ayah) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Agama Ayah</div><div class="form-input-col"><input type="text" name="agama_ayah" value="{{ old('agama_ayah', $pendaftar->agama_ayah) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Kewarganegaraan Ayah</div><div class="form-input-col"><input type="text" name="kewarganegaraan_ayah" value="{{ old('kewarganegaraan_ayah', $pendaftar->kewarganegaraan_ayah) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Pendidikan Ayah</div><div class="form-input-col"><input type="text" name="pendidikan_ayah" value="{{ old('pendidikan_ayah', $pendaftar->pendidikan_ayah) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Pekerjaan Ayah</div><div class="form-input-col"><input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $pendaftar->pekerjaan_ayah) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Penghasilan Ayah</div><div class="form-input-col"><input type="text" name="penghasilan_ayah" value="{{ old('penghasilan_ayah', $pendaftar->penghasilan_ayah) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Status Ayah</div><div class="form-input-col"><input type="text" name="status_ayah" value="{{ old('status_ayah', $pendaftar->status_ayah) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Nama Ibu</div><div class="form-input-col"><input type="text" name="nama_ibu" value="{{ old('nama_ibu', $pendaftar->nama_ibu) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">No HP Ibu</div><div class="form-input-col"><input type="text" name="no_hp_ibu" value="{{ old('no_hp_ibu', $pendaftar->no_hp_ibu) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Agama Ibu</div><div class="form-input-col"><input type="text" name="agama_ibu" value="{{ old('agama_ibu', $pendaftar->agama_ibu) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Kewarganegaraan Ibu</div><div class="form-input-col"><input type="text" name="kewarganegaraan_ibu" value="{{ old('kewarganegaraan_ibu', $pendaftar->kewarganegaraan_ibu) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Pendidikan Ibu</div><div class="form-input-col"><input type="text" name="pendidikan_ibu" value="{{ old('pendidikan_ibu', $pendaftar->pendidikan_ibu) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Pekerjaan Ibu</div><div class="form-input-col"><input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $pendaftar->pekerjaan_ibu) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Penghasilan Ibu</div><div class="form-input-col"><input type="text" name="penghasilan_ibu" value="{{ old('penghasilan_ibu', $pendaftar->penghasilan_ibu) }}" required></div></div>
                <div class="form-row"><div class="form-label-col required">Status Ibu</div><div class="form-input-col"><input type="text" name="status_ibu" value="{{ old('status_ibu', $pendaftar->status_ibu) }}" required></div></div>
                <div class="nav-buttons">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Sebelumnya</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(3)">Lanjut</button>
                </div>
            </div>

            <div class="content-step" data-step="3">
                <div class="subheader-box">Dokumen Daftar Ulang</div>
                <div class="form-row"><div class="form-label-col required">Pas Foto</div><div class="form-input-col"><input type="file" name="foto" {{ !$pendaftar->foto ? 'required' : '' }}>@if($pendaftar->foto)<a href="{{ asset('storage/' . $pendaftar->foto) }}" target="_blank" class="input-hint d-block">Lihat dokumen saat ini</a>@endif</div></div>
                <div class="form-row"><div class="form-label-col required">Akta</div><div class="form-input-col"><input type="file" name="akte" {{ !$pendaftar->akte ? 'required' : '' }}>@if($pendaftar->akte)<a href="{{ asset('storage/' . $pendaftar->akte) }}" target="_blank" class="input-hint d-block">Lihat dokumen saat ini</a>@endif</div></div>
                <div class="form-row"><div class="form-label-col required">Surat Berkelakuan Baik</div><div class="form-input-col"><input type="file" name="suratbaik" {{ !$pendaftar->suratbaik ? 'required' : '' }}>@if($pendaftar->suratbaik)<a href="{{ asset('storage/' . $pendaftar->suratbaik) }}" target="_blank" class="input-hint d-block">Lihat dokumen saat ini</a>@endif</div></div>
                <div class="form-row"><div class="form-label-col required">Surat Lulus</div><div class="form-input-col"><input type="file" name="suratlulus" {{ !$pendaftar->suratlulus ? 'required' : '' }}>@if($pendaftar->suratlulus)<a href="{{ asset('storage/' . $pendaftar->suratlulus) }}" target="_blank" class="input-hint d-block">Lihat dokumen saat ini</a>@endif</div></div>
                <div class="form-row"><div class="form-label-col required">Rapor</div><div class="form-input-col"><input type="file" name="rapor" {{ !$pendaftar->rapor ? 'required' : '' }}>@if($pendaftar->rapor)<a href="{{ asset('storage/' . $pendaftar->rapor) }}" target="_blank" class="input-hint d-block">Lihat dokumen saat ini</a>@endif</div></div>
                <div class="form-row"><div class="form-label-col required">Kartu Keluarga</div><div class="form-input-col"><input type="file" name="kk" {{ !$pendaftar->kk ? 'required' : '' }}>@if($pendaftar->kk)<a href="{{ asset('storage/' . $pendaftar->kk) }}" target="_blank" class="input-hint d-block">Lihat dokumen saat ini</a>@endif</div></div>
                <div class="form-row"><div class="form-label-col required">KTP Ayah</div><div class="form-input-col"><input type="file" name="ktp_ayah" {{ !$pendaftar->ktp_ayah ? 'required' : '' }}>@if($pendaftar->ktp_ayah)<a href="{{ asset('storage/' . $pendaftar->ktp_ayah) }}" target="_blank" class="input-hint d-block">Lihat dokumen saat ini</a>@endif</div></div>
                <div class="form-row"><div class="form-label-col required">KTP Ibu</div><div class="form-input-col"><input type="file" name="ktp_ibu" {{ !$pendaftar->ktp_ibu ? 'required' : '' }}>@if($pendaftar->ktp_ibu)<a href="{{ asset('storage/' . $pendaftar->ktp_ibu) }}" target="_blank" class="input-hint d-block">Lihat dokumen saat ini</a>@endif</div></div>
                <div class="nav-buttons">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Sebelumnya</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(4)">Lanjut ke Pembayaran</button>
                </div>
            </div>

            <div class="content-step" data-step="4">
                <div class="subheader-box">Pembayaran Daftar Ulang</div>
                <div class="form-row">
                    <div class="form-label-col required">Bukti Pembayaran</div>
                    <div class="form-input-col">
                        <input type="file" name="bukti_pembayaran" {{ !($pembayaran->bukti_pembayaran ?? null) ? 'required' : '' }}>
                        <span class="input-hint">*Upload bukti transfer pembayaran</span>
                        @if ($pembayaran->bukti_pembayaran ?? null)
                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="input-hint d-block">Lihat bukti pembayaran saat ini</a>
                        @endif
                    </div>
                </div>
                <div class="nav-buttons">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Sebelumnya</button>
                    <button type="submit" class="btn btn-primary">Selesai & Kirim Daftar Ulang</button>
                </div>
            </div>
        </form>
    </div>

    <a href="https://wa.me/+6281270141215" class="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        let currentStep = 1;
        const totalSteps = 4;

        function showStep(stepNumber) {
            document.querySelectorAll('.content-step').forEach(stepContent => {
                stepContent.classList.remove('active');
            });
            const targetContent = document.querySelector(`.content-step[data-step="${stepNumber}"]`);
            if (targetContent) targetContent.classList.add('active');

            document.querySelectorAll('.step').forEach(stepNav => {
                stepNav.classList.remove('active');
            });
            const activeStepNav = document.querySelector(`.step[data-step="${stepNumber}"]`);
            if (activeStepNav) activeStepNav.classList.add('active');

            currentStep = stepNumber;
        }

        function validateStep(stepNumber) {
            const currentStepElement = document.querySelector(`.content-step[data-step="${stepNumber}"]`);
            if (!currentStepElement) return false;
            const inputs = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');
            for (const input of inputs) {
                if (!input.reportValidity()) return false;
            }
            return true;
        }

        function nextStep(targetStep) {
            const isStepValid = validateStep(currentStep);
            if (isStepValid && targetStep <= totalSteps) showStep(targetStep);
        }

        function prevStep(targetStep) {
            if (targetStep >= 1) showStep(targetStep);
        }

        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
        });
    </script>
</body>

</html>
