@extends('layout.index')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Terima Kasih!<br>
                                Telah Mendaftar SPMB SMK Migas Bumi Melayu Riau
                            </h2>
                            @if (session('no_pendaftaran') && session('nisn'))
                                <p>Untuk melihat status pendaftaran anda lebih lanjut, silahkan login menggunakan:</p><br>
                                <center>
                                    <div class="progress-table-wrap">
                                        <table class="progress-table col-6">
                                            <thead>
                                                <tr class="table-head">
                                                    <th>No Pendaftaran</th>
                                                    <th>NISN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="table-row">
                                                    <td>{{ session('no_pendaftaran') }}</td>
                                                    <td>{{ session('nisn') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="mt-4 text-danger">⚠️ MOHON CATAT DAN SIMPAN INFORMASI DI ATAS DENGAN BAIK.
                                        </p>
                                    </div>
                                </center>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection