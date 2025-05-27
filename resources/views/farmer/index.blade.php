@extends('layouts.app_farmer')
@section('content')
    @php
        $projets = \App\Models\Project::all();
         $qteTotal = \App\Models\Stock::sum('qte');
    @endphp

    <div class="animated fadeIn">
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


    </div><!-- .animated -->
        </div>

    </div>
@endsection
