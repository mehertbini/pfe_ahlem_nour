@extends('layouts.app_individual')
@section('content')
    @php
        use App\Models\Task;
        use App\Models\Event;

        $userId = auth()->id();
        $taskCount = Task::whereJsonContains('individual_ids', (string) $userId)->count();
        $eventCount = Event::whereJsonContains('individual_ids', (string) $userId)->count();

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
                                    Nombre Total des Tasks
                                    <span class="text-primary">({{ $taskCount }})</span>
                                </h4>
                                <canvas id="taskChart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">
                                    Nombre Total des events
                                    <span class="text-success">({{ $eventCount }})</span>
                                </h4>
                                <canvas id="eventChart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->
                </div>
            </div>
        </div>
    </div>
@endsection
