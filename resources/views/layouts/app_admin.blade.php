<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Career</title>
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

    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">

</head>

<body>
@php
    $pending = \App\Models\Project::where('status', 0)->count();
    $inProgress = \App\Models\Project::where('status', 1)->count();
    $completed = \App\Models\Project::where('status', 2)->count();
  use Illuminate\Support\Facades\DB;

            $query = DB::table('stocks')
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(qte) as total_quantity'));

            if (request('year')) {
                $query->whereYear('created_at', request('year'));
            }

            if (request('month')) {
                $query->whereMonth('created_at', request('month'));
            }

            if (request('week') && request('year') && request('month')) {
                $startOfMonth = \Carbon\Carbon::create(request('year'), request('month'), 1);

            }

            $statistics = $query->groupBy(DB::raw('DATE(created_at)'))
                                ->orderBy(DB::raw('DATE(created_at)'))
                                ->get();

            $dates = $statistics->pluck('date')->toArray();
            $quantities = $statistics->pluck('total_quantity')->toArray();

@endphp
<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li class="menu-title">Welcome {{Auth::user()->role ?? "user"}}</li><!-- /.menu-title -->
                <li class="menu-item">
                    <a href="{{url('/admin')}}" class="dropdown-toggle"> <i class="menu-icon fa fa-bar-chart"></i>Management statistic</a>
                </li>
                <li class="menu-item">
                    <a href="{{route('showUsers')}}" class="dropdown-toggle"> <i class="menu-icon fa fa-users"></i>Management users </a>
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
                <div class="header-left">
                    <button class="search-trigger"><i class="fa fa-search"></i></button>
                    <div class="form-inline">
                        <form class="search-form">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                            <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                        </form>
                    </div>

                    <div class="dropdown for-notification">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger">3</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">
                            <p class="red">You have 3 Notification</p>
                            <a class="dropdown-item media" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" style="width: 40px;height: 40px;object-fit: cover" src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('admin_css/images/admin.jpg') }}" alt="User Avatar">
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="{{route('showAdminPageChangeProfile')}}"><i class="fa fa-user"></i>My Profile</a>

                        <a class="nav-link" href="{{route('showAdminPageChangePassword')}}"><i class="fa fa-lock"></i>Change password</a>


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
    const pending = {{ $pending }};
    const inProgress = {{ $inProgress }};
    const completed = {{ $completed }};
</script>
<script>
    //doughut chart
    var ctx = document.getElementById( "doughutChart1" );
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Pending", "In Progress", "Completed"],
            datasets: [{
                data: [pending, inProgress, completed],
                backgroundColor: [
                    "rgba(255, 206, 86, 0.9)",   // Pending - yellow
                    "rgba(75, 192, 192, 0.9)",   // In Progress - teal
                    "rgba(0, 194, 146, 0.9)"     // Completed - green
                ],
                hoverBackgroundColor: [
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(0, 194, 146, 1)"
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    var ctx = document.getElementById("doughutChart2");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($dates),
            datasets: [{
                label: "Quantité produits",
                data: @json($quantities),
                backgroundColor: "rgba(0, 194, 146, 0.5)",
                borderColor: "rgba(0, 194, 146, 0.9)",
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            title: {
                display: true,
                text: 'Quantité produits filtrée'
            }
        }
    });


</script>
</body>
</html>
