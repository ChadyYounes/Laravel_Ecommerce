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
    public function productView($store_id)
    {
        $store = Store::findOrFail($store_id);
        $user = User::findOrFail(Auth::user() -> id);
        $total_products = Product::count();
        return view('Products.products',compact('store','user', 'total_products'));
    }


    public function createProduct(Request $request, $store_id)
{
    // Validate the request data
    $request->validate([
        'product_name' => 'required|max:255|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|numeric|min:0',
        'description' => 'required|max:255|string',
        'product_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required',
    ]);

    $store = Store::findOrFail($store_id);
    $category = Category::findOrFail($request->category_id);

    // Handle file upload
    if ($request->hasFile('product_url')) {
        $file = $request->file('product_url');

        // Store the file in the 'public/product-images' directory
        $filePath = $file->store('product-images', 'public');

        // Create the product
        Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'store_id' => $store_id,
            'quantity' => $request->quantity,
            'category_id' => $category->id,
            'product_url' => $filePath, // Store the relative path
        ]);
    }

    return redirect()->route('addProductView', ['store_id' => $store->id])->with('success', 'Product created successfully');
}
        public function addProductView($store_id)
            {
                $store = Store::findOrFail($store_id);
                $user = User::findOrFail(Auth::user() -> id);
                $category = Category::all();

                return view('Products.addProduct',compact('store','user','category'));
            }
        public function deleteProduct($product_id)
            {
                $product = Product::findOrFail($product_id);
                $store_id = $product->store_id;
                $product->delete();

                return Redirect()->route('productsView', ['store_id' => $store_id])->with('success', 'Product deleted successfully');
            }

        public function editProductView($product_id)
            {
                $product = Product::findOrFail($product_id);
                $store = Store::findOrFail($product->store_id);
                $user = User::findOrFail(Auth::user()->id);
                $categories = Category::all();

                return view('Products.editProductView', compact('product', 'store', 'user', 'categories'));
            }

        public function editProduct(Request $request, $product_id)
            {
                // Validate the request data
                $request->validate([
                    'product_name' => 'required|max:255|string',
                    'price' => 'required|numeric|min:0',
                    'quantity' => 'required|numeric|min:0',
                    'description' => 'required|max:255|string',
                    'product_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                    'category_id' => 'required',
                ]);

                $product = Product::findOrFail($product_id);
                $category = Category::findOrFail($request->category_id);

                // Handle file upload if there's a new image
                if ($request->hasFile('product_url')) {
                    $file = $request->file('product_url');
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time().'.'.$extension;
                    $path = "storage/product-images/";
                    $file->move($path, $fileName);
                    $product->product_url = $path.$fileName;
                }

                // Update the product
                $product->update([
                    'product_name' => $request->product_name,
                    'price' => $request->price,
                    'description' => $request->description,
                    'quantity' => $request->quantity,
                    'category_id' => $category->id,
                ]);

                return redirect()->route('productsView', ['store_id' => $product->store_id])->with('success', 'Product updated successfully');
            }
}
