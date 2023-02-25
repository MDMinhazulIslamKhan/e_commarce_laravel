@extends('user_temp.layouts.template')
@section('title')
    <title>Cart e-commerce</title>
@endsection
@section('main-content')
    <h1 class="fashion_taital">Your Shipping Address</h1>

    <div class="container">
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
            <div class="col-12">
                <div class="box_main">
                    <div class="card-body">
                        <form action="{{ route('addshippinginfo') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="phone_number">Phone Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        placeholder="+8801234567890" autocomplete="off" value="{{ old('phone_number') }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="address">Full Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address" name="address" placeholder=""
                                        autocomplete="off" value="{{ old('address') }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="city">City/Village</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="city" name="city" placeholder=""
                                        autocomplete="off" value="{{ old('city') }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="postal_code">Postal Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                                        placeholder="" autocomplete="off" value="{{ old('postal_code') }}" />
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
