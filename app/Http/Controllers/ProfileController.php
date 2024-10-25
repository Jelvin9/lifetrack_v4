<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        $info = UserInfo::where('user_id', $userId)->get();

        return view('profile', compact('info'));
    }

    public function update(Request $request)
{
    $request->validate([
        'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::user(),
        'phone_number' => 'nullable|string|max:15',
        'bio' => 'nullable|string',
    ]);

    $user = Auth::user();
    $userinfo = $user->userinfo; // Assuming userinfo relationship exists

    if ($request->hasFile('profile_pic')) {
        // Store the file in the 'profile_pics' directory of the 'public' disk
        $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');
        
        // Save the path to the profile_pic field in the userinfo table
        $userinfo->profile_pic = $profilePicPath;
    }

    $userinfo->full_name = $request->input('full_name');
    $userinfo->email = $request->input('email');
    $userinfo->phone_number = $request->input('phone_number');
    $userinfo->bio = $request->input('bio');
    
    $userinfo->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

}
