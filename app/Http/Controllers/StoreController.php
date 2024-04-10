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
}
