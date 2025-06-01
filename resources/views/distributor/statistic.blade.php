@extends('layouts.app_distributor')
@section('content')
    @php
        use App\Models\Purchase;

        $salesCount = Purchase::where('type_invoice', 'vente')->count();
        $buyCount = Purchase::where('type_invoice', 'achat')->count();
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
                                    Nombre Total des vents
                                    <span class="text-primary">({{ $salesCount }})</span>
                                </h4>
                                <canvas id="salesCount"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">
                                    Nombre Total des achats
                                    <span class="text-success">({{ $buyCount }})</span>
                                </h4>
                                <canvas id="buyCount"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->
                </div>
            </div>
        </div>
    </div>
@endsection
