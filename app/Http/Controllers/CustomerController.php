<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $search = $request->get('search');
        // Query cơ bản
        $query = Customer::query();
        // Áp dụng tìm kiếm nếu có từ khóa
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }
        // Phân trang
        $khachHang = $query->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(5)->withQueryString();

        // Trả về view với dữ liệu phân trang và từ khóa search
        return view('admins.customer.index', compact('khachHang', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
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


        return redirect::route('khachHang.index')->with('success', 'Thêm khách hàng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $khachHang)
    {
        $user = $khachHang->user;

        if ($user) {
            $user->update([
                'name' => $request->name,
            ]);
        }

        $name = $request->name;
        $phoneNumber = $request->phoneNumber;
        $email = $request->email;

        // Xử lý ảnh đại diện
        $path = $khachHang->avatar; // giữ ảnh cũ nếu không upload mới
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . "-" . $file->getClientOriginalName();
            $path = $file->storeAs('khachHang', $fileName, 'public');
        }

        $khachHang->update([
            'name' => $name,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'avatar' => $path
        ]);
        return redirect::route('khachHang.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $khachHang)
    {
        $khachHang->status = 1;
        $khachHang->save();
        return redirect::route('khachHang.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function restoreCus(Customer $khachHang)
    {
        $khachHang = Customer::findOrFail($khachHang->id);
        $khachHang->status = 0;
        $khachHang->save();
        return redirect::route('khachHang.index')->with('success', 'Cập nhật thông tin thành công!');
    }
}
