<header>
    <div class="container_16">
        <div class="row">
            <div class="grid_16">
                <h1><a href="/"><img src="{{ asset('images/logo.png') }}" alt="agro united" style="width: 120px;height: 60px;"></a> </h1>
                <nav>
                    <ul class="sf-menu">
                        <li class="{{ request()->is('/') ? 'current' : '' }}">
                            <a href="/">Home</a>
                        </li>
                        <li class="last">
                            @auth
                                <div class="user-avatar-container" style="position: relative; display: inline-block;">
                                    <img src="https://img.freepik.com/vecteurs-premium/avatar-icon0002_750950-43.jpg"
                                         alt="User Avatar" class="user-avatar" style="width: 30px;height: 30px; border-radius: 30px; margin-top: 20px;">
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
                                <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'current' : '' }}">Login</a>
                            @endauth
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</header>
