@extends('admin.layouts.template')
@section('page_title')
    Dashboard e-commerce
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>All Category</h4>
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
                            <th>Delivery Date</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($approved_order as $order)
                            @php
                                $user = App\Models\User::where('id', $order->user_id)->value('name');
                                $Product_name = App\Models\Product::where('id', $order->product_id)->value('product_name');
                            @endphp
                            <tr>
                                <td>{{ $user }}</td>
                                <td>
                                    <ul>
                                        <li>Phone: {{ $order->phone_number }}</li>
                                        <li>Address: {{ $order->address }}</li>
                                        <li>City: {{ $order->city }}</li>
                                        <li>Postal Code: {{ $order->postal_code }}</li>
                                    </ul>
                                </td>
                                <td>{{ $Product_name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ substr($order->updated_at, 0, 11) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
