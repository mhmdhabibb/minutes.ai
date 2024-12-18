<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // USER
    public function showLogin()
    {
        return view('auth.login');
    }
    //Login User
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return redirect()->route('user.dashboard')->with('status', 'Login Succesfully!');
        } else {
            return back()->withErrors([
                'email' => 'This email is not registered.',
            ]);
        }
    }

    //signup
    public function showSignup()
    {
        return view('auth.signup');
    }

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
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // ADMIN
    public function showAdminLoginForm()
    {
        return view('admin.login');
    }
    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // guard 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('status', 'Logout successfully!');
    }

    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.settings', compact('admin'));
    }
}

