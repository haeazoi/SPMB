@extends('layout.admin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <h4>Detail {{ $siswa->name }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4>📝 Data Pribadi</h4>
                            <table id="tabel2" class="table table-bordered table-striped">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $siswa->name }}</td>
                                </tr>
                                <tr>
                                    <th>Foto</th>
                                    <td><a href="{{ asset('storage/' . $siswa->foto) }}" target="_blank" class="d-block mr-2">
                                            <img src="{{ asset('storage/' . $siswa->foto) }}" width="150">
                                        </a></td>
                                </tr>
                                <tr>
                                    <th>Jurusan</th>
                                    <td>{{ $siswa->jurusan->nama_jurusan }}</td>
                                </tr>
                                <tr>
                                    <th>NISN</th>
                                    <td>{{ $siswa->nisn }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $siswa->nik }}</td>
                                </tr>
                                <tr>
                                    <th>NO KIP</th>
                                    <td>{{ $siswa->KIP }}</td>
                                </tr>
                                <tr>
                                    <th>NO HP</th>
                                    <td>{{ $siswa->no_hp }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ $siswa->tanggal_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat Lahir</th>
                                    <td>{{ $siswa->tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <th>Agama</th>
                                    <td>{{ $siswa->agama }}</td>
                                </tr>
                                <tr>
                                    <th>Asal Sekolah</th>
                                    <td>{{ $siswa->sekolah }}</td>
                                </tr>
                                <tr>
                                    <th>Kewarganegaraan</th>
                                    <td>{{ $siswa->kewarganegaraan }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Tinggi Badan</th>
                                    <td>{{ $siswa->tinggi_badan }}</td>
                                </tr>
                                <tr>
                                    <th>Kebutuhan Khusus</th>
                                    <td>{{ $siswa->kebutuhan_khusus }}</td>
                                </tr>
                                <tr>
                                    <th>Berat Badan</th>
                                    <td>{{ $siswa->berat_badan }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $siswa->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Kelurahan</th>
                                    <td>{{ $siswa->kelurahan }}</td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td>{{ $siswa->kecamatan }}</td>
                                </tr>
                                <tr>
                                    <th>Kabupaten/Kota</th>
                                    <td>{{ $siswa->kota_kab }}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td>{{ $siswa->provinsi }}</td>
                                </tr>
                                <tr>
                                    <th>RT</th>
                                    <td>{{ $siswa->rt }}</td>
                                </tr>
                                <tr>
                                    <th>RW</th>
                                    <td>{{ $siswa->rw }}</td>
                                </tr>
                                <tr>
                                    <th>Transportasi</th>
                                    <td>{{ $siswa->transportasi }}</td>
                                </tr>
                                <tr>
                                    <th>Jarak</th>
                                    <td>{{ $siswa->jarak }} dari 1 KM</td>
                                </tr>
                                <tr>
                                    <th>Tinggal</th>
                                    <td>{{ $siswa->jenis_tinggal }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $siswa->status_aktif }}</td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td>{{ $siswa->kelas }}</td>
                                </tr>
                                <tr>
                                    <th>Ukuran Baju</th>
                                    <td>{{ $siswa->baju->ukuran_baju }}</td>
                                </tr>
                            </table>
                            <br>
                            <h4>📝 Dokumen Pribadi</h4>
                            <table id="tabel2" class="table table-bordered table-striped">
                                <tr>
                                    <th>Prestasi</th>
                                    <td><a href="{{ asset('storage/' . $siswa->lampiran_prestasi) }}" target="_blank"
                                            class="d-block mr-2">
                                            <img src="{{ asset('storage/' . $siswa->lampiran_prestasi) }}" width="150">
                                        </a></td>
                                </tr>
                                <tr>
                                    <th>Akta Kelahiran</th>
                                    <td><a href="{{ asset('storage/' . $siswa->akte) }}" target="_blank" class="d-block mr-2">
                                            <img src="{{ asset('storage/' . $siswa->akte) }}" width="150">
                                        </a></td>
                                </tr>
                                <tr>
                                    <th>Kartu Keluarga</th>
                                    <td><a href="{{ asset('storage/' . $siswa->kk) }}" target="_blank" class="d-block mr-2">
                                            <img src="{{ asset('storage/' . $siswa->kk) }}" width="150">
                                        </a></td>
                                </tr>
                                <tr>
                                    <th>Surat Keterangan Berlakuan Baik</th>
                                    <td><a href="{{ asset('storage/' . $siswa->suratbaik) }}" target="_blank"
                                            class="d-block mr-2">
                                            <img src="{{ asset('storage/' . $siswa->suratbaik) }}" width="150">
                                        </a></td>
                                </tr>
                                <tr>
                                    <th>Ijazah/Surat Keterangan Lulus</th>
                                    <td><a href="{{ asset('storage/' . $siswa->suratlulus) }}" target="_blank"
                                            class="d-block mr-2">
                                            <img src="{{ asset('storage/' . $siswa->suratlulus) }}" width="150">
                                        </a></td>
                                </tr>
                                <tr>
                                    <th>Rapor</th>
                                    <td><a href="{{ asset('storage/' . $siswa->rapor) }}" target="_blank" class="d-block mr-2">
                                            <i class="fas fa-file">RAPOR {{ $siswa->name }}</i>
                                        </a></td>
                                </tr>
                            </table>
                            <hr>
                            <a href="/siswa" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
