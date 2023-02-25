@extends('user_temp.layouts.template')
@section('title')
    <title>Cart e-commerce</title>
@endsection
@section('main-content')
    <h1 class="fashion_taital">Your Cart Item's</h1>

    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="box_main">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($cart_items as $item)
                                <tr>
                                    @php
                                        $product = App\Models\Product::where('id', $item->product_id)->value('product_name');
                                        
                                        $image = App\Models\Product::where('id', $item->product_id)->value('image');
                                    @endphp
                                    <td>{{ $product }}</td>
                                    <td><img src="{{ asset($image) }}" style="height: 70px" alt=""></td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td><a class="btn btn-outline-warning"
                                            href="{{ route('deleteitem', $item->id) }}">Delete</a>
                                    </td>
                                </tr>
                                @php
                                    $total = $total + $item->price;
                                @endphp
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <th>Total</th>
                                <td class="text">{{ $total }}</td>
                                <td>
                                    @if ($total == 0)
                                        <a href="" class="btn btn-outline-primary disabled">Checkout</a>
                                    @else
                                        <a href="{{ route('shippingaddress') }}"
                                            class="btn btn-outline-primary">Checkout</a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
