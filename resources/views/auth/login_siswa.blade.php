@extends('layout.index')
@section('content')
    <div class="login-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card login-card shadow-lg">
                        <div class="card-header text-center text-white">
                            <h4 class="mb-0" style="color: white">🔑 Login Pendaftar SPMB</h4>
                        </div>
                        <div class="card-body p-4">
                            <p class="text-center text-muted">Masukkan Nomor Pendaftaran dan NISN Anda.</p>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ url('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nomor Pendaftaran (Username)</label>
                                    <input type="text" class="form-control" id="no_pendaftaran" name="identifier"
                                        value="{{ old('identifier') }}" required autofocus placeholder="Cth: F-1678891234">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">NISN (Password)</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="nisn_input" name="password" required
                                            placeholder="Cth: 0012345678">
                                        <button class="btn btn-outline-secondary" type="button" id="toggleNisn"style="font-size: 14px;">
                                            Lihat
                                        </button>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-2 text-center">
                                    <button type="submit" class="btn_3">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <small class="text-muted">Lupa Password? Hubungi <a
                                    href="https://wa.me/+6281270141215">Admin.</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nisnInput = document.getElementById('nisn_input');
            const toggleButton = document.getElementById('toggleNisn');
            const toggleIcon = document.getElementById('nisnIcon'); // Untuk ikon/teks 'Lihat'/'Sembunyikan'

            if (toggleButton && nisnInput) {
                toggleButton.addEventListener('click', function() {
                    // Cek tipe input saat ini
                    const currentType = nisnInput.getAttribute('type');

                    // Tentukan tipe input baru dan teks tombol
                    if (currentType === 'password') {
                        nisnInput.setAttribute('type', 'text');
                        // Ubah teks menjadi Sembunyikan
                        toggleButton.innerText = 'Sembunyikan';
                    } else {
                        nisnInput.setAttribute('type', 'password');
                        // Ubah teks kembali menjadi Lihat
                        toggleButton.innerText = 'Lihat';
                    }
                });
            }
        });
    </script>
@endsection
