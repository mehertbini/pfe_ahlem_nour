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
                                <li class="active">Products</li>
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
                            <strong class="card-title">Product Management</strong>
                            <a href="#" class="btn btn-sm text-white" data-toggle="modal" data-target="#addDistributorModal" style="background: #00c292;">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead style="background: #00c292;color: white">
                                <tr>
                                    <th>Crop Name</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Plant Date</th>
                                    <th>Harvest Date</th>
                                    <th>Health</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{ $data->cropName }}</td>
                                        <td>{{ $data->qte }}</td>
                                        <td>{{ $data->unite }}</td>
                                        <td>{{ $data->plantDate }}</td>
                                        <td>{{ $data->harvestDate }}</td>
                                        <td>{{ $data->health }}</td>
                                        <td>{{ number_format($data->amount, 2, ',', ' ') }} TND</td>

                                        <td>
                                            <form action="{{ route('handleDistributorDeleteProduct', $data->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this stock entry?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Stock Modal -->
    <div class="modal fade" id="addDistributorModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('handleDistributorAddProduct') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Stock</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body card-block">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="cropName">Crop Name</label>
                                    <input type="text" name="cropName" class="form-control" value="{{ old('cropName') }}">
                                    @error('cropName') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="qte">Quantity</label>
                                    <input type="number" name="qte" class="form-control" value="{{ old('qte') }}">
                                    @error('qte') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="unite">Unit</label>
                                    <input type="text" name="unite" class="form-control" value="{{ old('unite') }}">
                                    @error('unite') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="plantDate">Plant Date</label>
                                    <input type="date" name="plantDate" class="form-control" value="{{ old('plantDate') }}">
                                    @error('plantDate') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="harvestDate">Harvest Date</label>
                                    <input type="date" name="harvestDate" class="form-control" value="{{ old('harvestDate') }}">
                                    @error('harvestDate') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="amount">Amount (TND)</label>
                                    <input type="number" name="amount" class="form-control" value="{{ old('amount') }}">
                                    @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="health">Health</label>
                                <select name="health" class="form-control">
                                    <option value="">Select Health</option>
                                    <option value="Good" {{ old('health') == 'Good' ? 'selected' : '' }}>Good</option>
                                    <option value="Average" {{ old('health') == 'Average' ? 'selected' : '' }}>Average</option>
                                    <option value="Poor" {{ old('health') == 'Poor' ? 'selected' : '' }}>Poor</option>
                                </select>
                                @error('health') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Stock</button>
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
    <script src="{{ asset('admin_css/assets/js/init/datatables-init.js') }}"></script>

    <script>
        setTimeout(function() {
            $(".alert").fadeOut("slow");
        }, 3000);
    </script>
@endsection
