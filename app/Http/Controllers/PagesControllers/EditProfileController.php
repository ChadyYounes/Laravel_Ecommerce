<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class EditProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    public function editProfileView()
    {
       
        $user = Auth::user();
        return view('profile.editProfile', compact('user'));
    }

    public function deleteAccount(Request $request, $user_id)
            {
                $user = User::findOrFail($user_id);
                $user->delete();
                Auth::logout();
                return redirect()->route('login');
            }

    public function saveProfile(Request $request, $user_id)
            {
                if (Auth::id() != $user_id) {
                    return redirect()->route('home')->withErrors(['error' => 'Unauthorized access']);
                }
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
                        if ($profile->image_url && $profile->image_url !== 'https://bootdey.com/img/Content/avatar/avatar1.png') {
                            Storage::delete('public/profile-images/' . $profile->image_url);
                        }
                    } else {
                        $fileName = $profile->image_url ?? 'https://bootdey.com/img/Content/avatar/avatar1.png'; 
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
}
