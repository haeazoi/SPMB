@extends('layout.admin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <h4>Daftar Siswa</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="tabel2" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center text-bold">
                                        <th> NO </th>
                                        <th> Nama </th>
                                        <th> Jurusan </th>
                                        <th> Status </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $no=1;
                                            foreach ($siswa as $value) {
                                        ?>
                                        
                                    <tr class="text-center">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->jurusan->nama_jurusan }}</td>
                                        <td>{{ $value->status_aktif }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ url('detail/' . $value->id . '/siswa') }}"> Detail</a>
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
    </div>
@endsection
