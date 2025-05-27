@extends('layouts.app_individual')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('admin_css/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-6">
                    <h3 class="page-title">Project assigned</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">List of project</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Status</th>
                            <th>Number of tasks</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($projects as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->start_date }}</td>
                                <td>{{ $project->end_date }}</td>
                                <td>
                                    @if($project->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($project->status == 1)
                                        <span class="badge badge-info">In Progress</span>
                                    @elseif($project->status == 2)
                                        <span class="badge badge-success">Completed</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $project->tasks->count() }}
                                    @if($project->tasks->count() > 0)
                                        <a href="#" class="view-tasks" data-project-id="{{ $project->id }}" data-toggle="modal" data-target="#taskModal{{ $project->id }}" title="View Tasks">
                                            <i class="fa fa-eye text-primary ml-2"></i>
                                        </a>
                                    @endif

                                    <!-- Modal specific to this project -->
                                    <div class="modal fade" id="taskModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel{{ $project->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tasks for {{ $project->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul id="taskList{{ $project->id }}" class="list-group">
                                                        <li class="list-group-item">Loading...</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No project assigned</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JS dependencies (ensure these are loaded once!) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <!-- Handle modal load -->
    <script>
        $(document).ready(function () {
            $('.view-tasks').on('click', function (e) {
                e.preventDefault();
                let projectId = $(this).data('project-id');
                console.log('Opening modal for project:', projectId);

                let taskList = $('#taskList' + projectId);
                taskList.html('<li class="list-group-item">Loading...</li>');

                $.get('{{ route("getTasksByProject") }}', { project_id: projectId }, function (tasks) {
                    taskList.empty();

                    if (tasks.length > 0) {
                        tasks.forEach(task => {
                            taskList.append(`
                            <li class="list-group-item">
                                <strong>${task.name}</strong><br>
                                ${task.description}<br>
                                <span class="badge badge-secondary">Status: ${task.status == 1 ? 'Completed' : 'Pending'}</span>
                            </li>
                        `);
                        });
                    } else {
                        taskList.html('<li class="list-group-item">No tasks found for this project.</li>');
                    }
                });
            });
        });
    </script>
@endsection
