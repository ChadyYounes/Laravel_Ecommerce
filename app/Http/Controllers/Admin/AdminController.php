<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function admin_orders_view() {
        $all_orders = Order::all();
        return view('admin.admin-orders')->with('all_orders', $all_orders);
    }

    public function admin_users_view() {

        $all_users = User::where('email', '!=', 'admin2024@gmail.com')->get();
        return view('admin.admin-users')->with('all_users', $all_users);
    }

    public function admin_stores_view() {

        $all_stores = Store::all();
        return view('admin.admin-stores')->with('all_stores', $all_stores);
    }

    public function updateUserStatus(Request $request, $userId)
{
    $user = User::findOrFail($userId);
    
    // Update the is_active column based on the submitted status
    $user->is_active = $request->status === 'activated' ? true : false;
    $user->save();

    return redirect()->back()->with('success', 'User status updated successfully.');
}

public function user_deactivated_view() {

    return view('errors-pages.deactivated-user-msg');
}
}