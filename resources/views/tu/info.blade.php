@extends('layout.admin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <h4>Informasi SPMB</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="tabel2" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center text-bold">
                                        <th> NO </th>
                                        <th> Informasi SPMB </th>
                                        <th> Pendaftar </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $no=1;
                                            foreach ($info as $value) {
                                        ?>
                                    <tr class="text-center">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->jenis }}</td>
                                        <td>{{ $value->jml_siswa->count() }}</td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
