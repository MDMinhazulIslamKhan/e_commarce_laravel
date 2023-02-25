@extends('user_temp.layouts.user_profile_layout_temp')
@section('title')
    <title>Pending Orders e-commerce</title>
@endsection
@section('profile_content')
    <h4 class="text-center">Pending Orders</h4>

    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="table-responsive">
            @if ($pending_orders != null)
                <table class="table">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($pending_orders as $pending_order)
                        <tr>
                            @php
                                $product = App\Models\Product::where('id', $pending_order->product_id)->value('product_name');
                            @endphp
                            <td>{{ $product }}</td>
                            <td>{{ $pending_order->quantity }}</td>
                            <td>{{ $pending_order->total_price }}</td>
                        </tr>
                        @php
                            $total = $total + $pending_order->total_price;
                        @endphp
                    @endforeach
                    <tr>
                        <td></td>
                        <th>Total</th>
                        <td class="text">{{ $total }}</td>
                    </tr>
                </table>
            @else
                <h3 class="alert alert-success">No order has been placed</h3>
            @endif
        </div>
    @endsection
