<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials, $request->has('remember'))) {
            return redirect()->intended('dashboard');
        }
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
}