<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
	<title>{{ config('app.name', 'Laravel') }} - {{ config('app.slogan', 'Laravel') }}</title>

    <meta name="description" content="WE DELIVER FRESH FRUITS & VEGETABLES">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
	<link rel="icon" href="{{ asset('assets/attachment/favicon.png') }}" type="image/png" />

    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="{{ asset('assets/welcome/css/animate.css') }}">

    <!--====== LineIcons CSS ======-->
    <link rel="stylesheet" href="{{ asset('assets/welcome/css/lineicons.css') }}">

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{ asset('assets/welcome/css/bootstrap.min.css') }}">

    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{ asset('assets/welcome/css/default.css') }}">

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{ asset('assets/welcome/css/style.css') }}">
    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KGV1X65C8P"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-KGV1X65C8P');
    </script>
    <style>
        iframe {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <!--[if IE]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!--====== PRELOADER PART START ======-->
    <!-- <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!--====== PRELOADER PART ENDS ======-->


    <!--====== HEADER PART START ======-->
    <section class="header_area">
        <div class="header_navbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="/">
                                <img style="width: 300px" src="{{ asset('assets/attachment/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                        <a class="page-scroll" href="#home">Home<span></span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" target="_blank" href="https://youtu.be/Dz7r07j2hTY">How to order<span></span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" target="_blank" href="https://bit.ly/sabzify-wa">WhatsApp<span></span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="#contact">Contact<span></span></a>
                                    </li>
                                    @if (Auth::check())
                                        <li class="nav-item">
                                            <a class="page-scroll" href="/home">Dashboard<span></span></a>
                                        </li>
                                    @endif
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- header navbar -->

        <div id="home" class="header_hero">
            <ul class="header_social d-none d-lg-block">
                <li><a target="_blank" href="https://www.facebook.com/sabzifypk"><i class="lni lni-facebook-filled"></i></a></li>
                <li><a target="_blank" href="https://www.instagram.com/sabzifypk"><i class="lni lni-instagram-filled"></i></a></li>
                <li><a target="_blank" href="https://bit.ly/sabzify-wa"><i class="lni lni-whatsapp"></i></a></li>
            </ul>
            <div class="container">
                <div class="row align-items-center justify-content-center justify-content-lg-between">
                    <div class="col-lg-6">
                        <div class="header_hero_content">
                            {{-- <h5 class="header_sub_title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.2s">We Deliver</h5> --}}
                            <h2 class="header_title wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.5s">We Deliver<br/>Fresh Fruits & Vegetables</h2>
                            <span class="wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="0.8s">Stay Home, We Deliver!</span>
                            <p class="wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.1s"></p>
                            <a href="https://play.google.com/store/apps/details?id=com.zed.sabzify" rel="nofollow" class="main-btn wow fadeInUp" data-wow-duration="1.3s" data-wow-delay="1.4s">Download App</a>
                        </div> <!-- header hero content -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-7">
                        <div class="header_hero_image mt-80 wow fadeInRightBig" data-wow-duration="1.3s" data-wow-delay="1.8s">
                            <iframe class="col-md-12" width="640" height="360" src="https://www.youtube.com/embed/Dz7r07j2hTY?autoplay=1" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                        </div> <!-- header hero image -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
            <div class="header_hero_shape d-none d-lg-block"></div> <!-- header hero shape -->
        </div> <!-- header hero -->
    </section>

    <!--====== CALL TO ACTION PART START ======-->

    <section class="call_to_action_area">
        <div class="container">
            <div class="call_to_action_wrapper wow fadeIn" data-wow-duration="1.3s" data-wow-delay="0.5s">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="call_to_action_box d-md-flex justify-content-between align-items-center">
                            <div class="call_to_action_content">
                                <h3 class="action_title">WE DELIVER FRESH FRUITS & VEGETABLES</h3>
                                <ul class="line">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                <p></p>
                            </div> <!-- call to action content -->

                            <div class="call_to_action_btn">
                                <a href="https://play.google.com/store/apps/details?id=com.zed.sabzify" rel="nofollow" class="main-btn">Download App</a>
                            </div> <!-- call to action btn -->
                        </div> <!-- call to action box -->
                    </div>
                </div>  <!-- row -->
            </div>  <!-- call to action wrapper -->
        </div> <!-- container -->
    </section>
    <!--====== CALL TO ACTION PART ENDS ======-->

    <!--====== FOOTER PART START ======-->
    <footer id="contact" class="footer_area gray-bg pt-115 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer_content text-center">
                        <a class="page-scroll" href="#home"><img style="width: 350px" src="{{ asset('assets/attachment/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}"></a><br>
                        <ul class="footer_social">
                            <li><a target="_blank" href="{{ $business->facebook == null ? "#" : $business->facebook }}"><i class="lni lni-facebook"></i></a></li>
                            <li><a target="_blank" href="{{ $business->instagram == null ? "#" : $business->instagram }}"><i class="lni lni-instagram"></i></a></li>
                            <li><a target="_blank" href="{{ $business->twitter == null ? "#" : $business->twitter }}"><i class="lni lni-twitter"></i></a></li>
                            <li><a target="_blank" href="{{ $business->youtube == null ? "#" : $business->youtube }}"><i class="lni lni-youtube"></i></a></li>
                            <li><a href="tel:{{ $business->phone == null ? "#" : $business->phone }}"><i class="lni lni-phone"></i></a></li>
                            <li><a target="_blank" href="https://wa.me/{{ $business->phone == null ? "#" : $business->phone }}"><i class="lni lni-whatsapp"></i></a></li>
                        </ul>
                        {{-- <ul class="footer_menu">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Portfolio</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul> --}}
                        <p class="credit pt-45">Powered By <a target="_blank" href="http://zeddevelopers.com/" rel="nofollow">Zed Developers</a></p>
                    </div> <!-- footer content -->
                </div>
            </div>  <!-- row -->
        </div> <!-- container -->
    </footer>
    <!--====== FOOTER PART ENDS ======-->

    <!--====== PART START ======-->
    <!--
        <section class="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-">

                    </div>
                </div>
            </div>
        </section>
    -->
    <!--====== PART ENDS ======-->

    <!--====== Jquery js ======-->
    <script src="{{ asset('assets/welcome/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/welcome/js/vendor/modernizr-3.7.1.min.js') }}"></script>

    <!-- ====== Bootstrap js ======-->
    <!-- <script src="{{ asset('assets/welcome/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/welcome/js/bootstrap.min.js') }}"></script> -->

    <!--====== Appear js ======-->
    <script src="{{ asset('assets/welcome/js/jquery.appear.min.js') }}"></script>

    <!--====== Scrolling Nav js ======-->
    <script src="{{ asset('assets/welcome/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/welcome/js/scrolling-nav.js') }}"></script>

    <!--====== Main js ======-->
    <script src="{{ asset('assets/welcome/js/main.js') }}"></script>

</body>

</html>
