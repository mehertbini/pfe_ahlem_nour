@extends('layouts.app_admin')
@section('content')
    @php
        $usersActive = \App\Models\User::where('role','!=','admin')->where('status','1')->count();
        $usersPending = \App\Models\User::where('role','!=','admin')->get()->where('status','0')->count();
         $projets = \App\Models\Project::all();
         $qteTotal = \App\Models\Stock::sum('qte');
    @endphp
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <!-- User Active Card -->
            <div class="col-lg-6 col-md-6 mb-4">
                <a href="{{ route('showUsers') }}" class="text-decoration-none">
                    <div class="card shadow-sm border-left-success" style="cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                        <div class="card-body d-flex align-items-center">
                            <!-- Icon -->
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="ti-user"></i>
                            </div>
                            <!-- Text -->
                            <div class="ms-3 ml-3">
                                <h5 class="mb-1 text-dark">Utilisateurs Actifs</h5>
                                <h6 class="mb-0 text-muted">Total: <strong class="text-success">{{ $usersActive }}</strong></h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- User Pending Card -->
            <div class="col-lg-6 col-md-6 mb-4">
                <a href="{{ route('showUsers') }}" class="text-decoration-none">
                    <div class="card shadow-sm border-left-warning" style="cursor: pointer; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                        <div class="card-body d-flex align-items-center">
                            <!-- Icon -->
                            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="ti-user"></i>
                            </div>
                            <!-- Text -->
                            <div class="ms-3 ml-3">
                                <h5 class="mb-1 text-dark">Utilisateurs en Attente</h5>
                                <h6 class="mb-0 text-muted">Total: <strong class="text-warning">{{ $usersPending }}</strong></h6>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- /Widgets -->

        <div class="clearfix"></div>
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">
                                    Nombre Total des Projets
                                    <span class="text-danger">({{ $projets->count() ?? 0 }})</span>
                                </h4>
                                <canvas id="doughutChart1"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">
                                    Nombre Total des Produits
                                    <span class="text-danger">({{ $qteTotal ?? 0 }})</span>
                                </h4>
                                {{-- Filter Form --}}
                                <form method="GET" class="mb-4">
                                    <div class="row">
                                        {{-- Year --}}
                                        <div class="col-md-6 mb-2">
                                            <select name="year" onchange="this.form.submit()" class="form-control">
                                                <option value="">All Years</option>
                                                @for ($y = 2022; $y <= now()->year; $y++)
                                                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        {{-- Month --}}
                                        <div class="col-md-6 mb-2">
                                            <select name="month" onchange="this.form.submit()" class="form-control">
                                                <option value="">All Months</option>
                                                @for ($m = 1; $m <= 12; $m++)
                                                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </form>

                                <canvas id="doughutChart2"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->
                </div>
            </div>
        </div>
    </div>
@endsection
