@extends('user_temp.layouts.template')
@section('main-content')
    <!-- fashion section start -->
    <h1 class="fashion_taital">Welcome {{ Auth::user()->name }}</h1>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="box_main">
                    <ul>
                        <li><a href="{{ route('userprofile') }}">Dashboard</a></li>
                        <li><a href="{{ route('pendingorders') }}">Pending Order</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="box_main">
                    @yield('profile_content')
                </div>
            </div>
        </div>
    </div>
@endsection
