<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
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

    public function createStore(){

    }
}
