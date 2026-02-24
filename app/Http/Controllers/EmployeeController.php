<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $search = $request->get('search');
        // Query cơ bản
        $query = Employee::query();
        // Áp dụng tìm kiếm nếu có từ khóa
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }
        // Phân trang
        $nhanVien = $query->orderBy('status', 'asc')->orderBy('role', 'asc')->orderBy('id', 'desc')->paginate(5)->withQueryString();

        // Trả về view với dữ liệu phân trang và từ khóa search
        return view('admins.employee.index', compact('nhanVien', 'search'));
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
    public function store(StoreEmployeeRequest $request)
    {
        $password = $request->input('password', '123456');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => $request->role
        ]);

        $name = $request->name;
        $role = $request->role;
        $email = $request->email;
        $phoneNumber = $request->phoneNumber;

        $nhanVien = Employee::create([
            'name' => $name,
            'role' => $role,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'user_id' => $user->id,
        ]);

        return redirect::route('nhanVien.index')->with('success', 'Thêm nhân viên thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $nhanVien)
    {
        $role = null;

        if (Auth::user()->id == $nhanVien->user_id) {
            $role = $nhanVien->role;
        } else {
            $role = $request->role;
        }

        $nhanVien->user()->update([
            'name'  => $request->name,
            'phoneNumber' => $request->phoneNumber,
            'role' => $role
        ]);

        $name = $request->name;
        $phoneNumber = $request->phoneNumber;

        // Cập nhật thông tin nhân viên
        $nhanVien->update([
            'name' => $name,
            'role' => $role,
            'phoneNumber' => $phoneNumber,
        ]);

        return redirect::route('nhanVien.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $nhanVien)
    {
        $nhanVien->status = 1;
        $nhanVien->save();
        return redirect::route('nhanVien.index')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function restore(Employee $nhanVien)
    {
        $nhanVien = Employee::findOrFail($nhanVien->id);
        $nhanVien->status = 0;
        $nhanVien->save();
        return redirect::route('nhanVien.index')->with('success', 'Cập nhật thông tin thành công!');
    }
}
