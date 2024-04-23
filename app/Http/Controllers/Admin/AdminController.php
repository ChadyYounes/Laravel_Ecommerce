<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Mail\StoreStatus;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
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
                    $total_stores = Store::count();
                    $active_stores = Store::where('is_active', true)->count();
                    $deactivated_stores = Store::where('is_active', false)->count();
                    $all_stores = Store::all();
                
                    return view('admin.admin-stores', compact('total_stores', 'active_stores', 'deactivated_stores', 'all_stores'));
                }
                public function admin_categories_view()
                {
                    $total_categories = Category::count();
                    $all_categories = Category::all();
                
                    return view('admin.admin-categories', compact('total_categories', 'all_categories'));
                }
        public function admin_stores_deactivated_view()
                {
                        $deactivated_stores_nbr = Store::where('is_active', false)->count();
                        $deactivated_stores = Store::where('is_active', false)->get();
                        return view('admin.admin-stores-deactivated')
                        ->with('deactivated_stores', $deactivated_stores)
                        ->with('deactivated_stores_nbr', $deactivated_stores_nbr);
                }
        public function admin_stores_activated_view()
                {
                        $active_stores_nbr = Store::where('is_active', true)->count();
                        $activated_stores = Store::where('is_active', true)->get();
                        return view('admin.admin-stores-activated')
                        ->with('activated_stores', $activated_stores)
                        ->with('active_stores_nbr', $active_stores_nbr);
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
                    $status = $request->status === 'activated' ? true : false;
                    $store->is_active = $status;
                    $store->save();
                
                    // Send email notification to the store owner
                    $sellerEmail = $store->getUser->email;
                    Mail::to($sellerEmail)->send(new StoreStatus($status, $store->store_name));

                
                    return redirect()->back()->with('success', 'Store status updated successfully.');
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

            
                return redirect()->route('home')->with('success', 'Profile saved successfully');

            }
        public function addCategory(Request $request)
                {
                    $request->validate([
                        'category_name' => 'required|unique:categories,category_name', 
                    ]);
                    $existingCategory = Category::where('category_name', $request->category_name)->first();

                    if ($existingCategory) {
                        return redirect()->back()->with('error', 'Category already exists!');
                    }

                    $new_category = new Category();
                    $new_category->category_name = $request->category_name;
                    $new_category->save();
                    return redirect()->back();
                }

        public function deleteStoreByAdmin($store_id)
                {
                    $store = Store::findOrFail($store_id);
                    $store->delete();
                    return redirect()->route('home');
                }
        public function deleteCategoryByAdmin($category_id)
                {
                    $store = Category::findOrFail($category_id);
                    $store->delete();
                    return redirect()->route('admin.categories');
                }
        public function super_search_view(Request $request)
                {
                    $query = $request->input('query');
                    $users = [];
                    $stores = [];
                    $products = [];
                
                    if ($query) {
                        $users = User::where('name', 'like', "%$query%")
                                     ->orWhere('email', 'like', "%$query%")
                                     ->get();
                
                        $stores = Store::where('store_name', 'like', "%$query%")
                                       ->orWhere('store_category', 'like', "%$query%")
                                       ->orWhere('store_description', 'like', "%$query%")
                                       ->get();
                
                        $products = Product::where('product_name', 'like', "%$query%")
                                           ->get();
                    }
                
                    return view('admin.super-search', compact('users', 'stores', 'products'));
                }
        
}