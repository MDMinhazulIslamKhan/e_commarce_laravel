@extends('user_temp.layouts.template')
@section('title')
    <title>{{ $product->product_name }} e-commerce</title>
@endsection
@section('main-content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="box_main">
                    <div class="">
                        <img src="{{ asset($product->image) }}">
                        <p>{{ $product->product_short_des }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="box_main">
                    <div class="product-info">
                        <h4 class="shirt_text">{{ $product->product_name }}</h4>
                        <p class="price_text mb-3">Price <span style="color: #262626;">$
                                {{ $product->price }}</span></p>
                        <p class="lead">{{ $product->product_long_des }}</p>
                    </div>
                    <ul class="my-3 bg-light rounded p-3 ">
                        <li>Category: <span style="color: #262626;">
                                {{ $product->category_name }}</span></li>
                        <li>Category: <span style="color: #262626;">
                                {{ $product->subcategory_name }}</span></li>
                        <li>Available quantity: <span style="color: #262626;">
                                {{ $product->quantity }}</span></li>
                    </ul>
                    <div class="container">
                        <form action="{{ route('addproducttocart') }}" class="w-full" method="POST">
                            @csrf
                            <div class="row my-3 w-50">
                                <label class="col-sm-3 col-form-label" for="basic-default-name">Quantity</label>
                                <div class="col-sm-8">
                                    <input type="number" min="1" max="{{ $product->quantity }}" value="1"
                                        class="form-control" id="product-quantity" name="product-quantity" />
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input class="btn btn-warning" type="submit" value="Add To Cart">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="fashion_taital mt-5 mb-3">Relative Prodducts</h1>
        <div class="fashion_section">
            <div class="row">
                @foreach ($related_products as $related_product)
                    <div class="col-lg-4 col-sm-4">
                        <div class="box_main">
                            <h4 class="shirt_text">{{ $related_product->product_name }}</h4>
                            <p class="price_text">Price <span style="color: #262626;">$
                                    {{ $related_product->price }}</span>
                            </p>
                            <div class="tshirt_img">
                                <img src="{{ asset($related_product->image) }}">
                            </div>
                            <div class="btn_main">
                                <div class="buy_bt">
                                    <form action="{{ route('addproducttocart') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Buy Now</button>
                                    </form>
                                </div>
                                <div class="seemore_bt"><a
                                        href="{{ route('singleproduct', [$related_product->id, $related_product->slug]) }}">See
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
