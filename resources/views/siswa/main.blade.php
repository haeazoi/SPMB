@extends('layout.index')
@section('content')
    <section class="banner_part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single_banner_slider">
                        <div class="row mt-lg-0 mt-5 align-items-center">
                            <div class="col-lg-7 col-12 mt-lg-0 mt-5">
                                <div class="banner_text">
                                    <div class="banner_text_iner">
                                        <h1>Sistem Penerimaan
                                            <br> Murid Baru (SPMB)</h1>
                                        <div class="banner_img d-lg-none d-block">
                                            <img src="{{ asset('asset/img/brosur.jpeg') }}">
                                        </div>
                                        <p>Telah dibuka Sistem Penerimaan Murid Baru (SPMB) SMK Migas Bumi Melayu Riau
                                            Tahun Ajaran 2026/2027</p>
                                        <a href="{{ url('jalur_pendaftaran') }}" class="btn_2">Daftar Sekarang</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 banner_img d-none d-lg-block">
                                <img src="{{ asset('asset/img/brosur.jpeg') }}" style="width: 80%; float: right;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
