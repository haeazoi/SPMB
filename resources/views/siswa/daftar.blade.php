<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPMB &mdash; SMK Migas Bumi Melayu Riau</title>
    <link href="{{ asset('/asset/img/logo.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('/asset/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

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
            <a href="{{ '/' }}">
                <img src="{{ asset('asset/img/logo.png') }}" width="40" alt="Logo">
            </a>
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
        </div>

        <form action="{{ url('/daftar') }}" class="content-box" method="POST" enctype="multipart/form-data">
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
                <center>
                    <img src="{{ asset('asset/img/roadmap.png') }}" width="50%">
                </center>
                <br>
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
                    <div class="form-label-col required">NISN </div>
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
                    <div class="form-label-col required">Nama Lengkap</div>
                    <div class="form-input-col">
                        <input type="text" name="name" placeholder="Masukkan Nama Calon Siswa" required
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <input type="hidden" name="id_jalur" value="{{ $jalur->id }}">

                <div class="form-row">
                    <div class="form-label-col required">Tempat dan Tanggal Kelahiran</div>
                    <div class="form-input-col">
                        <input type="text" name="tempat_lahir" placeholder="Masukkan Tempat Kelahiran Calon Siswa"
                            required value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col required">Agama</div>
                    <div class="form-input-col">
                        <select name="agama" required>
                            <option value="" hidden="">Pilih Agama</option>
                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>
                                Islam</option>
                            <option value="Kristen Protestan"
                                {{ old('agama') == 'Kristen Protestan' ? 'selected' : '' }}>
                                Kristen Protestan</option>
                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>
                                Katolik</option>
                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>
                                Hindu</option>
                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>
                                Buddha</option>
                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>
                                Konghucu</option>
                        </select>
                        @error('agama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col required">Jenis Kelamin</div>
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
                    <div class="form-label-col required">Alamat</div>
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
                    <div class="form-label-col required">No HP</div>
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
                    <div class="form-label-col required">Sekolah Asal</div>
                    <div class="form-input-col">
                        <input type="text" name="sekolah" placeholder="Masukkan Sekolah Asal Calon Siswa" required
                            value="{{ old('sekolah') }}">
                        @error('sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col">No. KIP </div>
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
                    <div class="form-label-col required">Jurusan yang Diminati</div>
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
                </div>

                <div class="form-row">
                    <div class="form-label-col required">
                        Lampiran Prestasi
                    </div>
                    <div class="form-input-col">
                        <div id="prestasi-container">
                            <div class="input-group mb-2" style="display: flex;">
                                <!-- rounded-end-0: menghilangkan lengkungan kanan input -->
                                <input type="file" name="lampiran_prestasi[]" class="form-control rounded-end-0"
                                    style="border-right: none;">

                                <!-- rounded-start-0: menghilangkan lengkungan kiri tombol -->
                                <button class="btn btn-outline-secondary rounded-start-0" type="button"
                                    class="add-prestasi-btn" style="border-left: 1px solid #ced4da; color: #6c757d;">
                                    Tambah
                                </button>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col required">Dapat Info Pendaftaran</div>
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
                </div>

                <div class="nav-buttons">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Sebelumnya</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(3)">Lanjut ke Data Ortu /
                        Wali</button>
                </div>
            </div>

            {{-- Langkah 3: Data Ortu / Wali --}}
            <div class="content-step" data-step="3">
                <div class="subheader-box">Data Orang Tua</div>

                <div class="form-row">
                    <div class="form-label-col required">Nama Ayah</div>
                    <div class="form-input-col">
                        <input type="text" name="nama_ayah" placeholder="Masukkan Nama Ayah Calon Siswa" required
                            value="{{ old('nama_ayah') }}">
                        @error('nama_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col required">No HP Ayah</div>
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
                    <div class="form-label-col required">Nama Ibu</div>
                    <div class="form-input-col">
                        <input type="text" name="nama_ibu" placeholder="Masukkan Nama Ibu Calon Siswa" required
                            value="{{ old('nama_ibu') }}">
                        @error('nama_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-label-col required">No HP Ibu</div>
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

                <div class="nav-buttons">
                    <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Sebelumnya</button>
                    <button type="submit" class="btn btn-primary">Selesai & Kirim Data</button>
                </div>
            </div>
        </form>
    </div>

    <a href="https://wa.me/+6281270141215" class="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const requiredAwal = ['aggrement', 'nisn', 'name', 'no_hp', 'tempat_lahir', 'sekolah', 'id_jalur', 'id_jurusan', 'id_info'];
            document.querySelectorAll('input, select, textarea').forEach(function(el) {
                const name = el.getAttribute('name');
                if (!name) return;
                const normalized = name.endsWith('[]') ? name.slice(0, -2) : name;
                if (!requiredAwal.includes(normalized)) {
                    el.removeAttribute('required');
                }
            });
        });
    </script>
    <script>
        // Inisialisasi langkah saat ini
        let currentStep = 1;
        const totalSteps = 3;

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
    <script>
        document.addEventListener('click', function(e) {
            if (e.target.innerText === 'Tambah') {
                const container = document.getElementById('prestasi-container');
                const newRow = document.createElement('div');
                newRow.className = 'input-group mb-2';
                newRow.style.display = 'flex';

                newRow.innerHTML = `
                <input type="file" name="lampiran_prestasi[]" class="form-control rounded-end-0 ms-2" style="border-right: none;">&nbsp;&nbsp;
                <button class="btn btn-outline-secondary ms-2 rounded-start-0 remove-prestasi" type="button" style="border-left: 1px solid #ced4da; color: #dc3545; !important;">
                    Hapus
                </button>
            `;

                container.appendChild(newRow);
            }

            if (e.target.classList.contains('remove-prestasi')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
</body>

</html>
