@extends('layouts.app_distributor')

@section('content')
    <div class="container">
        <h1>Purchase Details</h1>

        {{-- Purchase Info --}}
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
            <tr>
                <th>Date</th>
                <td>{{ $purchase->created_at->format('d/m/Y') }}</td>
            </tr>
        </table>

        {{-- Product Info --}}
        <h3>Products</h3>
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
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>{{ number_format($total, 2) }} TND</strong></td>
            </tr>
            </tbody>
        </table>

        <a href="{{ route('purchases.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection
