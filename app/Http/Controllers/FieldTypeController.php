<?php

namespace App\Http\Controllers;

use App\Models\FieldType;
use App\Http\Requests\StoreFieldTypeRequest;
use App\Http\Requests\UpdateFieldTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FieldTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = FieldType::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $fieldTypes = $query->orderBy('id', 'desc')->paginate(4)->withQueryString();

        return view('admins.field_type.index', compact('fieldTypes', 'search'));
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
    public function store(StoreFieldTypeRequest $request)
    {
        FieldType::create([
            'name' => $request->name,
        ]);

        return Redirect::route('loaiSan.index')->with('success', 'Thêm loại sân thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FieldType $loaiSan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FieldType $loaiSan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFieldTypeRequest $request, FieldType $loaiSan)
    {
        $loaiSan->update([
            'name' => $request->name,
        ]);

        return Redirect::route('loaiSan.index')->with('success', 'Cập nhật loại sân thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FieldType $loaiSan)
    {
        if ($loaiSan->fields()->exists()) {
            return Redirect::route('loaiSan.index')
                ->with('error', 'Không thể xóa loại sân này vì vẫn còn sân đang sử dụng.');
        }

        $loaiSan->delete();

        return Redirect::route('loaiSan.index')->with('success', 'Xóa loại sân thành công!');
    }
}
