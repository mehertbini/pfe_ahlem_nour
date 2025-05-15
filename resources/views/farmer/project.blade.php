@extends('layouts.app_farmer')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin_css/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-6">
                    <h3 class="page-title">Projects</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="#" class="btn btn-sm text-white" data-toggle="modal" data-target="#addProjectModal" style="background: #00c292;">
                        <i class="fa fa-plus"></i> Add Project
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">List of Projects</strong>
                </div>
                <div class="card-body">
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Individuals</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->description }}</td>
                                <td>{{ $project->start_date }}</td>
                                <td>{{ $project->end_date }}</td>
                                <td>{{ is_array($project->id_individual) ? count($project->id_individual) : (is_string($project->id_individual) ? count(json_decode($project->id_individual)) : 0) }}</td>
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
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editProjectModal{{ $project->id }}">Edit</button>
                                    <form action="{{route('handleDeleteProject',$project->id)}}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this project?')">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editProjectModal{{ $project->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('handleUpdateProject', $project->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Project</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $project->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea name="description" class="form-control" required>{{ $project->description }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" name="start_date" class="form-control" value="{{ $project->start_date }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input type="date" name="end_date" class="form-control" value="{{ $project->end_date }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="0" {{ $project->status == 0 ? 'selected' : '' }}>Pending</option>
                                                        <option value="1" {{ $project->status == 1 ? 'selected' : '' }}>In Progress</option>
                                                        <option value="2" {{ $project->status == 2 ? 'selected' : '' }}>Completed</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Assign Individuals</label>
                                                    <select name="id_individual[]" class="form-control select2-multiple" multiple>
                                                        @foreach($individuals as $individual)
                                                            <option value="{{ $individual->id }}"
                                                                    @if(in_array($individual->id, $project->id_individual ?? [])) selected @endif>
                                                                {{ $individual->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Update Project</button>
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

    <!-- Add Modal -->
    <!-- Add Project Modal -->
    <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('handleAddProject') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Project</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Project Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>



                        <div class="form-group">
                            <label>Assign Individuals</label>
                            <select name="id_individual[]" class="form-control select2-multiple" multiple>
                                @foreach($individuals as $individual)
                                    <option value="{{ $individual->id }}">{{ $individual->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Project</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2({
                placeholder: "Select individuals",
                width: '100%'
            });

            // To reinitialize Select2 after modal is shown (required for modals)
            $('#addTaskModal, .editTaskModal').on('shown.bs.modal', function () {
                $(this).find('.select2-multiple').select2({
                    placeholder: "Select individuals",
                    width: '100%'
                });
            });
        });
    </script>

@endsection
