<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SetProfileController extends Controller
{
    public function setProfileView($user_id) {
        // Find the user by ID
        $user = User::findOrFail($user_id);
        
        // Pass the user to the view
        return view('profile.setProfile', compact('user'));
    }
    
        public function saveProfile(Request $request, $user_id) {
            try {
                $request->validate([
                    'image_url' => 'image|mimes:jpeg,png,jpg,gif|max:800', // Adjust max file size as needed
                ]);
        
                // Handle image upload
                if ($request->hasFile('image_url')) {
                    $image = $request->file('image_url');
                    $fileName = time() . '.' . $image->getClientOriginalExtension();
                    $filePath = 'profile-images/' . $fileName;
                    Storage::putFileAs('public', $image, $filePath);
                } else {
                    $fileName = 'https://bootdey.com/img/Content/avatar/avatar1.png'; 
                }
        
                // Create a new profile instance
                $profile = new Profile();
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
                $profile->user_id = $user_id;
                $profile->save();
        
                // Update the user's role based on the radio button
                $user = User::findOrFail($user_id);
                $role_id = $request->input('buyer-seller') == 'buyer' ? 1 : 2;
                $user->role_id = $role_id;
                $user->save();
        
                // Redirect to the home page with user_id parameter
                return redirect()->route('home', ['user_id' => $user_id])->with('success', 'Profile saved successfully');
            } catch (\Exception $e) {
                Log::error("Error saving profile: {$e->getMessage()}");
                // Redirect back to the form page with an error message
                return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while saving the profile']);
            }
    }
}
