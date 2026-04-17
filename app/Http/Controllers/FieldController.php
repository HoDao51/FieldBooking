<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFieldRequest;
use App\Http\Requests\UpdateFieldRequest;
use App\Models\Facility;
use App\Models\Field;
use App\Models\FieldType;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Field::with(['images', 'fieldType', 'facility'])->withoutTrashed();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        $sanBong = $query->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(4)->withQueryString();

        $fieldTypes = FieldType::all();
        $images = Image::all();
        $facilities = Facility::all();

        return view('admins.field.index', compact('sanBong', 'search', 'fieldTypes', 'images', 'facilities'));
    }

    /**
     * Get facility by address (API endpoint for autocomplete)
     */
    public function getFacilityByAddress(Request $request)
    {
        $address = $request->get('address');
        $facility = Facility::where('address', $address)->first();

        if ($facility) {
            return response()->json(['cluster_name' => $facility->name]);
        }

        return response()->json(['cluster_name' => null]);
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
        $name = $request->name;
        $address = $request->address;
        $cluster_name = $request->cluster_name;
        $type_id = $request->type_id;

        // Tìm Facility có cùng address
        $existingFacility = Facility::where('address', $address)->first();

        // Nếu không có cluster_name từ form, lấy từ Facility hiện có (nếu tồn tại)
        if (!$cluster_name && $existingFacility) {
            $cluster_name = $existingFacility->name;
        }

        // Nếu vẫn không có cluster_name, tạo từ address
        if (!$cluster_name) {
            $cluster_name = $address;
        }

        // Tìm hoặc tạo Facility
        $facility = Facility::firstOrCreate(
            ['address' => $address],
            ['name' => $cluster_name]
        );

        // Cập nhật tên cụm sân nếu có thay đổi
        if ($facility->name !== $cluster_name) {
            $facility->update(['name' => $cluster_name]);
        }

        $field = Field::create([
            'name' => $name,
            'address' => $address,
            'type_id' => $type_id,
            'facility_id' => $facility->id,
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
        $address = $request->address;
        $cluster_name = $request->cluster_name;

        // Tìm Facility có cùng address
        $existingFacility = Facility::where('address', $address)->first();

        // Nếu không có cluster_name từ form, lấy từ Facility hiện có (nếu tồn tại)
        if (!$cluster_name && $existingFacility) {
            $cluster_name = $existingFacility->name;
        }

        // Nếu vẫn không có cluster_name, tạo từ address
        if (!$cluster_name) {
            $cluster_name = $address;
        }

        // Nếu địa chỉ không thay đổi, cập nhật facility hiện tại
        if ($sanBong->address === $address) {
            if ($sanBong->facility) {
                $sanBong->facility->update(['name' => $cluster_name]);
            }
        } else {
            // Nếu địa chỉ thay đổi, tìm hoặc tạo facility mới
            $facility = Facility::firstOrCreate(
                ['address' => $address],
                ['name' => $cluster_name]
            );

            // Cập nhật tên cụm sân nếu có thay đổi
            if ($facility->name !== $cluster_name) {
                $facility->update(['name' => $cluster_name]);
            }

            $sanBong->facility_id = $facility->id;
        }

        $sanBong->update([
            'name' => $request->name,
            'address' => $address,
            'type_id' => $request->type_id,
            'status' => $request->status,
            'facility_id' => $sanBong->facility_id,
        ]);

        if ($request->has('delete_images')) {
            $imagesToDelete = Image::whereIn('id', $request->delete_images)->get();

            foreach ($imagesToDelete as $image) {
                if (Storage::disk('public')->exists($image->name)) {
                    Storage::disk('public')->delete($image->name);
                }

                $image->delete();
            }
        }

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
    public function destroy(Field $sanBong)
    {
        $sanBong->delete();

        return redirect()->route('sanBong.index')->with('success', 'Xóa sân bóng thành công');
    }
}
