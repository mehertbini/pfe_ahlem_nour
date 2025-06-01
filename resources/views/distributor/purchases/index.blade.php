@extends('layouts.app_distributor')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin_css/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title"><h1>Purchases</h1></div>
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
                            <strong class="card-title">Purchase Management</strong>
                            <a href="#" class="btn btn-sm text-white" data-toggle="modal" data-target="#addPurchaseModal" style="background: #00c292;">
                                <i class="fa fa-plus"></i> Add Purchase
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead style="background: #00c292;color: white">
                                <tr>
                                    <th>Customer</th>
                                    <th>Type</th>
                                    <th>Products</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Total</th> <!-- Nouvelle colonne pour afficher le total -->
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($purchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->name_customer }}</td>
                                        <td>{{ $purchase->type_invoice }}</td>
                                        <td>
                                            <ul>
                                                @php $totalAmount = 0; @endphp
                                                @foreach($purchase->products as $product)
                                                    @php $totalAmount += $product->amount; @endphp
                                                    <li>{{ $product->cropName }} {{ number_format($product->amount, 2) }} TND</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $purchase->status ? 'paid' : 'unpaid' }}</td>
                                        <td>{{ $purchase->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <!-- Total amount for each purchase -->
                                            <strong>{{ number_format($totalAmount, 2) }} TND</strong>
                                        </td>
                                        <td>
                                            <!-- View button -->
                                            <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-sm btn-info" title="View"><i class="fa fa-eye"></i></a>

                                            <!-- Print button -->
                                            <a href="{{ route('purchases.print', $purchase->id) }}" class="btn btn-sm btn-secondary" title="Print" target="_blank"><i class="fa fa-print"></i></a>

                                            <!-- Delete button -->
                                            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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

    <!-- Add Purchase Modal (Simplified) -->
    <!-- Add Purchase Modal -->
    <div class="modal fade" id="addPurchaseModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('purchases.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter une facture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body card-block">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="type_invoice">Type de facture</label>
                                    <select name="type_invoice" class="form-control" required>
                                        <option value="achat">Achat</option>
                                        <option value="vente">Vente</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="name_customer">Nom du client</label>
                                    <input type="text" name="name_customer" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="product_ids">Produits</label>
                                    <select name="product_ids[]" multiple class="form-control select2" required>
                                        @foreach($stocks as $stock)
                                            <option value="{{ $stock->id }}">
                                                {{ $stock->cropName }} - {{ number_format($stock->amount, 2) }} TND
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="status">Statut</label>
                                    <select name="status" class="form-control" required>
                                        <option value="0">Non payé</option>
                                        <option value="1">Payé</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
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

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });
        });
    </script>
    <script>
        setTimeout(function() {
            $(".alert").fadeOut("slow");
        }, 3000);
    </script>
@endsection
