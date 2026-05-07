<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMK Migas Bumi Melayu Riau</title>
    <link href="{{ asset('/asset/img/logo.png') }}" rel="icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/toastr/toastr.min.css') }}">
    <style>
        .fl-wrapper {
            z-index: 9999 !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/tu/dashboard') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!--Profile-->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="{{ asset('asset/img/user.png') }}" class="img-circle elevation-2">
                            <br><br>
                            <h4>
                                {{ auth()->user()->name }}
                                <small></small>
                            </h4>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                            <a href="{{ url('/logout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                        </li>
                    </ul>
                </li>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('/asset/img/logo.png') }}">
                    </div>
                    <div class="info">
                        <a href="" class="d-block">SMK MIGAS<br>
                            Bumi Melayu Riau</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ url('tu/dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-laptop-code"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-header">SPMB</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-school"></i>
                                <p>Data Sekolah
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('jurusan') }}" class="nav-link pl-6">
                                        <i class="fas fa-book-reader nav-icon"></i>
                                        <p>Jurusan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('baju') }}" class="nav-link">
                                        <i class="fas fa-tshirt nav-icon"></i>
                                        <p>Baju</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('info') }}" class="nav-link">
                                        <i class="fa fa-sticky-note nav-icon"></i>
                                        <p>Informasi SPMB</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon far fa-address-card"></i>
                                <p>
                                    Seleksi Pendaftar
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('undangan') }}" class="nav-link pl-6">
                                        <i class="fas fa-envelope-open nav-icon"></i>
                                        <p>Jalur Undangan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('prestasi') }}" class="nav-link pl-6">
                                        <i class="fas fa-award nav-icon"></i>
                                        <p>Jalur Prestasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('reguler') }}" class="nav-link pl-6">
                                        <i class="far fa-file-alt nav-icon"></i>
                                        <p>Jalur Reguler</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-money-bill-wave"></i>
                                <p>
                                    Seleksi Pembayaran
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('pembayaran/undangan') }}" class="nav-link pl-6">
                                        <i class="fas fa-envelope-open nav-icon"></i>
                                        <p>Jalur Undangan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('pembayaran/prestasi') }}" class="nav-link pl-6">
                                        <i class="fas fa-award nav-icon"></i>
                                        <p>Jalur Prestasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('pembayaran/reguler') }}" class="nav-link pl-6">
                                        <i class="far fa-file-alt nav-icon"></i>
                                        <p>Jalur Reguler</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('siswa') }}" class="nav-link pl-6">
                                <i class="fas fa-user-friends nav-icon"></i>
                                <p>Data Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('orangtua') }}" class="nav-link pl-6">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Data Orang Tua Siswa</p>
                            </a>
                        </li>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Halo,
                                {{ auth()->user()->name }}
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('tu/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">
                                    {{ $title }}
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section>
                @yield('content')
            </section>
        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2026</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>SMK MIGAS BUMI MELAYU RIAU</b>
            </div>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('lte/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('lte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>

    @yield('script')

    <!-- buat tabel -->
    <script>
        $(function() {
            $("#tabel1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#tabel1_wrapper .col-md-6:eq(0)');
            $('#tabel2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });
    </script>

    <!-- buat sweetalert2 -->
    <script>
        if ($.fn.modal && $.fn.modal.Constructor) {
            $.fn.modal.Constructor.prototype._enforceFocus = function() {};
        }

        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });

            $('.Tambah').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Data baru telah berhasil disimpan ke dalam sistem.'
                })
            });

            $('.Edit').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Perubahan data telah berhasil diperbarui dan disimpan.'
                })
            });

            $('.Hapus').click(function(event) {
                // Mencegah aksi default (agar tidak langsung terhapus)
                event.preventDefault();

                // Simpan referensi tombol yang diklik
                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Konfirmasi Penghapusan',
                    text: "Apakah Anda yakin ingin menghapus data ini secara permanen? Tindakan ini tidak dapat dibatalkan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Ya, Hapus Permanen',
                    cancelButtonText: 'Batalkan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();

                        Swal.fire(
                            'Berhasil!',
                            'Data telah berhasil dihapus dari sistem secara permanen.',
                            'success'
                        );
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // Jika user klik "Batal"
                        Toast.fire({
                            icon: 'error',
                            title: 'Tindakan penghapusan data telah dibatalkan.'
                        });
                    }
                });
            });

            $('.Veriv').click(function(event) {
                // Mencegah aksi default form
                event.preventDefault();

                // Simpan referensi form
                var form = $(this).closest("form");

                var nama = $(this).data("name") || "pendaftar ini";

                Swal.fire({
                    title: 'Verifikasi Berkas?',
                    text: "Anda akan menyetujui berkas " + nama +
                        ". Data akan diteruskan ke bagian pembayaran.",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6', // Warna biru untuk verifikasi
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Ya, Verifikasi!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tampilkan loading sebentar sebelum submit
                        Swal.fire({
                            title: 'Memproses...',
                            text: 'Sedang memperbarui status dan menerbitkan tagihan.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        // Kirim form ke Controller
                        form.submit();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // Jika batal
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });

                        Toast.fire({
                            icon: 'info',
                            title: 'Verifikasi dibatalkan'
                        });
                    }
                });
            });
        });

        $('.Tolak').off('click').on('click', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            var form = $(this).closest("form");
            var nama = $(this).data("name") || "pendaftar ini";

            Swal.fire({
                title: 'Tolak Berkas?',
                text: "Berikan alasan penolakan untuk " + nama,
                icon: 'warning',
                input: 'textarea', // Menampilkan form input besar
                inputPlaceholder: 'Alasan Penolakan',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6e7881',
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusConfirm: false,

                heightAuto: false,
                backdrop: true,
                didOpen: () => {
                    const input = Swal.getInput();
                    if (input) {
                        input.focus(); // Paksa kursor masuk ke kotak teks
                    }
                },

                inputValidator: (value) => {
                    if (!value) {
                        return 'Alasan penolakan wajib diisi agar siswa tahu apa yang harus diperbaiki!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    var alasanPenolakan = result.value;

                    // Tambahkan input hidden secara manual sebelum submit
                    var hiddenInput = document.createElement("input");
                    hiddenInput.setAttribute("type", "hidden");
                    hiddenInput.setAttribute("name",
                        "alasan"); // Pastikan nama ini sama dengan di Controller
                    hiddenInput.setAttribute("value", alasanPenolakan);

                    // Pastikan form terdeteksi
                    var formElement = $(this).closest("form")[0];
                    formElement.appendChild(hiddenInput);

                    // Tampilkan loading
                    Swal.fire({
                        title: 'Menolak...',
                        text: 'Mengirim pemberitahuan penolakan ke siswa.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    formElement.submit();
                }
            });
        });

        // $('.Tolak').click(function(event) {
        //     event.preventDefault();
        //     var form = $(this).closest("form");
        //     var nama = $(this).data("name") || "pendaftar ini";

        //     Swal.fire({
        //         title: 'Tolak Berkas?',
        //         text: "Berkas Pendaftaran " + nama +
        //             " akan ditolak. Siswa harus mengisi formulir kembali.",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#d33', // Warna merah
        //         cancelButtonColor: '#6e7881',
        //         confirmButtonText: 'Ya, Tolak!',
        //         cancelButtonText: 'Batal',
        //         reverseButtons: true
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             Swal.fire({
        //                 title: 'Menolak...',
        //                 text: 'Mengirim pemberitahuan penolakan ke siswa.',
        //                 allowOutsideClick: false,
        //                 didOpen: () => {
        //                     Swal.showLoading();
        //                 }
        //             });
        //             form.submit();
        //         }
        //     });
        // });

        $(document).ready(function() {
            // KONFIRMASI LULUS/LUNAS
            $('.VerivBayar').click(function(event) {
                event.preventDefault();
                var form = $(this).closest("form");
                var nama = $(this).data("name") || "pendaftar ini";

                Swal.fire({
                    title: 'Konfirmasi Pembayaran?',
                    text: "Bukti transfer " + nama +
                        " akan dinyatakan valid dan siswa akan otomatis LULUS.",
                    icon: 'check-circle',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745', // Warna hijau
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Ya, Luluskan!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Memproses...',
                            text: 'Sedang memperbarui status pembayaran dan kelulusan.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
            });

            $('.TolakBayar').off('click').on('click', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();

                var form = $(this).closest("form");
                var nama = $(this).data("name") || "pendaftar ini";

                Swal.fire({
                    title: 'Tolak Pembayaran?',
                    text: "Berikan alasan penolakan untuk " + nama,
                    icon: 'warning',
                    input: 'textarea', // Menampilkan form input besar
                    inputPlaceholder: 'Alasan Penolakan',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Ya, Tolak!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    focusConfirm: false,

                    heightAuto: false,
                    backdrop: true,
                    didOpen: () => {
                        const input = Swal.getInput();
                        if (input) {
                            input.focus(); // Paksa kursor masuk ke kotak teks
                        }
                    },

                    inputValidator: (value) => {
                        if (!value) {
                            return 'Alasan penolakan wajib diisi agar siswa tahu apa yang harus diperbaiki!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var alasanPenolakan = result.value;

                        // Tambahkan input hidden secara manual sebelum submit
                        var hiddenInput = document.createElement("input");
                        hiddenInput.setAttribute("type", "hidden");
                        hiddenInput.setAttribute("name",
                            "alasan"); // Pastikan nama ini sama dengan di Controller
                        hiddenInput.setAttribute("value", alasanPenolakan);

                        // Pastikan form terdeteksi
                        var formElement = $(this).closest("form")[0];
                        formElement.appendChild(hiddenInput);

                        // Tampilkan loading
                        Swal.fire({
                            title: 'Menolak...',
                            text: 'Mengirim pemberitahuan penolakan ke siswa.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        formElement.submit();
                    }
                });
            });

            // KONFIRMASI TOLAK
            // $('.TolakBayar').click(function(event) {
            //     event.preventDefault();
            //     var form = $(this).closest("form");
            //     var nama = $(this).data("name") || "pendaftar ini";

            //     Swal.fire({
            //         title: 'Tolak Pembayaran?',
            //         text: "Pembayaran " + nama +
            //             " akan ditolak. Siswa harus mengunggah ulang bukti transfer.",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#d33', // Warna merah
            //         cancelButtonColor: '#6e7881',
            //         confirmButtonText: 'Ya, Tolak!',
            //         cancelButtonText: 'Batal',
            //         reverseButtons: true
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             Swal.fire({
            //                 title: 'Menolak...',
            //                 text: 'Mengirim pemberitahuan penolakan ke siswa.',
            //                 allowOutsideClick: false,
            //                 didOpen: () => {
            //                     Swal.showLoading();
            //                 }
            //             });
            //             form.submit();
            //         }
            //     });
            // });
        });
    </script>
</body>

</html>
