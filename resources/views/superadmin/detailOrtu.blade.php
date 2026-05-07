@extends('layout.superadmin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <h4>Detail Orang Tua {{ $OrangTua->siswa->name }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                           <table id="tabel2" class="table table-bordered table-striped">
                            <tr class="text-center">
                                <th></th>
                                <th>Ayah</th>
                                <th>Ibu</th>
                                <th>Wali</th>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $OrangTua->nama_ayah }} </td>
                                <td>{{ $OrangTua->nama_ibu }} </td>
                                <td>{{ $OrangTua->nama_wali }} </td>
                            </tr>
                            <tr>
                                <th>KTP</th>
                                <td><a href="{{ asset('storage/' . $OrangTua->ktp_ayah) }}" target="_blank" class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $OrangTua->ktp_ayah) }}" width="150">
                                    </a></td>
                                <td><a href="{{ asset('storage/' . $OrangTua->ktp_ibu) }}" target="_blank" class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $OrangTua->ktp_ibu) }}" width="150">
                                    </a></td>
                                <td><a href="{{ asset('storage/' . $OrangTua->ktp_wali) }}" target="_blank" class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $OrangTua->ktp_wali) }}" width="150">
                                    </a></td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td>{{ $OrangTua->no_hp_ayah }} </td>
                                <td>{{ $OrangTua->no_hp_ibu }} </td>
                                <td>{{ $OrangTua->no_hp_wali }} </td>
                            </tr>
                            <tr>
                                <th>Penghasilan</th>
                                <td>Rp {{ number_format($OrangTua->penghasilan_ayah, 0, ',', '.') }} </td>
                                <td>Rp {{ number_format($OrangTua->penghasilan_ibu, 0, ',', '.') }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>{{ $OrangTua->pekerjaan_ayah }} </td>
                                <td>{{ $OrangTua->pekerjaan_ibu }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                                <td>{{ $OrangTua->pendidikan_ayah }} </td>
                                <td>{{ $OrangTua->pendidikan_ibu }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $OrangTua->status_ayah }} </td>
                                <td>{{ $OrangTua->status_ibu }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $OrangTua->agama_ayah }} </td>
                                <td>{{ $OrangTua->agama_ibu }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Kewarganegaraan</th>
                                <td>{{ $OrangTua->kewarganegaraan_ayah }} </td>
                                <td>{{ $OrangTua->kewarganegaraan_ibu }} </td>
                                <td></td>
                            </tr>
                        </table>
                            <hr>
                            <a href="superadmin/orangtua" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
