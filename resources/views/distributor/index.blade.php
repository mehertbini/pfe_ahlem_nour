@extends('layouts.app_distributor')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin_css/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Dashboard</a></li>
                                <li><a href="#">Management</a></li>
                                <li class="active">Distributors</li>
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
                            <strong class="card-title">Distributor Management</strong>
                            <a href="#" class="btn btn-sm text-white" data-toggle="modal" data-target="#addDistributorModal" style="background: #00c292;"><i class="fa fa-user-plus"></i> Add</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Destination</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{ $data->name_dist }}</td>
                                        <td>{{ $data->start_date }}</td>
                                        <td>{{ $data->end_date }}</td>
                                        <td>{{ $data->destination }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editDistributor{{ $data->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <!-- Delete Button -->
                                            <form action="{{ route('handleDeleteDistributor', $data->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this distributor?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editDistributor{{ $data->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <form action="{{ route('handleUpdateDistributor', $data->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Distributor</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" name="name_dist" class="form-control" value="{{ $data->name_dist }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Start Date</label>
                                                            <input type="date" name="start_date" class="form-control" value="{{ $data->start_date }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>End Date</label>
                                                            <input type="date" name="end_date" class="form-control" value="{{ $data->end_date }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Destination</label>
                                                            <input type="text" name="destination" class="form-control" value="{{ $data->destination }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
        </div>
    </div>

    <!-- Add Distributor Modal -->
    <div class="modal fade" id="addDistributorModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('handleAddDistributor') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Distributor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body card-block">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name_dist">Name</label>
                                    <input type="text" name="name_dist" class="form-control" placeholder="Distributor Name" value="{{ old('name_dist') }}">
                                    @error('name_dist') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="destination">Destination</label>
                                    <input type="text" name="destination" class="form-control" placeholder="Destination" value="{{ old('destination') }}">
                                    @error('destination') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                                    @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                                    @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Distributor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- DataTables JS -->
    <script src="{{ asset('admin_css/assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('admin_css/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_css/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin_css/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_css/assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('admin_css/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin_css/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin_css/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin_css/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>

    <!-- DataTables Initialization -->
    <script src="{{ asset('admin_css/assets/js/init/datatables-init.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        } );
    </script>

    <script>
        setTimeout(function() {
            $(".alert").fadeOut("slow");
        }, 3000); // The alert will disappear after 3 seconds
    </script>
@endsection
