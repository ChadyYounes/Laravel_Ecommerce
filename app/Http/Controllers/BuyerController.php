<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Store;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function buyerLayout() {
        $stores = Store::paginate(6);
        $user = Auth::user();        
        return view('buyerLayout.buyerStores', compact( 'stores','user'));
    }
   
}
