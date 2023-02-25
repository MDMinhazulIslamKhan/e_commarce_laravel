<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Index()
    {
        $products = Product::inRandomOrder()->get();
        return view('user_temp.home', compact('products'));
    }
}
