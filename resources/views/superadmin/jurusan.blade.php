@extends('layout.superadmin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <h4>Jurusan</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#AddJurusan">
                                Tambah Data
                            </button>
                            <table id="tabel2" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center text-bold">
                                        <th> NO </th>
                                        <th> Jurusan </th>
                                        <th> Siswa </th>
                                        <th> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $no=1;
                                            foreach ($jurusan as $value) {
                                        ?>
                                    <tr class="text-center">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->nama_jurusan }}</td>
                                        <td>{{ $value->jml_siswa->count() }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning"
                                                data-target="#EditJurusan{{ $value->id }}" data-toggle="modal"> <i
                                                    class="fas fa-pencil-alt"></i>Edit</button>
                                            <form action="{{ route('jurusan.destroy', $value->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger Hapus">
                                                    <i class="fas fa-trash"></i>Hapus</button>
                                            </form>
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

    <div class="modal fade" id="AddJurusan" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Jurusan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/superadmin/jurusan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text" class="form-control" name="nama_jurusan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success bg-gradien "> Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($jurusan as $j)
        <div class="modal fade" id="EditJurusan{{ $j->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/superadmin/jurusan/{{ $j->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Jurusan</label>
                                <input type="text" value="{{ $j->nama_jurusan }}" class="form-control"
                                    name="nama_jurusan" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success "> Simpan Perubahan </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
