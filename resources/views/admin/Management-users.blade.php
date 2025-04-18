@extends('layouts.app_admin')
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
                                <li><a href="#">Table</a></li>
                                <li class="active">Data table</li>
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
                            <strong class="card-title">Management Users</strong>
                            <a href="" class="btn btn btn-sm text-white" data-toggle="modal" data-target="#addUser" style="background: #00c292;"><i class="fa fa-user-plus"></i> Add User</a> <!-- Green Add User Button -->
                        </div>
                        <div class="card-body">
                            <!-- User Table -->
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>phone</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#imageModal{{ $user->id }}">
                                                <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('admin_css/images/admin.jpg') }}"
                                                     alt="User Photo" class="img-thumbnail" width="50">
                                            </a>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role ?? 'N/A' }}</td>
                                        <td>{{ $user->phone ?? 'N/A' }}</td>
                                        <td>
                                            <!-- Toggle Status Form -->
                                            <form action="{{ route('toggleUserStatus', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm {{ $user->status == 1 ? 'btn-success' : 'btn-secondary' }}">
                                                    <i class="fa {{ $user->status == 1 ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                                   {{$user->status === 1 ? "On": "Off"}}
                                                </button>
                                            </form>

                                        </td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editUser{{ $user->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <!-- Delete Button -->
                                            <a href="{{ route('handleDeleteUser', $user->id) }}" class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Are you sure you want to delete this user {{ $user->name }}?');">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Image Modal -->
                                    <div class="modal fade" id="imageModal{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">User Photo - {{ $user->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('admin_css/images/admin.jpg') }}"
                                                         alt="User Photo" class="img-fluid rounded">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit User Modal -->
                                    <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="editUserLabel{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserLabel{{ $user->id }}">Edit User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="card-body card-block">
                                                        <form action="{{ route('handleUpdateUser', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="name" name="name" value="{{ $user->name }}"
                                                                               class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                                                                               class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-align-justify"></i></div>
                                                                        <select class="form-control" name="role">
                                                                            <option disabled>Choose Role</option>
                                                                            <option value="farmer"
                                                                                {{ $user->role == 'farmer' ? 'selected' : '' }}>Farmer
                                                                            </option>
                                                                            <option value="transporter"
                                                                                {{ $user->role == 'transporter' ? 'selected' : '' }}>Transporter
                                                                            </option>
                                                                            <option value="distributor"
                                                                                {{ $user->role == 'distributor' ? 'selected' : '' }}>Distributor
                                                                            </option>
                                                                            <option value="individual"
                                                                                {{ $user->role == 'individual' ? 'selected' : '' }}>Individual
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                                                        <input type="password" id="password" name="password"
                                                                               placeholder="New Password (optional)" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                                                        <input type="text" id="phone" name="phone" value="{{$user->phone}}"
                                                                               placeholder="phone" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
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
        </div><!-- .animated -->
    </div><!-- .content -->


    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('handleAddUser') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body card-block">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" id="firstname" name="firstname" placeholder="First Name" class="form-control" value="{{ old('firstname') }}">
                                    </div>
                                    @error('firstname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                        <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-align-justify"></i></div>
                                            <select class="form-control" name="role">
                                                <option disabled selected>Choose role</option>
                                                <option value="farmer" {{ old('role') == 'farmer' ? 'selected' : '' }}>Farmer</option>
                                                <option value="transporter" {{ old('role') == 'transporter' ? 'selected' : '' }}>Transporter</option>
                                                <option value="distributor" {{ old('role') == 'distributor' ? 'selected' : '' }}>Distributor</option>
                                                <option value="individual" {{ old('role') == 'individual' ? 'selected' : '' }}>Individual</option>
                                            </select>
                                        </div>
                                        @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                            <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                                        </div>
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="text" id="phone" name="phone"
                                               placeholder="phone" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Create</button>
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
