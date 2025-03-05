<header>
    <div class="container_16">
        <div class="row">
            <div class="grid_16">
                <h1><a href="index.html"><img src="{{ asset('images/logo.png') }}" alt="agro united"></a> </h1>
                <nav>
                    <ul class="sf-menu">
                        <li class="current"><a href="index.html">About us</a>
                            <ul>
                                <li><a href="#">History</a></li>
                                <li><a href="#">Offers</a></li>
                                <li><a href="#">News</a>
                                    <ul>
                                        <li><a href="#">Fresh</a></li>
                                        <li><a href="#">Archive</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="index-1.html">Services</a></li>
                        <li><a href="index-2.html">Products</a></li>
                        <li><a href="index-3.html">Partners</a></li>
                        <li class="last"><a href="index-4.html">Contacts</a></li>

                        <li class="last">
                            @auth
                                <div class="user-avatar-container" style="position: relative; display: inline-block;">

                                    <!-- Avatar de l'utilisateur -->
                                    <img src="https://img.freepik.com/vecteurs-premium/avatar-icon0002_750950-43.jpg"
                                         alt="User Avatar" class="user-avatar" style="width: 30px;height: 30px; border-radius: 30px; margin-top: 20px;">

                                    <!-- Point de connexion (en ligne) -->
                                    <i class="fa-solid fa-circle-dot fa-fade fa-sm"
                                       style="color: #0ce442; position: absolute; top: 20px; right: -5px;"></i>
                                </div>

                                <ul>
                                    <li><a href="#">Profile</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>

                            @else
                                <a href="{{ route('login') }}">Login</a>
                            @endauth
                        </li>
                    </ul>

                </nav>
            </div>
        </div>
    </div>
    <div class="bg-1">
        <div class="bg-2">
            <div class="container_16">
                <div class="row">
                    <div class="grid_16 slider clearfix">
                        <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
                            <div data-src="images/slide-1.jpg">
                                <div class="camera_caption fadeIn">
                                    <div class="slider-t-1">100%</div>
                                    <div class="slider-t-2">natural organic</div>
                                </div>
                            </div>
                            <div data-src="images/slide-2.jpg">
                                <div class="camera_caption fadeIn">
                                    <div class="slider-t-1">only</div>
                                    <div class="slider-t-2">premium products</div>
                                </div>
                            </div>
                            <div data-src="images/slide-3.jpg">
                                <div class="camera_caption fadeIn">
                                    <div class="slider-t-1">pro</div>
                                    <div class="slider-t-2">quality control</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shadow"></div>
                <div class="row">
                    <div class="grid_16"><div class="title-1">Welcome to Agro United Company</div></div>
                </div>
                <div class="row">
                    <div class="list_carousel responsive clearfix carousel-1">
                        <ul id="foo" class="clearfix">
                            <li class="grid_16">
                                <div class="text-1">Beciegast nveriti vitaesaert asety kertya aset aplica boserde nerafae keuas visnemo fasera <br> nitaiades kertyaser daesraeds. aut oditaut. onsequuntur magni dolores eo qui ratione voluptatemsequi nesciunt neqporro quisquam estquides vewreseas.</div>
                            </li>
                            <li class="grid_16">
                                <div class="text-1">Reprehenderit atque consequatur eius itaque rerum! Est a officiis unde at eius explicabo laboriosam hic ad quo eum quibusdam porro corrupti quasi aspernatur adipisci blanditiis nihil. Ea sequi magnam commodi qui ipsum optio voluptate. Nemo rerum ex facere minus velit impedit sapiente.</div>
                            </li>
                        </ul>
                        <div class="arrows">
                            <a id="prev1" class="prev" href="#"></a>
                            <a id="next1" class="next" href="#"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
