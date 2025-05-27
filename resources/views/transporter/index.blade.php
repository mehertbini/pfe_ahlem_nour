@extends('layouts.app_transporter')
@section('content')
    @php
        use App\Models\Transporter;
        use App\Models\Trajet;

        $transporterCount = Transporter::count();
        $trajetCount = Trajet::count();
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
                                    Nombre Total des Transporteurs
                                    <span class="text-primary">({{ $transporterCount }})</span>
                                </h4>
                                <canvas id="transporterChart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">
                                    Nombre Total des Trajets
                                    <span class="text-success">({{ $trajetCount }})</span>
                                </h4>
                                <canvas id="trajetChart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->
                </div>
            </div>
        </div>
    </div>
@endsection
