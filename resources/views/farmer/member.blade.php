@extends('layouts.app_farmer')
@section('content')
    <link rel="stylesheet" href="{{ asset('admin_css/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Farmer</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">Farmer</a></li>
                                <li><a href="#">Management project</a></li>
                                <li class="active">Member</li>
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
                        <div class="card-body">
                            <!-- User Table -->
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead style="background: #00c292;color: white;">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($membres as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-sm btn-outline-primary" data-toggle="modal"
                                                    data-target="#editUser{{ $member->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <a href="{{ route('handleDeleteMember', $member->id) }}" class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Are you sure you want to delete this user {{ $member->name }}?');">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Edit User Modal -->
                                    <div class="modal fade" id="editUser{{ $member->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="editUserLabel{{ $member->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserLabel{{ $member->id }}">Edit User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="card-body card-block">
                                                        <form action="{{ route('handleUpdateMember', $member->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                                        <input type="text" id="name" name="name" value="{{ $member->name }}"
                                                                               class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                                                        <input type="email" id="email" name="email" value="{{ $member->email }}"
                                                                               class="form-control">
                                                                    </div>
                                                                </div>

                                                                <!-- Password Input -->
                                                                <div class="col-md-6 mt-3">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                                                        <input type="password" id="password" name="password" placeholder="New Password (optional)" class="form-control">
                                                                    </div>
                                                                    @error('password')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
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
