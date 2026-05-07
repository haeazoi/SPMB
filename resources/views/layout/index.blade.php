<!doctype html>
<html lang="utf-8">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SPMB &mdash; SMK Migas Bumi Melayu Riau</title>
    <link rel="icon" href="{{ asset('/asset/img/logo.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/animate.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/owl.carousel.min.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/all.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/themify-icons.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/magnific-popup.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/slick.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('/admin/css/style.css') }}">
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ url('/') }}"> <img
                                src="{{ asset('/asset/img/smk.png') }}" alt="logo" width="110"></a>
                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex">
                            @if (Auth::check())
                                <a href="{{ url('logout') }}" class="btn-login">Log Out</a>
                            @else
                                <a href="{{ url('login') }}" class="btn-login">Login</a>
                            @endif
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <section>
        @yield('content')
    </section>

    <!--::footer_part start::-->
    <footer class="footer_part">
        <div class="copyright_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="copyright_text">
                            <P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy; SMK MIGAS BUMI MELAYU RIAU
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </P>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer_icon social_icon">
                            <ul class="list-unstyled">
                                <li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li><a href="https://wa.me/+6281270141215" class="single_social_icon"><i
                                            class="fab fa-whatsapp"></i></a>
                                </li>
                                <li><a href="#" class="single_social_icon"><i class="fab fa-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--::footer_part end::-->

    <!-- jquery plugins here-->
    <script src="{{ asset('/admin/js/jquery-1.12.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('/admin/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('/admin/js/bootstrap.min.js') }}"></script>
    <!-- easing js -->
    <script src="{{ asset('/admin/js/jquery.magnific-popup.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('/admin/js/swiper.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('/admin/js/masonry.pkgd.js') }}"></script>
    <!-- particles js -->
    <script src="{{ asset('/admin/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.nice-select.min.js') }}"></script>
    <!-- slick js -->
    <script src="{{ asset('/admin/js/slick.min.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('/admin/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('/admin/js/contact.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.form.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admin/js/mail-script.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('/admin/js/custom.js') }}"></script>
</body>

</html>
