<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerLoginRequest;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function login() {
        return view('customers.auth.login');
    }
    public function PostLogin(CustomerLoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)){
            // Đăng nhập thành công
            $request->session()->regenerate();

            $role = Auth::user()->role;
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác!',
            'password' => 'Email hoặc mật khẩu không chính xác!',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
