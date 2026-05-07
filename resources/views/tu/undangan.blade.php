@extends('layout.admin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <h4>Seleksi Pendaftaran Undangan</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('info'))
                                <div class="alert alert-info">
                                    {{ session('info') }}
                                </div>
                            @endif
                            <table id="tabel2" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center text-bold">
                                        <th>NO</th>
                                        <th>No Pendaftaran</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jurusan</th>
                                        <th>Surat Undangan</th>
                                        <th>Status Berkas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $no=1;
                                            foreach ($pendaftar as $daftar) {
                                        ?>
                                    <tr class="text-center">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $daftar->no_pendaftaran }}</td>
                                        <td>{{ $daftar->name }}</td>
                                        <td>{{ $daftar->jurusan->nama_jurusan }}</td>
                                        <td><a href="{{ asset('storage/' . $daftar->undangan) }}" target="_blank">Surat
                                                Undangan</a></td>
                                        <td>
                                            @if ($daftar->status_berkas == 'Menunggu')
                                                <span class="badge badge-warning">{{ $daftar->status_berkas }}</span>
                                            @elseif ($daftar->status_berkas == 'Terverifikasi')
                                                <span class="badge badge-success">{{ $daftar->status_berkas }}</span>
                                            @elseif ($daftar->status_berkas == 'Ditolak')
                                                <span class="badge badge-danger">{{ $daftar->status_berkas }}</span>
                                            @endif
                                        </td>
                                        <td><a href="#DetailSiswa{{ $daftar->id }}" data-toggle="modal">
                                                Detail Pendaftar</a>
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

    @foreach ($pendaftar as $d)
        <div class="modal fade" id="DetailSiswa{{ $d->id }}" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail {{ $d->no_pendaftaran }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>📝 Data Pribadi</h4>
                        <table id="tabel2" class="table table-bordered table-striped">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $d->name }}</td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td><a href="{{ asset('storage/' . $d->foto) }}" target="_blank" class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $d->foto) }}" width="150">
                                    </a></td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>{{ $d->jurusan->nama_jurusan }}</td>
                            </tr>
                            <tr>
                                <th>NISN</th>
                                <td>{{ $d->nisn }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{ $d->nik }}</td>
                            </tr>
                            <tr>
                                <th>NO KIP</th>
                                <td>{{ $d->KIP }}</td>
                            </tr>
                            <tr>
                                <th>NO HP</th>
                                <td>{{ $d->no_hp }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $d->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $d->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $d->agama }}</td>
                            </tr>
                            <tr>
                                <th>Asal Sekolah</th>
                                <td>{{ $d->sekolah }}</td>
                            </tr>
                            <tr>
                                <th>Kewarganegaraan</th>
                                <td>{{ $d->kewarganegaraan }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $d->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>Tinggi Badan</th>
                                <td>{{ $d->tinggi_badan }}</td>
                            </tr>
                            <tr>
                                <th>Kebutuhan Khusus</th>
                                <td>{{ $d->kebutuhan_khusus }}</td>
                            </tr>
                            <tr>
                                <th>Berat Badan</th>
                                <td>{{ $d->berat_badan }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $d->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Kelurahan</th>
                                <td>{{ $d->kelurahan }}</td>
                            </tr>
                            <tr>
                                <th>Kecamatan</th>
                                <td>{{ $d->kecamatan }}</td>
                            </tr>
                            <tr>
                                <th>Kabupaten/Kota</th>
                                <td>{{ $d->kota_kab }}</td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td>{{ $d->provinsi }}</td>
                            </tr>
                            <tr>
                                <th>RT</th>
                                <td>{{ $d->rt }}</td>
                            </tr>
                            <tr>
                                <th>RW</th>
                                <td>{{ $d->rw }}</td>
                            </tr>
                            <tr>
                                <th>Transportasi</th>
                                <td>{{ $d->transportasi }}</td>
                            </tr>
                            <tr>
                                <th>Jarak</th>
                                <td>{{ $d->jarak }} dari 1 KM</td>
                            </tr>
                            <tr>
                                <th>Tinggal</th>
                                <td>{{ $d->jenis_tinggal }}</td>
                            </tr>
                            <tr>
                                <th>Ukuran Baju</th>
                                <td>{{ optional($d->baju)->ukuran_baju ?? '-' }}</td>
                            </tr>
                        </table>
                        <h4>📝 Data Orang Tua/Wali</h4>
                        <table id="tabel2" class="table table-bordered table-striped">
                            <tr class="text-center">
                                <th></th>
                                <th>Ayah</th>
                                <th>Ibu</th>
                                <th>Wali</th>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $d->nama_ayah }} </td>
                                <td>{{ $d->nama_ibu }} </td>
                                <td>{{ $d->nama_wali }} </td>
                            </tr>
                            <tr>
                                <th>KTP</th>
                                <td><a href="{{ asset('storage/' . $d->ktp_ayah) }}" target="_blank" class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $d->ktp_ayah) }}" width="150">
                                    </a></td>
                                <td><a href="{{ asset('storage/' . $d->ktp_ibu) }}" target="_blank" class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $d->ktp_ibu) }}" width="150">
                                    </a></td>
                                <td><a href="{{ asset('storage/' . $d->ktp_wali) }}" target="_blank" class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $d->ktp_wali) }}" width="150">
                                    </a></td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td>{{ $d->no_hp_ayah }} </td>
                                <td>{{ $d->no_hp_ibu }} </td>
                                <td>{{ $d->no_hp_wali }} </td>
                            </tr>
                            <tr>
                                <th>Penghasilan</th>
                                <td>Rp {{ number_format($d->penghasilan_ayah, 0, ',', '.') }} </td>
                                <td>Rp {{ number_format($d->penghasilan_ibu, 0, ',', '.') }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>{{ $d->pekerjaan_ayah }} </td>
                                <td>{{ $d->pekerjaan_ibu }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                                <td>{{ $d->pendidikan_ayah }} </td>
                                <td>{{ $d->pendidikan_ibu }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $d->status_ayah }} </td>
                                <td>{{ $d->status_ibu }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $d->agama_ayah }} </td>
                                <td>{{ $d->agama_ibu }} </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Kewarganegaraan</th>
                                <td>{{ $d->kewarganegaraan_ayah }} </td>
                                <td>{{ $d->kewarganegaraan_ibu }} </td>
                                <td></td>
                            </tr>
                        </table>
                        <h4>📝 Dokumen Pribadi</h4>
                        <table id="tabel2" class="table table-bordered table-striped">
                            <tr>
                                <th>Undangan</th>
                                <td><a href="{{ asset('storage/' . $d->undangan) }}" target="_blank" class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $d->undangan) }}" width="150">
                                    </a></td>
                            </tr>
                            <tr>
                                <th>Prestasi</th>
                                <td>
                                    @forelse ($d->lampiran_prestasi_files as $no => $prestasiFile)
                                        <a href="{{ asset('storage/' . $prestasiFile) }}" target="_blank"
                                            class="d-block mb-2" title="Prestasi {{ $no + 1 }}">
                                            Prestasi {{ $no + 1 }}
                                        </a>
                                    @empty
                                        <span>-</span>
                                    @endforelse
                                </td>
                            </tr>
                            <tr>
                                <th>Akta Kelahiran</th>
                                <td><a href="{{ asset('storage/' . $d->akte) }}" target="_blank" class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $d->akte) }}" width="150">
                                    </a></td>
                            </tr>
                            <tr>
                                <th>Kartu Keluarga</th>
                                <td><a href="{{ asset('storage/' . $d->kk) }}" target="_blank" class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $d->kk) }}" width="150">
                                    </a></td>
                            </tr>
                            <tr>
                                <th>Surat Keterangan Berlakuan Baik</th>
                                <td><a href="{{ asset('storage/' . $d->suratbaik) }}" target="_blank" class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $d->suratbaik) }}" width="150">
                                    </a></td>
                            </tr>
                            <tr>
                                <th>Ijazah/Surat Keterangan Lulus</th>
                                <td><a href="{{ asset('storage/' . $d->suratlulus) }}" target="_blank"
                                        class="d-block mr-2">
                                        <img src="{{ asset('storage/' . $d->suratlulus) }}" width="150">
                                    </a></td>
                            </tr>
                            <tr>
                                <th>Rapor</th>
                                <td><a href="{{ asset('storage/' . $d->rapor) }}" target="_blank" class="d-block mr-2">
                                        <i class="fas fa-file">RAPOR {{ $d->name }}</i>
                                    </a></td>
                            </tr>
                        </table>
                        @if ($d->status_berkas == 'Menunggu')
                            <form action="{{ url('undangan/' . $d->id . '/Terverifikasi') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm Veriv">Lulus </button>
                            </form>
                            <form action="{{ url('undangan/' . $d->id . '/Ditolak') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm Tolak">Ditolak</button>
                            </form>
                        @else
                            <span class="badge badge-success p-2">
                                <i class="fas fa-check-circle"></i> Pendaftaran Terverifikasi
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
