<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    //Login
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password']
        ];
        
        // Check if the user is an admin
        if ($validated['email'] == 'admin@gmail.com' && $validated['password'] == 'password!!') {
            $admin = User::where('email', 'admin@gmail.com')->first();
            Auth::login($admin);
            return redirect()->route('admin.dashboard')->with('status', 'Login Successfully as Admin!');
        }

        // Normal user login attempt
        if (Auth::attempt($credentials)) {
            return redirect()->route('user.dashboard')->with('status', 'Login Successfully!');
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    // Show signup form
    public function showSignup()
    {
        return view('auth.signup');
    }

    // Signup
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'user', // Set the user type to 'user'
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully!');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
