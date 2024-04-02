<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function storeForm(){
        return view('storeManagement.addStore');
    }

    public function storeView(){
        return  view('storeManagement.store');
    }
}
