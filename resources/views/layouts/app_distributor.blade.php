<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{Auth::user()->role ?? ""}} Career</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{asset('admin_css/assets/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('admin_css/assets/css/style.css')}}">

</head>

@php
    use App\Models\Purchase;

     $salesCount = Purchase::where('type_invoice', 'vente')->count();
     $buyCount = Purchase::where('type_invoice', 'achat')->count();
@endphp

<body>
<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-title">Welcome {{ Auth::user()->role ?? "user" }}</li>

                <li class="menu-item {{ request()->routeIs('distributor') ? 'active' : '' }}">
                    <a href="{{route('distributor')}}" class="dropdown-toggle">
                        <i class="menu-icon fa fa-bar-chart"></i>Management Statistic
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('sales') ? 'active' : '' }}">
                    <a href="{{route('sales')}}" class="dropdown-toggle">
                        <i class="menu-icon fa fa-bar-chart"></i>Management sales
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('purchases.index') ? 'active' : '' }}">
                    <a href="{{route('purchases.index')}}" class="dropdown-toggle">
                        <i class="menu-icon fa fa-users"></i> Management purchasing
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>

</aside>
<!-- /#left-panel -->
<!-- Right Panel -->
<div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ Auth::check() ? url('/' . Auth::user()->role) : url('/') }}">
                    <img src="{{ asset('admin_css/images/logo.png') }}" alt="Logo">
                </a>

                <a class="navbar-brand hidden" href="./"><img src="{{asset('admin_css/images/logo2.png')}}" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">

                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" style="width: 40px;height: 40px;object-fit: cover" src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('admin_css/images/admin.jpg') }}" alt="User Avatar">

                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="{{route('showDistributorPageChangeProfile')}}"><i class="fa fa-user"></i>My Profile</a>
                        <a class="nav-link" href="{{route('showDistributorPageChangePassword')}}"><i class="fa fa-lock"></i>Change password</a>

                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- /#header -->
    <!-- Content -->
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
    <!-- /.content -->
    <div class="clearfix"></div>
    <!-- Footer -->
  @include('layouts.components.admin.footer')
    <!-- /.site-footer -->
</div>
<!-- /#right-panel -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
<script src="{{asset('admin_css/assets/js/main.js')}}"></script>

<script>
    new Chart(document.getElementById("salesCount"), {
        type: 'doughnut',
        data: {
            labels: ["Vente(s)"],
            datasets: [{
                data: [{{ $salesCount }}],
                backgroundColor: ["rgba(54, 162, 235, 0.9)", "rgba(200, 200, 200, 0.3)"]
            }]
        },
        options: {
            legend: { position: 'bottom' }
        }
    });

    new Chart(document.getElementById("buyCount"), {
        type: 'doughnut',
        data: {
            labels: ["Achat(s)"],
            datasets: [{
                data: [{{ $buyCount }}],
                backgroundColor: ["rgba(255, 99, 132, 0.9)", "rgba(200, 200, 200, 0.3)"]
            }]
        },
        options: {
            legend: { position: 'bottom' }
        }
    });
</script>

</body>
</html>
