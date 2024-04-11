<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\User;
class StoreController extends Controller
{
    public function storeForm($user_id){
        $user = User::findOrFail($user_id);
        return view('storeManagement.addStore',compact('user'));
    }

    public function storeView($user_id){
        $user = User::findOrFail($user_id);
        return  view('storeManagement.store', compact('user'));
    }

    public function homeSellerView($user_id){
        $user = User::findOrFail($user_id);
        return  view('homeSeller',compact('user'));
    }

    public function createStore(Request $request,$user_id){
       //validate the data
       $request->validate([
        'store_name' => 'required|max:255|string',
        'store_category' => 'required',
        'store_description' => 'required|max:255|string',
        'image_url' => 'nullable|mimes:jpeg,png,jpg'
       ]);

        if ($request->has('image_url')) {
            $file = $request->file('image_url');
            $extension = $file->getClientOriginalExtension();

            $fileName = time().'.'.$extension;
            $path = 'public/storage/stores-images';
            $file->move($path,$fileName);

         } else {
            $fileName = 'C:\Users\chadi\Desktop\Final-Project-Laravel\public\storage\stores-images\store.jpg'; 
        }
        Store::create([
            'store_name' => $request->store_name,
            'store_category' => $request->store_category,
            'store_descipriton' => $request->store_description,
            'image_url' => $path.$fileName,
        ]);

        // Redirect to the home page with success message
        return redirect()->route('home')->with('success', 'store created successfully');
    
}
    }

