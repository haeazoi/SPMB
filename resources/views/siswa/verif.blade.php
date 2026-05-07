@extends('layout.index')
@section('content')
    @php
        $judul = 'Status Pendaftaran';
        $pesan = '';

        if ($status == 'Terverifikasi') {
            $judul = 'Selamat Datang, ' . $nama . '!';
            $pesan =
                'Kami informasikan bahwa berkas pendaftaran Anda telah kami terima dan diverifikasi. Untuk melanjutkan proses pendaftaran ke tahap berikutnya, mohon segera selesaikan pembayaran biaya pendaftaran sesuai dengan nominal yang tertera.';
        } elseif ($status == 'Menunggu') {
            $judul = 'Selamat Datang, ' . $nama . '!';
        } elseif ($status == 'Ditolak') {
            $judul = 'Mohon Maaf, ' . $nama;
        }
    @endphp
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>{{ $judul }}</h2>
                            <p>{{ $pesan }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="whole-wrap">
        <div class="container box_1170">
            @if ($status == 'Terverifikasi')
                <div class="section-top-border">
                    <h3 class="mb-30">Data Pembayaran Tagihan</h3>
                    <div class="progress-table-wrap">
                        <table class="progress-table">
                            <thead>
                                <tr class="table-head">
                                    <th>Bank</th>
                                    <th>Nama Penerima</th>
                                    <th>No Rekening</th>
                                    <th>Nominal Tagihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-row">
                                    <td> <img src="{{ asset('asset/img/BSI.png') }}" style="max-width: 200px;"></td>
                                    <td style="text-wrap: nowrap;">SMK MIGAS BUMI MELAYU RIAU</td>
                                    <td>2222005518</td>
                                    <td style="text-wrap: nowrap;">Rp {{ number_format($totalBayar, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="section-top-border">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="generic-blockquote">
                                    Batas Akhir Pembayaran: <strong class="text-danger">{{ $tanggalTerakhir }}</strong>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="section-top-border">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="mb-30">Masukkan Bukti Pembayaran</h3>
                                <form action="{{ url('/bayar') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group-icon mt-10">
                                        <div class="icon"><i class="fa fa-file" aria-hidden="true"></i></div>
                                        <input type="file" name="bukti_pembayaran"
                                            placeholder="Masukkan Bukti Pembayaran" required class="single-input">
                                    </div><br>
                                    <center>
                                        <button type="submit" class="btn_3">Unggah Bukti</button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($status == 'Menunggu')
                <div class="section-top-border text-center p-5">
                    <h3 class="mb-30">Sedang Diproses</h3>
                    <p>Berkas pendaftaran Anda telah kami terima dan saat ini sedang dalam proses verifikasi oleh tim
                        sekolah.</p>
                    <p>Mohon bersabar dan cek halaman ini secara berkala untuk mengetahui status terbaru Anda.</p>
                </div>
            @elseif ($status == 'Ditolak')
                <div class="section-top-border text-center p-5">
                    <h3 class="mb-30">Pendaftaran Ditolak</h3>
                    <p>Mohon maaf, pendaftaran Anda tidak dapat kami proses lebih lanjut.</p>
                    <p>Kemungkinan penyebab: Berkas tidak lengkap/tidak valid.</p>
                    <p>Untuk informasi detail, silakan hubungi kontak resmi kami dibawah.</p>
                </div>
            @endif
        @endsection
