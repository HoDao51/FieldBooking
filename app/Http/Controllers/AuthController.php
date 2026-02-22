<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('admins.auth.login');
    }
    public function postLogin(LoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)){
            // Đăng nhập thành công
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role === 0 || $role === 1) {
                return redirect()->route('admins.index');
            }

            // Nếu role = 2 → sinh viên
            if ($role === 2) {
                return redirect()->route('students.index');
            }
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

        return redirect()->route('login');
    }
}
