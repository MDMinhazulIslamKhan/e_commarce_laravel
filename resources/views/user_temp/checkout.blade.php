@extends('user_temp.layouts.template')
@section('title')
    <title>Checkout e-commerce</title>
@endsection
@section('main-content')
    <!-- fashion section start -->
    <h2 class="fashion_taital">Final Step to place your order</h2>

    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-8">
                <div class="box_main">
                    <h3>Product will send at:</h3>
                    <p>Address: {{ $shipping_info->address }}</p>
                    <p>City: {{ $shipping_info->city }}</p>
                    <p>Post code: {{ $shipping_info->postal_code }}</p>
                    <p>Phone Number: {{ $shipping_info->phone_number }}</p>
                </div>
                <div>
                    <form action="{{ route('placeorder') }}" method="POST" class="d-inline mr-2">
                        @csrf
                        <input type="submit" value="Place Order" class="btn btn-primary">
                    </form>
                    <form action="{{ route('cancelorder') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="submit" value="Cancel Order" class="btn btn-danger">
                    </form>
                </div>
            </div>
            <div class="col-4">
                <div class="box_main">
                    <h3>Your Final Product are:</h3>
                    <div class="row">
                        <div class="col-12">
                            <div class="box_main">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($cart_items as $item)
                                            <tr>
                                                @php
                                                    $product = App\Models\Product::where('id', $item->product_id)->value('product_name');
                                                    
                                                @endphp
                                                <td>{{ $product }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>
                                            </tr>
                                            @php
                                                $total = $total + $item->price;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <th>Total</th>
                                            <td class="text">{{ $total }}</td>
                                            <td>
                                                @if ($total == 0)
                                                    <a href="" class="btn btn-outline-primary disabled">Checkout</a>
                                                @else
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
