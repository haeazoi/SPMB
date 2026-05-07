@extends('layout.index')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>Selamat Datang di SPMB! <br> SMK MIGAS BUMI MELAYU RIAU</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="login_part ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <a href="{{ url('/login/siswa') }}" class="btn_3">Login sebagai Calon Siswa</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form text-center">
                        <div class="login_part_form_iner">
                            <a href="{{ url('login/tu') }}" class="btn_3">Login sebagai Admin</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
