<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CurrencyController extends Controller
{
    public function changeBaseCurrency(Request $request)
    {
        $user=Auth::user();
        $user->base_currency=$request->currency;
        $user->save();
    }
}
