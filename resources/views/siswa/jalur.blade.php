<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPMB &mdash; SMK Migas Bumi Melayu Riau</title>
    <link href="{{ asset('/asset/img/logo.png') }}" rel="icon">
    <link rel="stylesheet" href="{{ asset('/asset/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    <div class="registration-section">
        <div class="content-box">
            <div class="-box-header-content">
                <h1>Jalur Penerimaan Siswa Baru</h1>
            </div>
            <div class="box-body">
                <div class="jalur-grid">
    @foreach ($jalur as $j)
        <div class="jalur-card">
            <div class="jalur-icon">
                @if ($j->nama_jalur == 'Prestasi')
                    🎓
                @elseif($j->nama_jalur == 'Undangan')
                    📝
                @elseif($j->nama_jalur == 'Reguler')
                    🏢
                @else
                    🌟
                @endif
            </div>
            <h3>{{ $j->nama_jalur }}</h3>
            <p>{{ $j->deskripsi }}</p>
            
            <a href="{{ route('daftar.index', ['id_jalur' => $j->id]) }}" class="btn-daftar">
                Daftar Sekarang
            </a>
        </div>
    @endforeach
</div>
            </div>
        </div>
    </div>

    <a href="https://wa.me/+6281270141215" class="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
</body>

</html>
