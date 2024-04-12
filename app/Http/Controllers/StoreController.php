<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\User;
class StoreController extends Controller
{
    public function storeForm($user_id){
        $user = User::findOrFail($user_id);
        return view('storeManagement.addStore',compact('user'));
    }

    public function storeView($user_id ) {
        $user = User::findOrFail($user_id);
        $stores = Store::where('seller_id', $user_id)->get();
        return  view('storeManagement.store', compact('user','stores'));
    }

    public function homeSellerView($user_id){
        $user = User::find($user_id);
        return  view('homeSeller',compact('user'));
    }

    public function createStore(Request $request,$user_id){
       $user = User::find($user_id);
       $userId = Auth::id();
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
            $path = 'storage/stores-images';
            $file->move($path,$fileName);

            Store::create([
                'store_name' => $request->store_name,
                'store_category' => $request->store_category,
                'store_description' => $request->store_description,
                'image_url' => $path.$fileName,
                'seller_id' =>  $userId

            ]);

         } else {
            $fileName = 'C:\Users\chadi\Desktop\Final-Project-Laravel\public\storage\stores-images\store.jpg'; 
            Store::create([
                'store_name' => $request->store_name,
                'store_category' => $request->store_category,
                'store_description' => $request->store_description,
                'image_url' => $fileName,
                'seller_id' =>  $userId
            ]);
        }
      

        // Redirect to the home page with success message
        return redirect()->route('storeFormView', ['user_id' => $user->id])->with('success', 'store created successfully');
}
    }

