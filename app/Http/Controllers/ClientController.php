<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

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
        $user_id = Auth::id();
        $cart_items = Cart::where('user_id', $user_id)->latest()->get();
        return view('user_temp.addtocart', compact('cart_items'));
    }

    public function AddProductToCart(Request $request)
    {
        $product_price = $request->price;
        $quantity = $request->quantity;
        $price = $product_price * $quantity;
        Cart::insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'price' => $price,
        ]);
        return redirect()->route('addtocart')->with('message', 'Your item added to cart successfully!!!');
    }

    public function DeleteItem($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->route('addtocart')->with('message', 'Cart item deleted successfully!!!');
    }

    public function AddShippingInfo(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
        ]);
        ShippingInfo::insert([
            'phone_number' => $request->phone_number,
            'user_id' => Auth::id(),
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
        ]);
        return redirect()->route('checkout');
    }

    public function Checkout()
    {
        $user_id = Auth::id();
        $cart_items = Cart::where('user_id', $user_id)->latest()->get();
        $shipping_info = ShippingInfo::where('user_id', $user_id)->latest('id')->first();
        return view('user_temp.checkout', compact('cart_items', 'shipping_info'));
    }

    public function PlaceOrder()
    {
        $user_id = Auth::id();
        $shipping_info = ShippingInfo::where('user_id', $user_id)->latest('id')->first();
        $cart_items = Cart::where('user_id', $user_id)->latest()->get();

        foreach ($cart_items as $cart_item) {
            Order::insert([
                'user_id' => $user_id,
                'phone_number' => $shipping_info->phone_number,
                'address' => $shipping_info->address,
                'city' => $shipping_info->city,
                'postal_code' => $shipping_info->postal_code,
                'product_id' => $cart_item->product_id,
                'quantity' => $cart_item->quantity,
                'total_price' => $cart_item->price,
            ]);
            $id = $cart_item->id;
            Cart::findOrFail($id)->delete();
        }
        ShippingInfo::where('user_id', $user_id)->latest('id')->first()->delete();

        return redirect()->route('pendingorders')->with('message', 'Your Order Has Been placed successfully!!!');
    }

    public function CancelOrder()
    {
        $user_id = Auth::id();
        ShippingInfo::where('user_id', $user_id)->latest('id')->first()->delete();
        return redirect()->route('addtocart');
    }

    public function ShippingAddress()
    {
        return view('user_temp.shippingaddress');
    }

    public function UserProfile()
    {
        $user_id = Auth::id();
        $approved_order = Order::where('user_id', $user_id)->where('status', 'Approved')->latest()->get();
        return view('user_temp.userprofile', compact('approved_order'));
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
        $user_id = Auth::id();
        $pending_orders = Order::where('user_id', $user_id)->where('status', 'pending')->latest()->get();
        return view('user_temp.pendingorders', compact('pending_orders'));
    }

    public function History()
    {
        return view('user_temp.history');
    }
}
