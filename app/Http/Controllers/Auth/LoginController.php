<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoginController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login attempt
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to log the user in
        if (FacadesAuth::attempt(['email' => $request->email, 'password' => $request->password], $request->has('remember'))) {
            
                    // Access the logged-in user's ID
            $userId = FacadesAuth::id(); // This gives you the user's ID
            
            // Use the $userId in your function logic
            // Example: Retrieve user-related data
            $userData = User::find($userId);

            
            // Redirect to the intended page
            return redirect()->route('dashboard');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request)
    {
        FacadesAuth::logout();
        return redirect()->route('login');
    }
}
