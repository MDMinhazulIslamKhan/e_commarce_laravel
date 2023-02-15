<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function category($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->latest()->get();
        return view('user_temp.category', compact('category', 'products'));
    }

    public function SingleProduct($id)
    {
        $product = Product::findOrFail($id);
        $sub_cat_id = Product::where('id', $id)->value('subcategory_id');
        $related_products = Product::where('subcategory_id', $sub_cat_id)->latest()->get();
        return view('user_temp.singleproduct', compact('product', 'related_products'));
    }

    public function AddToCart()
    {
        return view('user_temp.addtocart');
    }

    public function AddProductToCart()
    {
        return view('user_temp.addtocart');
    }

    public function Checkout()
    {
        return view('user_temp.checkout');
    }

    public function UserProfile()
    {
        return view('user_temp.userprofile');
    }

    public function NewReleases()
    {
        return view('user_temp.newreleases');
    }

    public function TodaysDeals()
    {
        return view('user_temp.todaysdeals');
    }

    public function CustomerService()
    {
        return view('user_temp.customerservice');
    }

    public function PendingOrders()
    {
        return view('user_temp.pendingorders');
    }

    public function History()
    {
        return view('user_temp.history');
    }
}
