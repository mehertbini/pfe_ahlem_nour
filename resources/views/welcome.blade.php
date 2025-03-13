@extends('layouts.app_user')
@section('content')
<!--=======slide================================-->
@include('layouts.components.user.slide')
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
@include('layouts.components.user.nav')

@endsection
