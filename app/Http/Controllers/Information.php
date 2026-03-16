<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Customer;
use App\Models\Field;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Information extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Field::with(['images', 'fieldType'])
            ->where('status', 0);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        return view('customers.information.profile', compact('search'));
    }

    public function postProfile(UpdateProfileRequest $request)
    {
        $customers = Auth::user()->customers;

        $customers->user->update([
            'name' => $request->name,
        ]);

        $name = $request->name;
        $phoneNumber = $request->phoneNumber;

        // Xử lý ảnh đại diện
        $path = $customers->avatar; // giữ ảnh cũ nếu không upload mới
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . "-" . $file->getClientOriginalName();
            $path = $file->storeAs('khachHang', $fileName, 'public');
        }

        $customers->update([
            'name' => $name,
            'phoneNumber' => $phoneNumber,
            'avatar' => $path
        ]);

        return redirect()->route('information.index')->with('success', 'Cập nhật thông tin thành công');
    }
}
