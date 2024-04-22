<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Category;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productView($store_id){
        $store = Store::findOrFail($store_id);
        $user = User::findOrFail(Auth::user() -> id);
        $product = Product::where('store_id',$store->id)->get();

        return view('Products.products',compact('store','product','user'));
    }


    public function createProduct(Request $request, $store_id)
{
    // Validate the request data
    $request->validate([
        'product_name' => 'required|max:255|string',
        'price' => 'required|numeric',
        'description' => 'required|max:255|string',
        'product_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required', 
    ]);

    $store = Store::findOrFail($store_id); 

    
    $category = Category::findOrFail($request->category_id);

    $file = $request->file('product_url');
    $extension = $file->getClientOriginalExtension();
    $fileName = time().'.'.$extension;
    $path = "storage/product-images/";
    $file->move($path, $fileName);

    
    Product::create([
        'product_name' => $request->product_name,
        'price' => $request->price,
        'description' => $request->description,
        'product_url' => $path.$fileName,
        'store_id' => $store_id,
        'category_id' => $category->id,
    ]);

    return redirect()->route('addProductView', ['store_id' => $store->id])->with('success', 'Product created successfully');
}

public function addProductView($store_id){
    $store = Store::findOrFail($store_id);
    $user = User::findOrFail(Auth::user() -> id);
    $category = Category::all();

    return view('Products.addProduct',compact('store','user','category'));
}

}
