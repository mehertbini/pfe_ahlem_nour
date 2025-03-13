@extends('layouts.app_admin')
@section('content')
    @php
        $users = \App\Models\User::where('role','!=','admin')->get();
    @endphp
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('showUsers') }}" class="text-decoration-none">
                    <div class="card" style="cursor: pointer;">
                        <div class="card-body">
                            <div class="stat-widget-four">
                                <div class="stat-icon dib">
                                    <i class="ti-user text-muted"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-heading">Users</div>
                                        <div class="stat-text">Total:<span class="count"> {{$users->count()}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('showUsers') }}" class="text-decoration-none">
                    <div class="card" style="cursor: pointer;">
                    <div class="card-body">
                        <div class="stat-widget-four">
                            <div class="stat-icon dib">
                                <i class="ti-user text-muted"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">Users</div>
                                    <div class="stat-text">Total:<span class="count"> {{$users->count()}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('showUsers') }}" class="text-decoration-none">
                    <div class="card" style="cursor: pointer;">
                        <div class="card-body">
                            <div class="stat-widget-four">
                                <div class="stat-icon dib">
                                    <i class="ti-user text-muted"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-heading">Users</div>
                                        <div class="stat-text">Total:<span class="count"> {{$users->count()}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('showUsers') }}" class="text-decoration-none">
                    <div class="card" style="cursor: pointer;">
                        <div class="card-body">
                            <div class="stat-widget-four">
                                <div class="stat-icon dib">
                                    <i class="ti-user text-muted"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-heading">Users</div>
                                        <div class="stat-text">Total:<span class="count"> {{$users->count()}}</span></div>
                                    </div>
                                </div>
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
                                <h4 class="mb-3">Single Bar Chart </h4>
                                <canvas id="singelBarChart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Doughut Chart </h4>
                                <canvas id="doughutChart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->
                </div>

            </div><!-- .animated -->
        </div>
    </div>
@endsection
