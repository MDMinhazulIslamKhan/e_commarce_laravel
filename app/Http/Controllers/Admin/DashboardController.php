<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function Index()
    {
        $approved_order = Order::where('status', 'Approved')->latest()->get();
        return view('admin.dashboard', compact('approved_order'));
    }

    public function Category()
    {
        return view('admin.all');
    }
}
