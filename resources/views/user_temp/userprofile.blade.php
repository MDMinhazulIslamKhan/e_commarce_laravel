@extends('user_temp.layouts.user_profile_layout_temp')
@section('title')
    <title>Dashboard e-commerce</title>
@endsection
@section('profile_content')
    <h4 class="text-center">Your Previous Order</h4>

    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Total Price</th>
                    <th>Delivery Date</th>
                </tr>
                @foreach ($approved_order as $order)
                    <tr>
                        @php
                            $product = App\Models\Product::where('id', $order->product_id)->value('product_name');
                        @endphp
                        <td>{{ $product }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ substr($order->updated_at, 0, 11) }}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    @endsection
