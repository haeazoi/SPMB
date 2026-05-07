@extends('layout.admin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <h4>Ukuran Baju Siswa</h4>
                            </div>
                        </div>
                        <table id="tabel2" class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center text-bold">
                                    <th> NO </th>
                                    <th> Ukuran Baju </th>
                                    <th> Siswa </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                            $no=1;
                                            foreach ($baju as $value) {
                                        ?>

                                <tr class="text-center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $value->ukuran_baju }}</td>
                                    <td>{{ $value->jml_siswa->count() }}</td>
                                    <td>
                                    </td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
