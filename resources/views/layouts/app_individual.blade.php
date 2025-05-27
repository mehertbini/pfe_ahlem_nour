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

<body>
@php
    use App\Models\Task;
    use App\Models\Event;

       $notifications = auth()->user()->unreadNotifications;
       $userId = auth()->id();
       $taskCount = Task::whereJsonContains('individual_ids', (string) $userId)->count();
       $eventCount = Event::whereJsonContains('individual_ids', (string) $userId)->count();
 @endphp
<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-title">Welcome {{ Auth::user()->role ?? "user" }}</li>

                <li class="menu-item {{ request()->routeIs('individual') ? 'active' : '' }}">
                    <a href="{{url('/individual')}}" class="dropdown-toggle">
                        <i class="menu-icon fa fa-bar-chart"></i>Management statistic
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('listOfProject') ? 'active' : '' }}">
                    <a href="{{route('listOfProject')}}" class="dropdown-toggle">
                        <i class="menu-icon fa fa-bar-chart"></i>List of project
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
                            <span class="count bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">
                            <p class="red">You have {{ auth()->user()->unreadNotifications->count() }} Notification(s)</p>

                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <a class="dropdown-item media" href="{{route('notifications.markAsRead')}}">
                                    <i class="fa fa-check"></i>
                                    <p>{{ $notification->data['task_name'] ?? 'New Notification' }}</p>
                                </a>
                            @empty
                                <a class="dropdown-item media" href="#">
                                    <p>No new notifications</p>
                                </a>
                            @endforelse
                        </div>
                    </div>

                </div>

                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" style="width: 40px;height: 40px;object-fit: cover" src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('admin_css/images/admin.jpg') }}" alt="User Avatar">

                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="{{route('showIndividualPageChangeProfile')}}"><i class="fa fa-user"></i>My Profile</a>

                        <a class="nav-link" href="{{route('showIndividualPageChangePassword')}}"><i class="fa fa-lock"></i>Change password</a>


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



<script>
    $('#notification').on('click', function() {
        $.post('{{ route('notifications.markAsRead') }}', {
            _token: '{{ csrf_token() }}'
        });
    });
</script>

<!-- Chart.js and other scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
<script src="{{asset('admin_css/assets/js/main.js')}}"></script>
<script>
    const taskCount = {{ $taskCount }};
    const eventCount = {{ $eventCount }};

    // Transporter Chart
    new Chart(document.getElementById("taskChart"), {
        type: 'doughnut',
        data: {
            labels: ["Task(s)"],
            datasets: [{
                data: [taskCount], // use small number for empty segment
                backgroundColor: [
                    "rgba(54, 162, 235, 0.9)",   // blue
                    "rgba(200, 200, 200, 0.3)"   // gray (dummy)
                ]
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Trajet Chart
    new Chart(document.getElementById("eventChart"), {
        type: 'doughnut',
        data: {
            labels: ["Event(s)"],
            datasets: [{
                data: [eventCount],
                backgroundColor: [
                    "rgba(255, 99, 132, 0.9)",    // red
                    "rgba(200, 200, 200, 0.3)"    // gray
                ]
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

</body>
</html>
