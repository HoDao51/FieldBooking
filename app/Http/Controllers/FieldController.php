<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Support\Facades\Redirect;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFieldRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateFieldRequest;
use App\Models\Employee;
use App\Models\FieldType;
use Illuminate\Support\Facades\Storage;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $search = $request->get('search');
        // Query cơ bản
        $query = Field::query();
        // Áp dụng tìm kiếm nếu có từ khóa
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
        }
        $fieldTypes = FieldType::all();
        $employees  = Employee::all();
        $images = Image::all();
        // Phân trang
        $sanBong = Field::with('images')->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(5);

        // Trả về view với dữ liệu phân trang và từ khóa search
        return view('admins.field.index', compact('sanBong', 'search', 'fieldTypes', 'employees', 'images'));
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
    public function store(StoreFieldRequest $request)
    {
        $employee = Auth::user();

        $name = $request->name;
        $address = $request->address;
        $type_id = $request->type_id;

        $field = Field::create([
            'name' => $name,
            'address' => $address,
            'type_id' => $type_id,
            'employee_id' => $employee->id,
        ]);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $file) {

                $fileName = time() . "-" . $file->getClientOriginalName();

                $path = $file->storeAs('sanBong', $fileName, 'public');

                Image::create([
                    'field_id' => $field->id,
                    'name' => $path,
                ]);
            }
        }

        return Redirect::route('sanBong.index')->with('success', 'Thêm sân bóng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Field $field)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFieldRequest $request, Field $sanBong)
    {
        // Update thông tin cơ bản
        $sanBong->update([
            'name' => $request->name,
            'address' => $request->address,
            'type_id' => $request->type_id,
            'status' => $request->status,
        ]);

        // Xử lý xoá ảnh cũ (nếu có)
        if ($request->has('delete_images')) {

            $imagesToDelete = Image::whereIn('id', $request->delete_images)->get();

            foreach ($imagesToDelete as $image) {

                // Xoá file trong storage
                if (Storage::disk('public')->exists($image->name)) {
                    Storage::disk('public')->delete($image->name);
                }

                // Xoá record database
                $image->delete();
            }
        }

        // Thêm ảnh mới (nếu có)
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $file) {

                $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('sanBong', $fileName, 'public');

                Image::create([
                    'field_id' => $sanBong->id,
                    'name' => $path,
                ]);
            }
        }

        return Redirect::route('sanBong.index')->with('success', 'Cập nhật sân bóng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Field $field)
    {
        //
    }
}
