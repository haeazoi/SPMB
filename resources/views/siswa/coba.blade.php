@extends('layout.index')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pengumuman">
                        @if ($status == 'Terverifikasi')
                            <div class="pengumuman_item" style="margin-top: 100px;">
                                <div>
                                    <h2>Selamat, {{ $nama }}<br>
                                        Anda Diterima!
                                    </h2>
                                    <p>Berdasarkan hasil verifikasi data pada Sistem Penerimaan Murid Baru (SPMB) SMK Migas Bumi Melayu Riau, Anda dinyatakan Diterima. Silakan lakukan Daftar Ulang dan melengkapi dokumen administrasi tambahan sesuai dengan petunjuk yang tertera.</p>
                                    <a href="{{ url('/') }}" class="btn_2">Daftar Ulang</a>
                                </div>
                                <img src="{{ asset('asset/img/lulus.png') }}">
                            </div>
                        @elseif ($status == 'Menunggu')
                            <div class="pengumuman_item" style="margin-top: 100px;">
                                <div>
                                    <h2>Pendaftaran, {{ $nama }}<br>
                                        Sedang Diproses!
                                    </h2>
                                    <p>Berkas pendaftaran Anda telah kami terima dan saat ini sedang dalam proses verifikasi
                                        oleh pihak sekolah.</p>
                                </div>
                                <img src="{{ asset('asset/img/bingung.jpeg') }}">
                            </div>
                        @elseif ($status == 'Ditolak')
                            <div class="pengumuman_item" style="margin-top: 50px;">
                                <div>
                                    <h2>Maaf, {{ $nama }}<br>
                                        Anda Tidak Diterima!
                                    </h2>
                                    <p>Mohon maaf, berdasarkan hasil verifikasi berkas pada Sistem Penerimaan Murid Baru
                                        (SPMB) SMK Migas Bumi Melayu Riau, Anda dinyatakan tidak lulus seleksi administrasi
                                        dikarenakan {{ $pembayaranSiswa->alasan }}.
                                    </p>
                                    <p>
                                        Silakan melakukan perbaikan sesuai dengan catatan tersebut.
                                    </p>
                                </div>
                                <img src="{{ asset('asset/img/sad.png') }}">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
