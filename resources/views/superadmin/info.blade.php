@extends('layout.superadmin')
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
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#AddInfo">
                                Tambah Data
                            </button>
                            <table id="tabel2" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center text-bold">
                                        <th> NO </th>
                                        <th> Informasi SPMB </th>
                                        <th> Pendaftar </th>
                                        <th> Aksi </th>
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
                                        <td> <button class="btn btn-sm btn-warning"
                                                data-target="#EditInfo{{ $value->id }}"
                                                data-toggle="modal"><i class="fas fa-pencil-alt"></i>Edit</button>
                                            <form action="{{ route('info.destroy', $value->id) }}" method="POST">
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
    <div class="modal fade" id="AddInfo" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-default">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Informasi SPMB</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/superadmin/info" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Informasi</label>
                            <input type="text" class="form-control" name="jenis" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                       <button type="submit" class="btn btn-success bg-gradien"> Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($info as $j)
        <div class="modal fade" id="EditInfo{{ $j->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-default">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Informasi SPMB</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/superadmin/info/{{ $j->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Informasi</label>
                                <input type="text" value="{{ $j->jenis }}" class="form-control" name="jenis"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"> Simpan Perubahan </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
