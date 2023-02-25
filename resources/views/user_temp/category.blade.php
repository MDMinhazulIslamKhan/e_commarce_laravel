@extends('user_temp.layouts.template')
@section('title')
    <title>{{ $category->category_name }} e-commerce</title>
@endsection
@section('main-content')
    <div class="container">
        <h1 class="fashion_taital">{{ $category->category_name }} - ({{ $category->product_count }})</h1>
        <div class="fashion_section">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-sm-4">
                        <div class="box_main">
                            <h4 class="shirt_text">{{ $product->product_name }}</h4>
                            <p class="price_text">Price <span style="color: #262626;">$
                                    {{ $product->price }}</span></p>
                            <div class="tshirt_img">
                                <img src="{{ asset($product->image) }}">
                            </div>
                            <div class="btn_main">
                                <div class="buy_bt">
                                    <form action="{{ route('addproducttocart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-warning">Buy Now</button>
                                    </form>
                                </div>
                                <div class="seemore_bt"><a
                                        href="{{ route('singleproduct', [$product->id, $product->slug]) }}">See More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
