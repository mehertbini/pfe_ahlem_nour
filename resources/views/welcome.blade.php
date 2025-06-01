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
                            <h2>Notre mission</h2>
                            <h4>Développer une agriculture durable</h4>
                            <div>Chez Carrers, nous nous engageons à promouvoir des pratiques agricoles responsables pour la culture du blé, favorisant un avenir sain pour notre planète.</div>
                            <a href="#" class="btn"><span>En savoir plus</span></a>
                        </div>
                    </div>
                    <div class="grid_4 prefix_1 bord-1 btn-wrapper">
                        <div class="maxheight">
                            <div class="aligncenter"><img src="{{ asset('images/page-1_img-2.png')}}" alt=""></div>
                            <h2>Solutions écologiques</h2>
                            <h4>Technologies vertes et innovantes</h4>
                            <div>Nous intégrons des solutions écologiques pour optimiser la production de blé tout en respectant les écosystèmes et en réduisant notre empreinte carbone.</div>
                            <a href="#" class="btn"><span>En savoir plus</span></a>
                        </div>
                    </div>
                    <div class="grid_4 prefix_1 btn-wrapper">
                        <div class="maxheight">
                            <div class="aligncenter"><img src="{{ asset('images/page-1_img-3.png') }}" alt=""></div>
                            <h2>Production biologique</h2>
                            <h4>Des récoltes pures et naturelles</h4>
                            <div>Notre engagement dans l’agriculture biologique garantit un blé sans produits chimiques, cultivé dans le respect de la nature et de la santé des consommateurs.</div>
                            <a href="#" class="btn"><span>En savoir plus</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container_16">
            <div class="row">
                <div class="grid_5 suffix_1">
                    <h2>Développement de l'entreprise</h2>
                    <p>Depuis notre création, Carrers évolue avec pour objectif l'innovation agricole. Voici nos domaines de croissance clés :</p>
                    <ul class="list-1">
                        <li><a href="#">Optimisation des semis</a></li>
                        <li><a href="#">Gestion durable des sols</a></li>
                        <li><a href="#">Formation des agriculteurs</a></li>
                        <li><a href="#">Automatisation des récoltes</a></li>
                        <li><a href="#">Suivi intelligent des cultures</a></li>
                        <li><a href="#">Distribution éthique</a></li>
                        <li><a href="#">Certification bio</a></li>
                        <li><a href="#">Recherche variétale</a></li>
                        <li><a href="#">Coopérations locales</a></li>
                        <li><a href="#">Exportations durables</a></li>
                    </ul>
                </div>

                <div class="grid_5 suffix_1">
                    <img src="{{ asset('images/page-1_img-4.gif') }}" alt="" class="wrapper p1">
                    <div class="title-2">Des technologies agricoles respectueuses de l’environnement</div>
                    <div>Nous croyons en un avenir où l’innovation technologique permet une agriculture de blé plus efficace, tout en protégeant la biodiversité.</div>
                    <a href="#" class="btn-2">Lire plus</a>
                </div>

                <div class="grid_4">
                    <h2>Nouveaux services</h2>
                    <div class="num-lists">
                        <div class="bord-2">
                            <div class="color-1">1.
                                <a href="#">Analyse de sol gratuite</a>
                            </div>
                            <div>Bénéficiez d'un diagnostic complet pour optimiser vos rendements de blé.</div>
                        </div>
                        <div class="bord-2">
                            <div class="color-1">2.
                                <a href="#">Assistance technique</a>
                            </div>
                            <div>Notre équipe accompagne les agriculteurs dans leurs pratiques au quotidien.</div>
                        </div>
                        <div class="bord-2">
                            <div class="color-1">3.
                                <a href="#">Suivi météo intelligent</a>
                            </div>
                            <div>Des outils connectés pour anticiper les changements climatiques sur vos champs.</div>
                        </div>
                    </div>
                    <a href="#" class="btn-2">Découvrir</a>
                </div>
            </div>
        </div>
    </div>

    <!--=======footer=================================-->
    @include('layouts.components.user.nav')

@endsection
