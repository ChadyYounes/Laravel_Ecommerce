<?php

namespace App\Http\Controllers;

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
        'mainly_selling' => 'required',
        'store_description' => 'required|max:255|string',
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:800'
       ]);

       try {
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $filePath = 'stores-images/' . $fileName;
            Storage::putFileAs('public', $image, $filePath);
        } else {
            $fileName = 'https://bootdey.com/img/Content/avatar/avatar1.png'; 
        }

        // Redirect to the home page with success message
        return redirect()->route('home')->with('success', 'store created successfully');
    } catch (\Exception $e) {
        Log::error("Error creating store: {$e->getMessage()}");
        // Redirect back to the form page with an error message
        return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the store']);
    }
}
    }

