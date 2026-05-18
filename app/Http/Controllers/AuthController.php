<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('admins.auth.login');
    }
    public function postLogin(LoginRequest $request) {
        $user = User::where('email', $request->email)
            ->whereIn('role', [0, 1])
            ->whereHas('employees', function ($query) {
                $query->where('status', 0);
            })
            ->first();

        if ($user && Hash::check($request->password, $user->password)){
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('admins.index');
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
