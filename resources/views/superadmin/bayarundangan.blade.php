@extends('layout.superadmin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center">
                                <h4>Pembayaran Jalur Undangan</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="tabel2" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center text-bold">
                                        <th>NO</th>
                                        <th>Nama Pendaftar</th>
                                        <th>Waktu Tagihan</th>
                                        <th>Status Bayar</th>
                                        <th>Bukti Bayar</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Hasil Seleksi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $no=1;
                                            foreach ($pembayaran as $bayar) {
                                        ?>
                                    <tr class="text-center">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $bayar->pendaftar->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($bayar->tgl_terbit)->format('d/m/Y H:i') }} WIB</td>
                                        <td>
                                            @if ($bayar->status_bayar == 'Belum Bayar')
                                                <span class="badge badge-warning">Belum Bayar</span>
                                            @elseif($bayar->status_bayar == 'Proses Verifikasi')
                                                <span class="badge badge-info">Proses Verifikasi</span>
                                            @else
                                                <span class="badge badge-success">Lunas</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($bayar->bukti_pembayaran)
                                                <a href="{{ asset('storage/' . $bayar->bukti_pembayaran) }}"
                                                    target="_blank">Bukti Pembayaran</a>
                                            @else
                                                <span class="text-muted small">Belum Upload</span>
                                            @endif
                                        </td>
                                        <td>{{ $bayar->tanggal_pembayaran ? \Carbon\Carbon::parse($bayar->tanggal_pembayaran)->format('d/m/Y') : '-' }}
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $bayar->status_hasil == 'Lulus' ? 'badge-success' : ($bayar->status_hasil == 'Tidak Lulus' ? 'badge-danger' : 'badge-secondary') }}">
                                                {{ $bayar->status_hasil }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info"
                                                data-target="#DetailSiswa{{ $bayar->pendaftar->id ?? '' }}"
                                                data-toggle="modal">
                                                <i class="fas fa-edit"></i> Detail
                                            </button>
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

    @foreach ($pembayaran as $b)
        @if (is_object($b) && $b->pendaftar)
            <div class="modal fade" id="DetailSiswa{{ $b->pendaftar->id }}" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Bukti Pembayaran {{ $b->pendaftar->name }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Foto</th>
                                                <th>Nama Orang Tua</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td> <a href="{{ asset('storage/' . $b->bukti_pembayaran) }}"
                                                        target="_blank" class="d-block mr-2">
                                                        <img src="{{ asset('storage/' . $b->bukti_pembayaran) }}"
                                                            width="100%">
                                                    </a>
                                                </td>
                                                <td>Ayah: {{ $b->pendaftar->nama_ayah }}<br><br>Ibu:
                                                    {{ $b->pendaftar->nama_ibu }}</td>
                                                {{-- <td style="padding: 25px">
                                                    @if ($b->bukti_pembayaran)
                                                        @if ($b->status_bayar != 'Lunas')
                                                            <form
                                                                action="{{ route('pembayaran.undangan.update', $b->pendaftar->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-success VerivBayar">
                                                                    Verifikasi Lunas & Luluskan
                                                                </button>
                                                            </form>
                                                            <br>
                                                            <form
                                                                action="{{ route('pembayaran.undangan.reject', $b->pendaftar->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger TolakBayar">
                                                                    Tolak Pembayaran
                                                                </button>
                                                            </form>
                                                        @else
                                                            <span class="badge badge-success p-2">
                                                                <i class="fas fa-check-circle"></i> Pembayaran Terverifikasi
                                                                (Lunas)
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-secondary p-2">
                                                            <i class="fas fa-clock"></i> Menunggu Upload Bukti
                                                        </span>
                                                    @endif
                                                </td> --}}
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
