@extends('admin.layouts.template')
@section('page_title')
    Update Product e-commerce
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Update Product</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Update Product</h5>
                        <small class="text-muted float-end">Input Information</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('updateproduct') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $productInfo->id }}">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        value="{{ old('product_name', $productInfo->product_name) }}" autocomplete="off" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Price</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="{{ old('price', $productInfo->price) }}"autocomplete="off" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">PRODUCT QUANTITY
                                </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        value="{{ old('quantity', $productInfo->quantity) }}"autocomplete="off" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">SHORT
                                    DESCRIPTION</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_short_des"
                                        name="product_short_des"
                                        value="{{ old('product_short_des', $productInfo->product_short_des) }}"autocomplete="off" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Long
                                    Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="product_long_des" rows="3"name="product_long_des"autocomplete="off">{{ old('product_short_des', $productInfo->product_long_des) }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">PRODUCT IMAGE</label>
                                <div class="col-sm-10">
                                    <img style="height: 300px;" src="{{ asset($productInfo->image) }}" alt="">
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
