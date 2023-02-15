<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index()
    {
        $allProducts = Product::latest()->get();
        return view('admin.allproducts', compact('allProducts'));
    }

    public function AddProduct()
    {
        $Categories = Category::latest()->get();
        $SubCategories = Subcategory::latest()->get();
        return view('admin.addproduct', compact('Categories', 'SubCategories'));
    }

    public function StoreProduct(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
            'category_id' => 'required|numeric',
            'subcategory_id' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], ['category_id.numeric' => 'You must select category', 'subcategory_id.numeric' => 'You must select subcategory']);

        $image = $request->file('image');
        $image_name = hexdec(uniqid()) .  '.' . $image->getClientOriginalExtension();
        $request->image->move(public_path('upload'), $image_name);
        $image_url = 'upload/' . $image_name;

        $category_id = $request->category_id;
        $category_name = Category::where('id', $category_id)->value('category_name');

        $sub_category_id = $request->subcategory_id;
        $subcategory_name = Subcategory::where('id', $sub_category_id)->value('subcategory_name');
        $slug = strtolower(str_replace(' ', '-', $request->product_name));

        Product::insert([
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'category_name' => $category_name,
            'subcategory_name' => $subcategory_name,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'image' => $image_url,
            'slug' => $slug,
        ]);

        Category::where('id', $category_id)->increment('product_count', 1);
        Subcategory::where('id', $sub_category_id)->increment('product_count', 1);

        return redirect()->route('allproducts')->with('message', 'Product Added Successfully!!!');
    }

    public function EditProductImg($id)
    {
        $productInfo = Product::findOrFail($id);
        return view('admin.editproductimg', compact('productInfo'));
    }

    public function UpdateProductImg(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|exists:products',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $image_name = hexdec(uniqid()) .  '.' . $image->getClientOriginalExtension();
        $request->image->move(public_path('upload'), $image_name);
        $image_url = 'upload/' . $image_name;

        $id = $request->id;

        Product::findOrFail($id)->update([
            'image' => $image_url,
        ]);
        return redirect()->route('allproducts')->with('message', 'Product Image Updated Successfully!!!');
    }

    public function EditProduct($id)
    {
        $productInfo = Product::findOrFail($id);
        return view('admin.editproduct', compact('productInfo'));
    }

    public function DeleteProduct($id)
    {
        $category_id = Product::where('id', $id)->value('category_id');
        $sub_category_id = Product::where('id', $id)->value('subcategory_id');

        Product::findOrFail($id)->delete();

        Category::where('id', $category_id)->decrement('product_count', 1);
        Subcategory::where('id', $sub_category_id)->decrement('product_count', 1);
        return redirect()->route('allproducts')->with('message', 'Product Deleted Successfully!!!');
    }
    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;

        $validated = $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
        ]);

        $slug = strtolower(str_replace(' ', '-', $request->product_name));

        Product::findOrFail($product_id)->update([
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'slug' => $slug,
        ]);
        return redirect()->route('allproducts')->with('message', 'Product Updated Successfully!!!');
    }
}
