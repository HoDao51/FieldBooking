<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function login()
    {
        return view('customers.auth.login');
    }
    public function PostLogin(CustomerLoginRequest $request)
    {
        $user = User::where('email', $request->email)
            ->where('role', 2)
            ->whereHas('customers', function ($query) {
                $query->where('status', 0);
            })
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác!',
            'password' => 'Email hoặc mật khẩu không chính xác!',
        ]);
    }

    public function register()
    {
        return view('customers.auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
        ]);

        $name = $request->name;
        $phoneNumber = $request->phoneNumber;
        $email = $request->email;

        // xử lý ảnh đại diện
        $path = null;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . "-" . $file->getClientOriginalName();
            $path = $file->storeAs('khachHang', $fileName, 'public');
        }

        $khachHang = Customer::create([
            'name' => $name,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'avatar' => $path,
            'user_id' => $user->id,
        ]);

        return redirect()->route('customer.login')->with('success', 'Đăng ký thành công');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
