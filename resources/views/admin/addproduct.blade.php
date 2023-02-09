@extends('admin.layouts.template')
@section('page_title')
    Add Product e-commerce
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Add Product</h4>
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
                        <h5 class="mb-0">Add New Product</h5>
                        <small class="text-muted float-end">Input Information</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('storeproduct') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_name" name="product_name"
                                        placeholder="Samsung S20" autocomplete="off" value="{{ old('product_name') }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Price</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="price" name="price"
                                        placeholder="20000" value="{{ old('price') }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        placeholder="20" value="{{ old('quantity') }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Short
                                    Description</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="product_short_des"
                                        name="product_short_des" autocomplete="off"
                                        value="{{ old('product_short_des') }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Long
                                    Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="product_long_des" rows="3"name="product_long_des"autocomplete="off">{{ old('product_long_des') }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Category</label>
                                <div class="col-sm-10">
                                    <select id="category_id" name="category_id" class="form-select">
                                        <option selected>Open this select menu</option>
                                        @foreach ($Categories as $Category)
                                            <option value="{{ $Category->id }}">{{ $Category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Sub Category</label>
                                <div class="col-sm-10">
                                    <select id="subcategory_id" name="subcategory_id" class="form-select">
                                        <option selected>Open this select menu</option>
                                        @foreach ($SubCategories as $SubCategory)
                                            <option value="{{ $SubCategory->id }}">{{ $SubCategory->subcategory_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="image" name="image" />
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
