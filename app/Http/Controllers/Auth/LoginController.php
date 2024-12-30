<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login process
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            \Log::info('User logged in: ', ['user' => $user]);
    
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role === 'member') {
                return redirect()->route('home');
            }
        }
    
        \Log::warning('Login failed for credentials: ', $credentials);
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ]);
    }
    
    

    // Handle the logout process
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
