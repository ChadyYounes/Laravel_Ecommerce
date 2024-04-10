<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class SetProfileController extends Controller
{
    public function setProfileView() {
        // Get the currently authenticated user
        $user = Auth::user();
        
        // Pass the user to the view
        return view('profile.setProfile', compact('user'));
    }
    
    public function saveProfile(Request $request) {
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
            
            // Get authenticated user's ID
            $user_id = Auth::id();
            $profile->user_id = $user_id;
            
            $profile->save(); // Save profile
    
            // Update the user's role based on the radio button
            $user = User::findOrFail($user_id);
            $role_id = $request->input('buyer-seller') == 'buyer' ? 1 : 2;
            $user->role_id = $role_id;
            $user->save();
    
            // Redirect to the home page with success message
            return redirect()->route('home')->with('success', 'Profile saved successfully');
        } catch (\Exception $e) {
            Log::error("Error saving profile: {$e->getMessage()}");
            // Redirect back to the form page with an error message
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while saving the profile']);
        }
    }
}
