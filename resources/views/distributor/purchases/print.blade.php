@extends('layouts.app_distributor')

@section('content')
    <div class="container">
        <h1>Print Purchase</h1>
        <div>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $purchase->id }}</td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>{{ $purchase->type_invoice }}</td>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <td>{{ $purchase->name_customer }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $purchase->status == 0 ? 'Pending' : 'Completed' }}</td>
                </tr>
            </table>
        </div>

        <h4>Product Details</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Crop Name</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Amount</th>
            </tr>
            </thead>
            <tbody>
            @php $total = 0; @endphp
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->cropName }}</td>
                    <td>{{ $product->qte }}</td>
                    <td>{{ $product->unite }}</td>
                    <td>{{ number_format($product->amount, 2) }} TND</td>
                </tr>
                @php $total += $product->amount; @endphp
            @endforeach
            <tr>
                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                <td><strong>{{ number_format($total, 2) }} TND</strong></td>
            </tr>
            </tbody>
        </table>
        <button class="btn btn-success" onclick="window.print()">Print</button>
    </div>
@endsection
