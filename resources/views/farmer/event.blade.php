@extends('layouts.app_farmer')
@section('content')
    <link rel="stylesheet" href="{{ asset('admin_css/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Events</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li class="active">Events</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title">Event Management</strong>
                            <a href="#" class="btn btn-sm text-white" data-toggle="modal" data-target="#addEvent" style="background: #00c292;"><i class="fa fa-plus"></i> Add Event</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead style="background: #00c292; color: white;">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Picture</th>
                                    <th>Date Attribute</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->description }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $event->picture) }}" width="50" class="img-thumbnail" style="cursor: pointer;" data-toggle="modal" data-target="#imageModal{{ $event->id }}">
                                        </td>

                                        <td>{{ $event->date_attribute }}</td>
                                        <td>{{ $event->start_date }}</td>
                                        <td>{{ $event->end_date }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editEvent{{ $event->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <a href="{{route('handleDeleteEvent',$event->id)}}" class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Are you sure you want to delete this event?');">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="imageModal{{ $event->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/' . $event->picture) }}" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="editEvent{{ $event->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Event</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('handleUpdateEvent', $event->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label>Project</label>
                                                            <select id="eventProjectSelectEdit{{ $event->id }}" class="form-control" name="project_id" required>
                                                                <option value="">-- Select Project --</option>
                                                                @foreach($projects as $project)
                                                                    <option value="{{ $project->id }}" {{ $event->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Individuals</label>
                                                            <select id="eventIndividualSelectEdit{{ $event->id }}" name="individuals[]" class="form-control" multiple required>
                                                                @foreach($event->project ? $event->project->users : [] as $user)
                                                                <option value="{{ $user->id }}" {{ in_array($user->id, $event->users->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $event->name }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" name="description" class="form-control" value="{{ $event->description }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Picture</label>
                                                            <input type="file" name="picture" class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Date Attribute</label>
                                                            <input type="date" name="date_attribute" class="form-control" value="{{ $event->date_attribute }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Start Date</label>
                                                            <input type="date" name="start_date" class="form-control" value="{{ $event->start_date }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>End Date</label>
                                                            <input type="date" name="end_date" class="form-control" value="{{ $event->end_date }}">
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Update Event</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Event Modal -->
    <div class="modal fade" id="addEvent" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventLabel">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('handleAddEvent') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Project</label>
                                <select id="eventProjectSelect" class="form-control" name="project_id" required>
                                    <option value="">-- Select Project --</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Assign Individuals</label>
                                <select id="eventIndividualSelect" name="individuals[]" class="form-control" multiple required></select>
                            </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="picture" class="form-label">Event Image</label>
                            <input type="file" class="form-control" id="picture" name="picture">
                        </div>

                        <div class="mb-3">
                            <label for="attribute_date" class="form-label">Attribute Date</label>
                            <input type="date" class="form-control" id="attribute_date" name="attribute_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn text-white" style="background: #00c292;">Save Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

<!-- Include jQuery and Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('#eventIndividualSelect').select2({
            placeholder: 'Select individuals',
            allowClear: true,
            width: '100%'
        });

        const eventIndividualUrlTemplate = "{{ route('getProjectIndividuals', ['id' => ':id']) }}";

        $('#eventProjectSelect').on('change', function () {
            let projectId = $(this).val();

            $('#eventIndividualSelect').empty().trigger('change');

            if (projectId) {
                const url = eventIndividualUrlTemplate.replace(':id', projectId);

                $.get(url, function (data) {
                    if (data.length > 0) {
                        data.forEach(function (user) {
                            let newOption = new Option(`${user.name} (${user.email})`, user.id, false, false);
                            $('#eventIndividualSelect').append(newOption);
                        });
                        $('#eventIndividualSelect').trigger('change');
                    } else {
                        alert('No individuals assigned to this project.');
                    }
                });
            }
        });
    });

</script>
<script>
    $(document).ready(function () {
        const urlTemplate = "{{ route('getProjectIndividuals', ['id' => ':id']) }}";

        @foreach($events as $event)
        $('#eventIndividualSelectEdit{{ $event->id }}').select2({
            placeholder: 'Select individuals',
            allowClear: true,
            width: '100%'
        });

        $('#eventProjectSelectEdit{{ $event->id }}').on('change', function () {
            let projectId = $(this).val();
            let select = $('#eventIndividualSelectEdit{{ $event->id }}');
            select.empty().trigger('change');

            if (projectId) {
                const url = urlTemplate.replace(':id', projectId);
                $.get(url, function (data) {
                    if (data.length > 0) {
                        data.forEach(function (user) {
                            let newOption = new Option(`${user.name} (${user.email})`, user.id, false, false);
                            select.append(newOption);
                        });
                        select.trigger('change');
                    } else {
                        alert('No individuals assigned to this project.');
                    }
                });
            }
        });
        @endforeach
    });
</script>

