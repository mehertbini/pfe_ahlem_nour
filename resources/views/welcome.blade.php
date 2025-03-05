<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>About Us</title>
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

    <!--[if (gt IE 9)|!(IE)]><!-->
    <script src="{{ asset('js/jquery.mobile.customized.min.js') }}"></script>
    <!--<![endif]-->

    <script src="{{ asset('js/jquery.carouFredSel-6.1.0-packed.js') }}"></script>
    <script src="{{ asset('js/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.touchSwipe.min.js') }}"></script>


    <script>
        $(window).load( function(){
            jQuery('#camera_wrap_1').camera({
                height: '73,00%',
                // thumbnails: true,
                playPause: false,
                time: 8000,
                transPeriod: 900,
                fx: 'simpleFade',
                loader: 'none',
                minHeight:'200px',
                navigation: false
            });

            $().UItoTop({ easingType: 'easeOutQuart' });

            $('#foo').carouFredSel({
                auto: false,
                responsive: true,
                width: '100%',
                prev: '#prev1',
                next: '#next1',
                scroll: 1,
                items: {
                    height: 'auto',
                    width: 300,
                    visible: {
                        min: 1,
                        max: 1
                    }
                },
                mousewheel: false,
                swipe: {
                    onMouse: true,
                    onTouch: true
                }
            });
        });
    </script>


    <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
    </div>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
    <![endif]-->
</head>
<body>
<!--==============================header=================================-->
@include('layouts.components.user.nav')

<!--=======content================================-->
<div class="content">
    <div class="bg-1">
        <div class="container_16">
            <div class="row row-1">
                <div class="grid_4 prefix_1 bord-1 btn-wrapper">
                    <div class="maxheight">
                        <div class="aligncenter"><img src="{{ asset('images/page-1_img-1.png') }}" alt=""></div>
                        <h2>our profile</h2>
                        <h4>sica delertas mietasae</h4>
                        <div>Beciegast nveriti vitaesaert asety kertya aset aplicabrde ertyas nemo eniptaiades.</div>
                        <a href="#" class="btn"><span>more</span></a>
                    </div>
                </div>
                <div class="grid_4 prefix_1 bord-1 btn-wrapper">
                    <div class="maxheight">
                        <div class="aligncenter"><img src="{{ asset('images/page-1_img-2.png')}}" alt=""></div>
                        <h2>eco solutions</h2>
                        <h4>kertywe nuasrea ladesa</h4>
                        <div>Asety kscabo nerafaes kertyu ersvitae ertyasnemo lasec vasptaiades goertayse.</div>
                        <a href="#" class="btn"><span>more</span></a>
                    </div>
                </div>
                <div class="grid_4 prefix_1 btn-wrapper">
                    <div class="maxheight">
                        <div class="aligncenter"><img src="{{ asset('images/page-1_img-3.png') }}" alt=""></div>
                        <h2>pure organic</h2>
                        <h4>lastreas moiasre uasera</h4>
                        <div>Miiasrdas nveriti vitaesaert aplicabrdasety kertya asee ertyas nemo eniptaiades.
                        </div>
                        <a href="#" class="btn"><span>more</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container_16">
        <div class="row">
            <div class="grid_5 suffix_1">
                <h2>company development</h2>
                <p>Modi tempordunt, utseas labore et dolore magnam aliqam quaerates voluptate enimad mima veniames kertase:</p>
                <ul class="list-1">
                    <li><a href="#">Asety kscabo</a></li>
                    <li><a href="#">nerafaes</a></li>
                    <li><a href="#">kertyu ersvitae ertyasnemo lasec</a></li>
                    <li><a href="#">vasptaiades goertayse</a></li>
                    <li><a href="#">volernatur aut oditaut onsequuntu</a></li>
                    <li><a href="#">magni dolores eo qui ratione</a></li>
                    <li><a href="#">voluptate</a></li>
                    <li><a href="#">msequi nesciunt, neque porro</a></li>
                    <li><a href="#">quisquam est</a></li>
                    <li><a href="#">qui dolorem ipsum quia dolor</a></li>
                </ul>
            </div>
            <div class="grid_5 suffix_1">
                <img src="{{ asset('images/page-1_img-4.gif') }}" alt="" class="wrapper p1">
                <div class="title-2">only progressive and eco friendly technologies</div>
                <div>Consectetur adipisci velit, sed quia non numquam eius modi tempordunt, utseas labore et dolore magnam aliqam quaerates voluptatem. Ut enim ad mima veniames suscipit laboriosam.</div>
                <a href="#" class="btn-2">read more</a>
            </div>
            <div class="grid_4">
                <h2>new services</h2>
                <div class="num-lists">
                    <div class="bord-2">
                        <div class="color-1">1.
                            <a href="#">Meytasa Luytsas</a>
                        </div>
                        <div>Nastsea labore et dolore magames aliquam quaerat voluptatem. </div>
                    </div>
                    <div class="bord-2">
                        <div class="color-1">2.
                            <a href="#">Bertyas Krifytas</a>
                        </div>
                        <div>Basdi temra incidunt, utsea labore et dolore magnam.</div>
                    </div>
                    <div class="bord-2">
                        <div class="color-1">3.
                            <a href="#">Miaserta Vasears</a>
                        </div>
                        <div>Aliquam quaerat voluptamut enim ad minima vuscipit.</div>
                    </div>
                </div>
                <a href="#" class="btn-2">read more</a>
            </div>
        </div>
    </div>
</div>
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
