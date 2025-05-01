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
                                <li><a href="#">Management</a></li>
                                <li class="active">Stock</li>
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
                            <strong class="card-title">Management stocks</strong>
                            <a href="" class="btn btn btn-sm text-white" data-toggle="modal" data-target="#addStock" style="background: #00c292;"><i class="fa fa-user-plus"></i> Add Stock</a> <!-- Green Add User Button -->
                        </div>
                        <div class="card-body">
                            <!-- User Table -->
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead style="background: #00c292;color: white;">
                                <tr>
                                    <th>Crop Name</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Harvest Date</th>
                                    <th>Plant Date</th>
                                    <th>Health</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stocks as $stock)
                                    <tr>
                                        <td>{{ $stock->cropName }}</td>
                                        <td>{{ $stock->qte }}</td>
                                        <td>{{ $stock->unite }}</td>
                                        <td>{{ $stock->harvestDate }}</td>
                                        <td>{{ $stock->plantDate }}</td>
                                        <td>{{ $stock->health }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editStock{{ $stock->id }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <a href="{{ route('handleDeleteStock', $stock->id) }}" class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Are you sure you want to delete this stock?');">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editStock{{ $stock->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="editStockLabel{{ $stock->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editStockLabel{{ $stock->id }}">Edit Stock</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('handleUpdateStock', $stock->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label for="cropName">Crop Name</label>
                                                            <input type="text" name="cropName" id="cropName" class="form-control" value="{{ $stock->cropName }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="qte">Quantity</label>
                                                            <input type="number" name="qte" id="qte" class="form-control" value="{{ $stock->qte }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="unite">Unit</label>
                                                            <input type="text" name="unite" id="unite" class="form-control" value="{{ $stock->unite }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="plantDate">Plant Date</label>
                                                            <input type="date" name="plantDate" id="plantDate" class="form-control" value="{{ $stock->plantDate }}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="harvestDate">Harvest Date</label>
                                                            <input type="date" name="harvestDate" id="harvestDate" class="form-control" value="{{ $stock->harvestDate }}">
                                                        </div>



                                                        <div class="form-group">
                                                            <label for="health">Health</label>
                                                            <select name="health" id="health" class="form-control">
                                                                <option disabled>Select health status</option>
                                                                <option value="Good" {{ $stock->health == 'Good' ? 'selected' : '' }}>Good</option>
                                                                <option value="Average" {{ $stock->health == 'Average' ? 'selected' : '' }}>Average</option>
                                                                <option value="Poor" {{ $stock->health == 'Poor' ? 'selected' : '' }}>Poor</option>
                                                            </select>


                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Update Stock</button>
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
        </div><!-- .animated -->
    </div><!-- .content -->


    <div class="modal fade" id="addStock" tabindex="-1" role="dialog" aria-labelledby="addStockLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStockLabel">Add Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('handleAddStock') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body card-block">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="cropName">Crop Name</label>
                                    <input type="text" id="cropName" name="cropName" class="form-control" placeholder="Enter crop name" value="{{ old('cropName') }}">
                                    @error('cropName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="qte">Quantity</label>
                                    <input type="number" id="qte" name="qte" class="form-control" placeholder="Enter quantity" value="{{ old('qte') }}">
                                    @error('qte')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="unite">Unit</label>
                                    <input type="text" id="unite" name="unite" class="form-control" placeholder="Enter unit (kg, tons, etc.)" value="{{ old('unite') }}">
                                    @error('unite')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="plantDate">Plant Date</label>
                                    <input type="date" id="plantDate" name="plantDate" class="form-control" value="{{ old('plantDate') }}">
                                    @error('plantDate')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="harvestDate">Harvest Date</label>
                                    <input type="date" id="harvestDate" name="harvestDate" class="form-control" value="{{ old('harvestDate') }}">
                                    @error('harvestDate')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="health">Health</label>
                                    <select name="health" id="health" class="form-control">
                                        <option disabled selected>Select health status</option>
                                        <option value="Good" {{ old('health') == 'Good' ? 'selected' : '' }}>Good</option>
                                        <option value="Average" {{ old('health') == 'Average' ? 'selected' : '' }}>Average</option>
                                        <option value="Poor" {{ old('health') == 'Poor' ? 'selected' : '' }}>Poor</option>
                                    </select>
                                    @error('health')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add Stock</button>
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
