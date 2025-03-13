<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Carrer</title>
    <meta charset="utf-8">
    <meta name = "format-detection" content = "telephone=no" />
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/superfish.css') }}">
    <link rel="stylesheet" href="{{ asset('css/camera.css') }}">

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-1.1.1.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jquery.equalheights.js') }}"></script>
    <script src="{{ asset('js/superfish.js') }}"></script>
    <script src="{{ asset('js/jquery.mobilemenu.js') }}"></script>
    <script src="{{ asset('js/camera.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.totop.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ asset('js/jquery.mobile.customized.min.js') }}"></script>
    <script src="{{ asset('js/jquery.carouFredSel-6.1.0-packed.js') }}"></script>
    <script src="{{ asset('js/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.touchSwipe.min.js') }}"></script>
    <script src="{{ asset('js/slide.js') }}"></script>
</head>
<body>
<!--==============================header=================================-->
@include('layouts.components.user.nav')
<!--=======content================================-->
@yield('content')
<!--=======footer=================================-->
<footer>
    <div class="bg-3">
        <div class="container_16 bord-3">
            <div class="row main-foot">
                <div class="container_16">
                    <div class="grid_4 bord-1">
                        <ul class="list-services clearfix">
                            <li><a href="#" class="list-services-1"></a></li>
                            <li><a href="#" class="list-services-2"></a></li>
                            <li><a href="#" class="list-services-3"></a></li>
                            <li><a href="#" class="list-services-4"></a></li>
                        </ul>
                    </div>
                    <div class="grid_6 bord-1 prefix_1">
                        <div class="icon-1">28 Jackson Blvd Ste 1020, Chicago <br>IL 60604-2340</div>
                    </div>
                    <div class="grid_4 prefix_1"><div class="icon-2"><a href="#" class="color-2 h-underline">info@demolink.org</a></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-4">
        <div class="container_16">
            <div class="row grid_16">
                <div class="inside">
                    <a href="index.html"><img src="{{ asset('images/logo-foot.png') }}" alt=""></a>
                    <span>&copy; 2013 &#8226; <a href="index-5.html" class="h-underline">Privacy policy</a></span>
                    <!--{%FOOTER_LINK} -->
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
