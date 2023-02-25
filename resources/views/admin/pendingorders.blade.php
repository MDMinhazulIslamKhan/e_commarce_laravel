@extends('admin.layouts.template')
@section('page_title')
    Pending Orders e-commerce
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Pending Orders</h4>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">Available Category Information</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Customer Name</th>
                            <th>Shipping Information</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total bill</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($pending_orders as $pending_order)
                            @php
                                $user = App\Models\User::where('id', $pending_order->user_id)->value('name');
                                $Product_name = App\Models\Product::where('id', $pending_order->product_id)->value('product_name');
                            @endphp
                            <tr class="h-1">
                                <td>{{ $user }}</td>
                                <td>
                                    <ul>
                                        <li>Phone: {{ $pending_order->phone_number }}</li>
                                        <li>Address: {{ $pending_order->address }}</li>
                                        <li>City: {{ $pending_order->city }}</li>
                                        <li>Postal Code: {{ $pending_order->postal_code }}</li>
                                    </ul>
                                </td>
                                <td>{{ $Product_name }}</td>
                                <td>{{ $pending_order->quantity }}</td>
                                <td>{{ $pending_order->total_price }}</td>
                                <td><a href="{{ route('approved', $pending_order->id) }}"
                                        class="btn btn-success">Approved</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
