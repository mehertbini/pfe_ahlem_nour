@extends('layouts.app_individual')

@section('content')
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
                                <li><a href="active">Change password</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <div class="d-flex justify-content-center align-items-center vh-100">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header text-center">Change Password</div>
                        <div class="card-body card-block">
                            <form action="{{ route('changeIndividualPassword') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                        <input type="password" id="current_password" name="current_password" placeholder="Current Password" class="form-control" required>
                                    </div>
                                    @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                        <input type="password" id="new_password" name="new_password" placeholder="New Password" class="form-control" required>
                                    </div>
                                    @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm New Password" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-actions form-group text-center">
                                    <button type="submit" class="btn btn-success">Change</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
