<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPMB &mdash; SMK Migas Bumi Melayu Riau</title>
    <link href="{{ asset('/asset/img/logo.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('/asset/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .is-invalid {
            border: 1px solid red !important;
        }

        .invalid-feedback {
            color: red;
            font-size: 0.85em;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <header class="app-header">
        <div class="logo-section">
            <img src="{{ asset('asset/img/logo.png') }}" width="40" alt="Logo">
            <span class="logo-text">Sistem Penerimaan Murid Baru (SPMB)</span>
        </div>
        <div class="tahun-ajaran">
            SPMB Tahun Ajaran 2026/2027
        </div>
    </header>

    <div class="container">
        <div class="stepper" id="stepper">
            <div class="step active" data-step="1">
                <span class="step-number">1</span> Ketentuan
            </div>
            <div class="step" data-step="2">
                <span class="step-number">2</span> Data Siswa
            </div>
            <div class="step" data-step="3">
                <span class="step-number">3</span> Data Ortu / Wali
            </div>
            {{-- <div class="step" data-step="4">
                @if ($jalur->nama_jalur == 'Undangan')
                    <span class="step-number">4</span> Data Undangan
                @elseif($jalur->nama_jalur == 'Prestasi')
                    <span class="step-number">4</span> Data Prestasi
                @else
                    <span class="step-number">4</span> Data Prestasi
                @endif
            </div> --}}
            <div class="step" data-step="5">
                <span class="step-number">5</span> Dokumen
            </div>
        </div>

        <form action="{{ url('/pendaftaran') }}" class="content-box" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div
                    style="background-color: #fdd; border: 1px solid red; padding: 10px; margin: 10px auto; max-width: 800px;">
                    <p style="font-weight: bold;">Terjadi Kesalahan Validasi:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('error'))
                <div
                    style="background-color: #fdd; border: 1px solid red; padding: 10px; margin: 10px auto; max-width: 800px; color: #a94442;">
                    <p style="font-weight: bold;">Pendaftaran Gagal!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            {{-- Langkah 1: Ketentuan --}}
            <div class="content-step active" data-step="1">
                <div class="subheader-box">Ketentuan SPMB</div>
                <ol class="ketentuan-list">
                    <li>Data-data yang diisikan pada form SPMB harus sesuai dengan data asli dan benar adanya.</li>
                    <li>Calon peserta didik baru yang sudah mendaftarkan diri melalui SPMB akan mendapatkan Nomor
                        Pendaftaran dan Password yang nantinya akan digunakan untuk akses informasi yang berkaitan
                        dengan SPMB SMK Migas Bumi Melayu Riau.</li>
                    <li>Pastikan untuk menyimpan dan mencetak form pendaftaran online untuk keperluan dokumentasi SPMB
                        SMK Migas Bumi Melayu Riau.</li>
                    <li>Uang pendaftaran yang telah dibayarkan tidak dapat ditarik kembali.</li>
                </ol>

                <p>Apakah anda setuju dengan ketentuan diatas?</p>
                <input type="radio" required name="aggrement" value="setuju" id="aggrement" style="min-1">
                <label for="aggrement">Ya, Saya sudah baca dan saya setuju</label>
                @error('aggrement')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="nav-buttons">
                    <button type="button" class="btn btn-primary" onclick="nextStep(2)">Lanjut ke Data
                        Siswa</button>
                </div>
            </div>

            {{-- Langkah 2: Data Siswa (Perubahan Kritis) --}}
            <div class="content-step" data-step="2">
                <div class="subheader-box">Data Siswa</div>

                <div class="form-row">
                    <div class="form-label-col">NISN</div>
                    <div class="form-input-col">
                        <input type="number" name="nisn" placeholder="Masukkan NISN Calon Siswa" required
                            value="{{ old('nisn') }}" maxlength="10" pattern="[10]{10}"
                            oninput="validateAndTruncate(this, 10, 10, 'NISN harus 10 digit.')">
                        @error('nisn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="nisn-validation-feedback" style="display: none;"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Nama Lengkap</div>
                    <div class="form-input-col">
                        <input type="text" name="name" placeholder="Masukkan Nama Calon Siswa" required
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- <input type="hidden" name="id_jalur" value="{{ $jalur->id }}"> --}}

                <div class="form-row">
                    <div class="form-label-col">Foto</div>
                    <div class="form-input-col">
                        <input type="file" name="foto" id="foto" placeholder="Masukkan Foto Calon Siswa"
                            required>
                        <span class="input-hint">*Max ukuran: 300 KB</span>
                        @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">NIK</div>
                    <div class="form-input-col">
                        <input type="number" name="nik" placeholder="Masukkan NIK Pribadi Calon Siswa" required
                            value="{{ old('nik') }}" maxlength="16" pattern="[16]{16}"
                            oninput="validateAndTruncate(this, 16, 16, 'NIK harus 16 digit.')">
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="nik-validation-feedback" style="display: none;"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Email</div>
                    <div class="form-input-col">
                        <input type="email" name="email" placeholder="Masukkan Email Pribadi Calon Siswa"
                            required value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tambahan field Tinggi dan Berat Badan --}}
                <div class="form-row">
                    <div class="form-label-col">Tinggi Badan (cm)</div>
                    <div class="form-input-col">
                        <input type="number" name="tinggi_badan" placeholder="Masukkan Tinggi Badan" required
                            value="{{ old('tinggi_badan') }}">
                        @error('tinggi_badan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Berat Badan (kg)</div>
                    <div class="form-input-col">
                        <input type="number" name="berat_badan" placeholder="Masukkan Berat Badan" required
                            value="{{ old('berat_badan') }}">
                        @error('berat_badan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Telepon Rumah</div>
                    <div class="form-input-col">
                        <input type="number" name="telp_rumah" placeholder="Masukkan Telepon Rumah Calon Siswa"
                            value="{{ old('telp_rumah') }}" minlength="10" maxlength="15" pattern="[0-9]{10,15}"
                            oninput="validateAndTruncate(this, 10, 15, 'Nomor Telp Rumah harus antara 10 sampai 15 digit.')">
                        @error('telp_rumah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="telp_rumah-validation-feedback" style="display: none;">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">No HP</div>
                    <div class="form-input-col">
                        <input type="number" name="no_hp" placeholder="Masukkan No HP Pribadi Calon Siswa"
                            required value="{{ old('no_hp') }}" minlength="10" maxlength="15"
                            pattern="[0-9]{10,15}"
                            oninput="validateAndTruncate(this, 10, 15, 'Nomor HP harus antara 10 sampai 15 digit.')">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="no_hp-validation-feedback" style="display: none;"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Tempat Kelahiran</div>
                    <div class="form-input-col">
                        <input type="text" name="tempat_lahir" placeholder="Masukkan Tempat Kelahiran Calon Siswa"
                            required value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Tanggal Kelahiran</div>
                    <div class="form-input-col">
                        <input type="date" name="tanggal_lahir" required value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Agama</div>
                    <div class="form-input-col">
                        <input type="text" name="agama" placeholder="Masukkan Agama" required
                            value="{{ old('agama') }}">
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Jenis Kelamin</div>
                    <div class="form-input-col">
                        <select name="jenis_kelamin" required>
                            <option value="" hidden="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Kewarganegaraan</div>
                    <div class="form-input-col">
                        <select name="kewarganegaraan" required>
                            <option value="" hidden="">Pilih Kewarganegaraan</option>
                            <option value="WNI" {{ old('kewarganegaraan') == 'WNI' ? 'selected' : '' }}>Warga
                                Negara Indonesia (WNI)</option>
                            <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>Warga
                                Negara Asing (WNA)</option>
                        </select>
                        @error('kewarganegaraan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Berkebutuhan Khusus</div>
                    <div class="form-input-col">
                        <input type="text" name="kebutuhan_khusus"
                            placeholder="Isi Jika Memiliki Kebutuhan Khusus" value="{{ old('kebutuhan_khusus') }}">
                        @error('kebutuhan_khusus')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Alamat</div>
                    <div class="form-input-col">
                        <input type="text" name="alamat" placeholder="Masukkan Alamat Calon Siswa" required
                            value="{{ old('alamat') }}">
                        <span class="input-hint">*Sesuai dengan Kartu Keluarga (KK)</span>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">RT</div>
                    <div class="form-input-col">
                        <input type="number" name="rt" placeholder="Masukkan RT Calon Siswa" required
                            value="{{ old('rt') }}" maxlength="3" pattern="[3]{3}"
                            oninput="validateAndTruncate(this, 3, 3, 'RT harus 3 digit.')">
                        @error('rt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="rt-validation-feedback" style="display: none;"></div>
                    </div>
                    <div class="form-label-col">RW</div>
                    <div class="form-input-col">
                        <input type="number" name="rw" placeholder="Masukkan RW Calon Siswa" required
                            value="{{ old('rw') }}" maxlength="3" pattern="[3]{3}"
                            oninput="validateAndTruncate(this, 3, 3, 'RW harus 3 digit.')">
                        @error('rw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="rw-validation-feedback" style="display: none;"></div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Kelurahan</div>
                    <div class="form-input-col">
                        <input type="text" name="kelurahan" placeholder="Masukkan Kelurahan Calon Siswa" required
                            value="{{ old('kelurahan') }}">
                        @error('kelurahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Kecamatan</div>
                    <div class="form-input-col">
                        <input type="text" name="kecamatan" placeholder="Masukkan Kecamatan Calon Siswa" required
                            value="{{ old('kecamatan') }}">
                        @error('kecamatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Kabupaten / Kota</div>
                    <div class="form-input-col">
                        <input type="text" name="kota_kab" placeholder="Masukkan Kabupaten / Kota Calon Siswa"
                            required value="{{ old('kota_kab') }}">
                        @error('kota_kab')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Provinsi</div>
                    <div class="form-input-col">
                        <input type="text" name="provinsi" placeholder="Masukkan Provinsi Calon Siswa" required
                            value="{{ old('provinsi') }}">
                        @error('provinsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Sekolah Asal</div>
                    <div class="form-input-col">
                        <input type="text" name="sekolah" placeholder="Masukkan Sekolah Asal Calon Siswa" required
                            value="{{ old('sekolah') }}">
                        @error('sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">No. KIP</div>
                    <div class="form-input-col">
                        <input type="text" name="kip" placeholder="Masukkan No KIP Calon Siswa"
                            value="{{ old('kip') }}">
                        <span class="input-hint">*Jika mempunyai KIP</span>
                        @error('kip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Jenis Tinggal</div>
                    <div class="form-input-col">
                        <select name="jenis_tinggal" required>
                            <option value="" hidden="">Pilih Jenis Tinggal</option>
                            <option value="Orang Tua" {{ old('jenis_tinggal') == 'Orang Tua' ? 'selected' : '' }}>
                                Orang Tua</option>
                            <option value="Wali" {{ old('jenis_tinggal') == 'Wali' ? 'selected' : '' }}>Wali
                            </option>
                            <option value="Sendiri" {{ old('jenis_tinggal') == 'Sendiri' ? 'selected' : '' }}>Sendiri
                            </option>
                        </select>
                        @error('jenis_tinggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Jarak Ke Sekolah</div>
                    <div class="form-input-col">
                        <select name="jarak" required>
                            <option value="" hidden="">Pilih Jarak ke Sekolah</option>
                            <option value="Kurang" {{ old('jarak') == 'Kurang' ? 'selected' : '' }}>Kurang dari 1 KM
                            </option>
                            <option value="Lebih" {{ old('jarak') == 'Lebih' ? 'selected' : '' }}>Lebih dari 1 KM
                            </option>
                        </select>
                        @error('jarak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Transportasi</div>
                    <div class="form-input-col">
                        <select name="transportasi" required>
                            <option value="" hidden="">Pilih Transportasi</option>
                            <option value="Jalan Kaki" {{ old('transportasi') == 'Jalan Kaki' ? 'selected' : '' }}>
                                Jalan Kaki</option>
                            <option value="Sepeda" {{ old('transportasi') == 'Sepeda' ? 'selected' : '' }}>Sepeda
                            </option>
                            <option value="Motor" {{ old('transportasi') == 'Motor' ? 'selected' : '' }}>Motor
                            </option>
                            <option value="Mobil" {{ old('transportasi') == 'Mobil' ? 'selected' : '' }}>Mobil
                            </option>
                            <option value="Transportasi Umum"
                                {{ old('transportasi') == 'Transportasi Umum' ? 'selected' : '' }}>Transportasi Umum
                            </option>
                        </select>
                        @error('transportasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- <div class="form-row">
                    <div class="form-label-col">Jurusan yang Diminati</div>
                    <div class="form-input-col">
                        <select type="select" class="form-control" name="id_jurusan" id="id_jurusan" required>
                            <option value="" hidden="">Pilih Jurusan yang Diminati</option>
                            @foreach ($jurusan as $j)
                                <option value="{{ $j->id }}"
                                    {{ old('id_jurusan') == $j->id ? 'selected' : '' }}>{{ $j->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}

                {{-- <div class="form-row">
                    <div class="form-label-col">Ukuran Baju</div>
                    <div class="form-input-col">
                        <select type="select" class="form-control" name="id_baju" id="id_baju" required>
                            <option value="" hidden="">Pilih Ukuran Baju</option>
                            @foreach ($baju as $b)
                                <option value="{{ $b->id }}" {{ old('id_baju') == $b->id ? 'selected' : '' }}>
                                    {{ $b->ukuran_baju }}</option>
                            @endforeach
                        </select>
                        @error('id_baju')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Dapat Info Pendaftaran</div>
                    <div class="form-input-col">
                        <select type="select" class="form-control" name="id_info" id="id_info" required>
                            <option value="" hidden="">Pilih Info Pendaftaran</option>
                            @foreach ($informasi as $i)
                                <option value="{{ $i->id }}" {{ old('id_info') == $i->id ? 'selected' : '' }}>
                                    {{ $i->jenis }}</option>
                            @endforeach
                        </select>
                        @error('id_info')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}

                <div class="nav-buttons">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Sebelumnya</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(3)">Lanjut ke Data Ortu /
                        Wali</button>
                </div>
            </div>

            {{-- Langkah 3: Data Ortu / Wali --}}
            <div class="content-step" data-step="3">
                <div class="subheader-box">Data Ayah</div>

                <div class="form-row">
                    <div class="form-label-col">Nama Ayah</div>
                    <div class="form-input-col">
                        <input type="text" name="nama_ayah" placeholder="Masukkan Nama Ayah Calon Siswa" required
                            value="{{ old('nama_ayah') }}">
                        @error('nama_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">No HP Ayah</div>
                    <div class="form-input-col">
                        <input type="number" name="no_hp_ayah" placeholder="Masukkan No HP Ayah Calon Siswa"
                            required value="{{ old('no_hp_ayah') }}" minlength="10" maxlength="15"
                            pattern="[0-9]{10,15}"
                            oninput="validateAndTruncate(this, 10, 15, 'Nomor HP harus antara 10 sampai 15 digit.')">
                        @error('no_hp_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="no_hp_ayah-validation-feedback" style="display: none;">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Status Ayah</div>
                    <div class="form-input-col">
                        <select name="status_ayah" required>
                            <option value="" hidden="">Pilih Status Ayah</option>
                            <option value="Hidup" {{ old('status_ayah') == 'Hidup' ? 'selected' : '' }}>Hidup
                            </option>
                            <option value="Wafat" {{ old('status_ayah') == 'Wafat' ? 'selected' : '' }}>Wafat
                            </option>
                        </select>
                        @error('status_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Kewarganegaraan Ayah</div>
                    <div class="form-input-col">
                        <select name="kewarganegaraan_ayah" required>
                            <option value="" hidden="">Pilih Kewarganegaraan</option>
                            <option value="WNI" {{ old('kewarganegaraan_ayah') == 'WNI' ? 'selected' : '' }}>Warga
                                Negara Indonesia (WNI)</option>
                            <option value="WNA" {{ old('kewarganegaraan_ayah') == 'WNA' ? 'selected' : '' }}>Warga
                                Negara Asing (WNA)</option>
                        </select>
                        @error('kewarganegaraan_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Pendidikan Ayah</div>
                    <div class="form-input-col">
                        <input type="text" name="pendidikan_ayah"
                            placeholder="Masukkan Pendidikan Ayah Calon Siswa" required
                            value="{{ old('pendidikan_ayah') }}">
                        @error('pendidikan_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Agama Ayah</div>
                    <div class="form-input-col">
                        <input type="text" name="agama_ayah" placeholder="Masukkan Agama Ayah Calon Siswa"
                            required value="{{ old('agama_ayah') }}">
                        @error('agama_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Pekerjaan Ayah</div>
                    <div class="form-input-col">
                        <input type="text" name="pekerjaan_ayah" placeholder="Masukkan Pekerjaan Ayah Calon Siswa"
                            required value="{{ old('pekerjaan_ayah') }}">
                        @error('pekerjaan_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Penghasilan Ayah</div>
                    <div class="form-input-col">
                        <input type="number" name="penghasilan_ayah"
                            placeholder="Masukkan Penghasilan Ayah Calon Siswa" required
                            value="{{ old('penghasilan_ayah') }}">
                        @error('penghasilan_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">KTP Ayah</div>
                    <div class="form-input-col">
                        <input type="file" name="ktp_ayah"
                            placeholder="Masukkan Foto KTP Ayah Calon Siswa" required
                            value="{{ old('ktp_ayah') }}">
                        @error('ktp_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="subheader-box">Data Ibu</div>

                <div class="form-row">
                    <div class="form-label-col">Nama Ibu</div>
                    <div class="form-input-col">
                        <input type="text" name="nama_ibu" placeholder="Masukkan Nama Ibu Calon Siswa" required
                            value="{{ old('nama_ibu') }}">
                        @error('nama_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">No HP Ibu</div>
                    <div class="form-input-col">
                        <input type="number" name="no_hp_ibu" placeholder="Masukkan No HP Ibu Calon Siswa" required
                            value="{{ old('no_hp_ibu') }}" minlength="10" maxlength="15" pattern="[0-9]{10,15}"
                            oninput="validateAndTruncate(this, 10, 15, 'Nomor HP harus antara 10 sampai 15 digit.')">
                        @error('no_hp_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="no_hp_ibu-validation-feedback" style="display: none;">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Status Ibu</div>
                    <div class="form-input-col">
                        <select name="status_ibu" required>
                            <option value="" hidden="">Pilih Status Ibu</option>
                            <option value="Hidup" {{ old('status_ibu') == 'Hidup' ? 'selected' : '' }}>Hidup
                            </option>
                            <option value="Wafat" {{ old('status_ibu') == 'Wafat' ? 'selected' : '' }}>Wafat
                            </option>
                        </select>
                        @error('status_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Kewarganegaraan Ibu</div>
                    <div class="form-input-col">
                        <select name="kewarganegaraan_ibu" required>
                            <option value="" hidden="">Pilih Kewarganegaraan</option>
                            <option value="WNI" {{ old('kewarganegaraan_ibu') == 'WNI' ? 'selected' : '' }}>Warga
                                Negara Indonesia (WNI)</option>
                            <option value="WNA" {{ old('kewarganegaraan_ibu') == 'WNA' ? 'selected' : '' }}>Warga
                                Negara Asing (WNA)</option>
                        </select>
                        @error('kewarganegaraan_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Pendidikan Ibu</div>
                    <div class="form-input-col">
                        <input type="text" name="pendidikan_ibu" placeholder="Masukkan Pendidikan Ibu Calon Siswa"
                            required value="{{ old('pendidikan_ibu') }}">
                        @error('pendidikan_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Agama Ibu</div>
                    <div class="form-input-col">
                        <input type="text" name="agama_ibu" placeholder="Masukkan Agama Ibu Calon Siswa" required
                            value="{{ old('agama_ibu') }}">
                        @error('agama_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Pekerjaan Ibu</div>
                    <div class="form-input-col">
                        <input type="text" name="pekerjaan_ibu" placeholder="Masukkan Pekerjaan Ibu Calon Siswa"
                            required value="{{ old('pekerjaan_ibu') }}">
                        @error('pekerjaan_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Penghasilan Ibu</div>
                    <div class="form-input-col">
                        <input type="number" name="penghasilan_ibu"
                            placeholder="Masukkan Penghasilan Ibu Calon Siswa" required
                            value="{{ old('penghasilan_ibu') }}">
                        @error('penghasilan_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">KTP Ibu</div>
                    <div class="form-input-col">
                        <input type="file" name="ktp_ibu"
                            placeholder="Masukkan Foto KTP Ibu Calon Siswa" required
                            value="{{ old('ktp_ibu') }}">
                        @error('ktp_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="subheader-box">Data Wali (jika ada)</div>

                <div class="form-row">
                    <div class="form-label-col">Nama Wali</div>
                    <div class="form-input-col">
                        <input type="text" name="nama_wali" placeholder="Masukkan Nama Wali Calon Siswa"
                            value="{{ old('nama_wali') }}">
                        @error('nama_wali')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">No HP Wali</div>
                    <div class="form-input-col">
                        <input type="number" name="no_hp_wali" placeholder="Masukkan No HP Wali Calon Siswa"
                            value="{{ old('no_hp_wali') }}" minlength="10" maxlength="15" pattern="[0-9]{10,15}"
                            oninput="validateAndTruncate(this, 10, 15, 'Nomor HP harus antara 10 sampai 15 digit.')">
                        @error('no_hp_wali')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback" id="no_hp_wali-validation-feedback" style="display: none;">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Penghasilan Wali</div>
                    <div class="form-input-col">
                        <input type="number" name="penghasilan_wali"
                            placeholder="Masukkan Penghasilan Wali Calon Siswa"
                            value="{{ old('penghasilan_wali') }}">
                        @error('penghasilan_wali')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">KTP Wali</div>
                    <div class="form-input-col">
                        <input type="file" name="ktp_wali"
                            placeholder="Masukkan Foto KTP Wali Calon Siswa"
                            value="{{ old('ktp_wali') }}">
                        @error('ktp_wali')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="nav-buttons">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Sebelumnya</button>
                    {{-- @if ($jalur->nama_jalur == 'Undangan')
                        <button type="button" class="btn btn-primary" onclick="nextStep(4)">Lanjut ke Data
                            Undangan</button>
                    @elseif($jalur->nama_jalur == 'Prestasi')
                        <button type="button" class="btn btn-primary" onclick="nextStep(4)">Lanjut ke Data
                            Prestasi</button>
                    @else --}}
                        <button type="button" class="btn btn-primary" onclick="nextStep(4)">Lanjut ke Data
                            Prestasi</button>
                    {{-- @endif --}}
                </div>
            </div>

            {{-- Langkah 4: Data Prestasi --}}
            {{-- <div class="content-step" data-step="4">
                <div class="subheader-box">
                    @if ($jalur->nama_jalur == 'Undangan')
                        Data Undangan
                    @elseif($jalur->nama_jalur == 'Prestasi')
                        Data Prestasi
                    @else
                        Data Prestasi
                    @endif
                </div>
                <div class="form-row">
                    <div class="form-label-col">
                        @if ($jalur->nama_jalur == 'Undangan')
                            Lampiran Surat Undangan
                        @else
                            Lampiran Prestasi
                        @endif
                    </div>
                    <div class="form-input-col">
                        @if ($jalur->nama_jalur == 'Undangan')
                            <input type="file" name="undangan" id="undangan" required>
                            @error('undangan')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        @elseif($jalur->nama_jalur == 'Prestasi')
                            <input type="file" name="lampiran_prestasi" id="lampiran_prestasi">
                            @error('lampiran_prestasi')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        @else
                            <input type="file" name="lampiran_prestasi" id="lampiran_prestasi">
                            @error('lampiran_prestasi')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        @endif

                        <span class="input-hint">
                            *(Format: PDF/JPG, Kapasitas Maksimal: 1 MB)
                        </span>
                    </div>
                </div>
                @if ($jalur->nama_jalur == 'Undangan')
                    <div class="form-row">
                        <div class="form-label-col">
                            Lampiran Prestasi
                        </div>
                        <div class="form-input-col">
                            <input type="file" name="lampiran_prestasi" id="lampiran_prestasi">
                        </div>
                    </div>
                @endif
                <div class="info-text">
                    @if ($jalur->nama_jalur == 'Undangan')
                        <p>Unggah lampiran surat undangan asli dari SMK Migas Bumi Melayu Riau.</p>
                        <p>Unggah seluruh dokumen pendukung prestasi dalam satu file PDF (jika ada).</p>
                    @elseif($jalur->nama_jalur == 'Prestasi')
                        <p>Unggah seluruh dokumen pendukung prestasi akademik atau non-akademik dalam satu file PDF.</p>
                    @else
                        <p>Unggah seluruh dokumen pendukung prestasi akademik atau non-akademik dalam satu file PDF
                            (jika ada).</p>
                    @endif
                </div>

                <div class="nav-buttons">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Sebelumnya</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(5)">Lanjut ke
                        Dokumen</button>
                </div>
            </div> --}}

            {{-- Langkah 5: Dokumen --}}
            <div class="content-step" data-step="5">
                <div class="subheader-box">Dokumen Pendukung</div>

                <div class="form-row">
                    <div class="form-label-col">Akte Kelahiran</div>
                    <div class="form-input-col">
                        <input type="file" name="akte" id="akte"
                            placeholder="Masukkan Prestasi Siswa">
                        <span class="input-hint">*Max ukuran: 1 MB, PDF/JPG/PNG</span>
                        @error('akte')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Kartu Keluarga</div>
                    <div class="form-input-col">
                        <input type="file" name="kk" id="kk"
                            placeholder="Masukkan Prestasi Siswa">
                        <span class="input-hint">*Max ukuran: 1 MB, PDF/JPG/PNG</span>
                        @error('kk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Ijazah/Surat Keterangan Lulus</div>
                    <div class="form-input-col">
                        <input type="file" name="suratlulus" id="suratlulus"
                            placeholder="Masukkan Prestasi Siswa">
                        <span class="input-hint">*Max ukuran: 1 MB, PDF/JPG/PNG</span>
                        @error('suratlulus')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Rapor Kelas 7,8, dan 9</div>
                    <div class="form-input-col">
                        <input type="file" name="rapor" id="rapor"
                            placeholder="Masukkan Prestasi Siswa">
                        <span class="input-hint">*Max ukuran: 1 MB, PDF</span>
                        @error('rapor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">Surat Keterangan Berkelakuan Baik</div>
                    <div class="form-input-col">
                        <input type="file" name="suratbaik" id="suratbaik"
                            placeholder="Masukkan Prestasi Siswa">
                        <span class="input-hint">*Max ukuran: 1 MB, PDF/JPG/PNG</span>
                        @error('suratbaik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <p>Mohon cek kembali semua data yang telah Anda masukkan. Pastikan semuanya benar sebelum anda menekan
                    tombol
                    <b>Selesai</b>.
                </p>
                <div class="nav-buttons">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(4)">Sebelumnya</button>
                    <button type="submit" class="btn btn-primary">Selesai & Kirim Data</button>
                </div>
            </div>
        </form>
    </div>

    <a href="https://wa.me/+6281270141215" class="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        // Inisialisasi langkah saat ini
        let currentStep = 1;
        const totalSteps = 5;

        // Fungsi untuk menampilkan langkah tertentu
        function showStep(stepNumber) {
            document.querySelectorAll('.content-step').forEach(stepContent => {
                stepContent.classList.remove('active');
            });
            const targetContent = document.querySelector(`.content-step[data-step="${stepNumber}"]`);
            if (targetContent) {
                targetContent.classList.add('active');
            }

            document.querySelectorAll('.step').forEach(stepNav => {
                stepNav.classList.remove('active');
            });
            const activeStepNav = document.querySelector(`.step[data-step="${stepNumber}"]`);
            if (activeStepNav) {
                activeStepNav.classList.add('active');
            }

            currentStep = stepNumber;
        }

        function validateStep(stepNumber) {
            const currentStepElement = document.querySelector(`.content-step[data-step="${stepNumber}"]`);
            if (!currentStepElement) return false;

            const inputs = currentStepElement.querySelectorAll('input[required], select[required], textarea[required]');

            let allValid = true;

            for (const input of inputs) {
                if (!input.reportValidity()) {
                    allValid = false;
                    break;
                }
            }
            return allValid;
        }

        function nextStep(targetStep) {
            const isStepValid = validateStep(currentStep);

            if (isStepValid && targetStep <= totalSteps) {
                showStep(targetStep);
            }
        }

        function prevStep(targetStep) {
            if (targetStep >= 1) {
                showStep(targetStep);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);

            document.querySelectorAll('.step').forEach(stepNav => {
                stepNav.addEventListener('click', (event) => {
                    const stepToNavigate = parseInt(event.currentTarget.getAttribute('data-step'));
                    if (stepToNavigate <= currentStep) {
                        showStep(stepToNavigate);
                    }
                });
            });
        });

        function validateAndTruncate(inputElement, minLength, maxLength, errorMessage) {
            let value = inputElement.value.trim();
            const realTimeFeedback = inputElement.closest('.form-input-col').querySelector(
                '.invalid-feedback[id*="validation-feedback"]');

            // --- 1. Logika Pemotongan ---
            if (value.length > maxLength) {
                // Potong string hanya sepanjang maxLength
                value = value.slice(0, maxLength);
                inputElement.value = value; // Update nilai input
            }
            const currentLength = value.length;

            const isInvalid = currentLength < minLength;

            if (isInvalid && currentLength > 0) {
                inputElement.classList.add('is-invalid');
                if (realTimeFeedback) {
                    realTimeFeedback.textContent = errorMessage;
                    realTimeFeedback.style.display = 'block';
                }
            } else if (currentLength > 0) {
                // Valid jika panjang sudah terpenuhi (karena kita sudah memotong yang lebih)
                inputElement.classList.remove('is-invalid');
                if (realTimeFeedback) {
                    realTimeFeedback.style.display = 'none';
                }
            } else {
                // Jika kosong
                inputElement.classList.remove('is-invalid');
                if (realTimeFeedback) {
                    realTimeFeedback.style.display = 'none';
                }
            }
        }
    </script>
</body>

</html>
