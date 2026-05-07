@extends('layout.index')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Selamat Datang, nama</h2>
                            <p>Pendaftaran Anda telah diverifikasi dan Anda dinyatakan Lulus. Silakan lakukan daftar ulang dengan menyelesaikan pembayaran sesuai nominal yang tertera untuk mengamankan kuota kursi Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="whole-wrap">
        <div class="container box_1170">
            <div class="section-top-border">
                <h3 class="mb-30">Informasi Pendaftaran</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group-icon mt-10">
                            <div class="icon"><i class="fa fa-file" aria-hidden="true"></i></div>
                            <input type="text" name="bukti_pembayaran" placeholder="Masukkan NIK" required
                                class="single-input">
                        </div><br>
                        <div class="input-group-icon mt-10">
                            <div class="icon"><i class="fa fa-file" aria-hidden="true"></i></div>
                            <input type="file" name="bukti_pembayaran" placeholder="Masukkan Bukti Pembayaran" required
                                class="single-input">
                        </div><br>
                        <div class="input-group-icon mt-10">
                            <div class="icon"><i class="fa fa-file" aria-hidden="true"></i></div>
                            <input type="text" name="bukti_pembayaran" placeholder="Masukkan Bukti Pembayaran" required
                                class="single-input">
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
