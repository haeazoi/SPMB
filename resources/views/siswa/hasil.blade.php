@extends('layout.index')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pengumuman">
                        @if ($hasil == 'Lulus')
                            <div class="pengumuman_item" style="margin-top: 100px;">
                                <div>
                                    <h2>Selamat, {{ $namaSiswa }}<br>
                                        Anda Diterima!
                                    </h2>
                                    <p>Setelah melalui seluruh tahapan seleksi, Anda dinyatakan diterima di SMK Migas
                                        Bumi Melayu Riau.

                                        Langkah berikutnya adalah menunjukan halaman pendaftaran ini sebagai bukti sah
                                        kelulusan Anda ke sekolah.</p>
                                </div>
                                <img src="{{ asset('asset/img/lulus.png') }}">
                            </div>
                        @elseif ($hasil == 'Menunggu')
                            <div class="pengumuman_item" style="margin-top: 100px;">
                                <div>
                                    <h2>Pembayaran, {{ $namaSiswa }}<br>
                                        Sedang Diproses!
                                    </h2>
                                </div>
                                <img src="{{ asset('asset/img/bingung.jpeg') }}">
                            </div>
                        @elseif ($hasil == 'Tidak Lulus')
                            <div class="pengumuman_item" style="margin-top: 50px;">
                                <div>
                                    <h2>Maaf, {{ $namaSiswa }}<br>
                                        Anda Tidak Diterima!
                                    </h2>
                                    <p>Mohon maaf, berdasarkan hasil akhir seleksi Sistem Penerimaan Murid Baru (SPMB) SMK
                                        MIGAS BUMI MELAYU RIAU dinyatakan tidak lulus.</p>
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
