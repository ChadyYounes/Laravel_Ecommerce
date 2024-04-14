<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
        public function admin_orders_view()
                {
                $all_orders = Order::all();
                return view('admin.admin-orders')->with('all_orders', $all_orders);
                }

        public function admin_users_view()
                {

                    $all_users = User::where('email', '!=', 'admin2024@gmail.com')->get();
                    return view('admin.admin-users')->with('all_users', $all_users);
                }

        public function admin_stores_view()
                {

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
                
        public function updateStoreStatus(Request $request, $storeId)
                {
                    $store = Store::findOrFail($storeId);
                    
                    // Update the is_active column based on the submitted status
                    $store->is_active = $request->status === 'activated' ? true : false;
                    $store->save();

                    return redirect()->back()->with('success', 'User status updated successfully.');
                }

        public function user_deactivated_view()
                {

                    return view('errors-pages.deactivated-user-msg');
                }

        public function user_info_view($user_id)
                {

                    $user = User::find($user_id);

                    return view('admin.user-info')->with('user', $user);
                }

        public function saveProfileByAdmin(Request $request, $user_id)
                {
                    
                try {
                        $request->validate([
                            'image_url' => 'image|mimes:jpeg,png,jpg,gif|max:800', 
                        ]);

                    
                        $user = User::findOrFail($user_id);
                        $profile = $user->getProfile;

                        // Handle image upload
                        if ($request->hasFile('image_url')) {
                            $image = $request->file('image_url');
                            $fileName = time() . '.' . $image->getClientOriginalExtension();
                            $filePath = 'profile-images/' . $fileName;
                            Storage::putFileAs('public', $image, $filePath);

                            // Delete old image if exists
                            if ($profile->image_url && $profile->image_url !== null) {
                                Storage::delete('public/profile-images/' . $profile->image_url);
                            }
                        } else {
                            $fileName = null;
                        }

                        
                        $profile->image_url = $fileName;
                        $profile->full_name = $request->input('full_name');
                        $profile->birth_day = $request->input('birth_day');
                        $profile->country = $request->input('country');
                        $profile->phone = $request->input('phone');
                        $profile->address = $request->input('address');
                        $profile->x_twitter = $request->input('x_twitter');
                        $profile->facebook = $request->input('facebook');
                        $profile->linkedin = $request->input('linkedin');
                        $profile->instagram = $request->input('instagram');
                        $profile->save();

                        
                        if ($request->filled('name') && $request->input('name') !== $user->name) {
                            $user->name = $request->input('name');
                            $user->save();
                        }

                        
                        return redirect()->route('home')->with('success', 'Profile saved successfully');
                    } catch (\Exception $e) {
                        Log::error("Error saving profile: {$e->getMessage()}");
                        
                        return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while saving the profile']);
                    }
                }
                public function deleteUserAccountByAdmin(Request $request, $user_id)
            {
                $user = User::findOrFail($user_id);
                $user->delete();
                return redirect()->route('home');
            }

        public function store_info_view($store_id) {

            $store = Store::find($store_id);
            return view('admin.store-info')->with('store', $store);
            
        }


        public function updateStoreByAdmin(Request $request, $store_id)
                { 
                    $userId = Auth::id();
                    $user = User::find($userId);
                
                $store = Store::findOrFail($store_id);

                $request->validate([
                    'store_name' => 'required|max:255|string',
                    'store_category' => 'required',
                    'store_description' => 'required|max:255|string',
                    'image_url' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                if ($request->hasFile('image_url')) {
                    $file = $request->file('image_url');
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '.' . $extension;
                    $path = "storage/stores-images/";
                    $file->move($path, $fileName);
                    $store->image_url = $path . $fileName;
                }

                $store->store_name = $request->store_name;
                $store->store_category = $request->store_category;
                $store->store_description = $request->store_description;

                $store->save();

                // return redirect()->route('storeView',['user_id'=>$user->id, 'store_id' => $store->id])->with('updateSuccess', 'Store updated successfully');
                return redirect()->route('home')->with('success', 'Profile saved successfully');

            }
            
            public function deleteStoreByAdmin(Request $request, $store_id)
            {
                $store = Store::findOrFail($store_id);
                $store->delete();
                return redirect()->route('home');
            }
}