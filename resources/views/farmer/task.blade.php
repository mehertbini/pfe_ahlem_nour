@extends('layouts.app_farmer')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin_css/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-6">
                    <h3 class="page-title">Tasks</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="#" class="btn btn-sm text-white" data-toggle="modal" data-target="#addTaskModal" style="background: #00c292;"><i class="fa fa-plus"></i> Add Task</a>

                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Task List</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Number of member</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->number }}</td>
                                <td>
                                    @if ($task->status == 1)
                                        <span class="badge badge-success">Completed</span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editTaskModal{{ $task->id }}">
                                        Edit
                                    </button>
                                    <a href="{{ route('tasks.destroy', $task->id) }}" class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this task?')">
                                        Delete
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Task Modal -->
                            <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Task</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Task Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $task->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="description" class="form-control" required>{{ $task->description }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Number</label>
                                                    <input type="number" name="number" class="form-control" value="{{ $task->number }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>Pending</option>
                                                        <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Update Task</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Task Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Task</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Project</label>
                            <select id="projectSelect" class="form-control" name="project_id" required>
                                <option value="">-- Select Project --</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Assign Individuals</label>
                            <select id="individualSelect" name="individuals[]" class="form-control" multiple required></select>
                        </div>

                        <div class="form-group">
                            <label>Task Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Number</label>
                            <input type="number" name="number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="0">Pending</option>
                                <option value="1">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Task</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize Select2
            $('#individualSelect').select2({
                placeholder: 'Select individuals',
                allowClear: true,
                width: '100%'
            });

            const individualUrlTemplate = "{{ route('getProjectIndividuals', ['id' => ':id']) }}";

            $('#projectSelect').on('change', function () {
                let projectId = $(this).val();

                // Clear and reset the select
                $('#individualSelect').empty().trigger('change');

                if (projectId) {
                    const url = individualUrlTemplate.replace(':id', projectId);

                    $.get(url, function (data) {
                        if (data.length > 0) {
                            data.forEach(function (user) {
                                let newOption = new Option(`${user.name} (${user.email})`, user.id, false, false);
                                $('#individualSelect').append(newOption);
                            });

                            // Refresh Select2 with new options
                            $('#individualSelect').trigger('change');
                        } else {
                            alert('No individuals assigned to this project.');
                        }
                    });
                }
            });
        });
    </script>



@endsection
