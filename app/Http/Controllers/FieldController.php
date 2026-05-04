<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFieldRequest;
use App\Http\Requests\UpdateFieldRequest;
use App\Models\Facility;
use App\Models\Field;
use App\Models\FieldType;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class FieldController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Field::with(['images', 'fieldType', 'facility'])->withoutTrashed();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhereHas('facility', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $sanBong = $query->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate(4)->withQueryString();

        $fieldTypes = FieldType::all();
        $images = Image::all();
        $facilities = Facility::all();

        return view('admins.field.index', compact('sanBong', 'search', 'fieldTypes', 'images', 'facilities'));
    }

    public function getFacilityByAddress(Request $request)
    {
        $address = $request->get('address');
        $facility = Facility::where('address', $address)->first();

        if ($facility) {
            return response()->json([
                'cluster_name' => $facility->name,
            ]);
        }

        return response()->json([
            'cluster_name' => null,
        ]);
    }

    public function create()
    {
    }

    public function store(StoreFieldRequest $request)
    {
        $facility = $this->saveFacility($request->address, $request->cluster_name);

        $field = Field::create([
            'name' => $request->name,
            'address' => $request->address,
            'type_id' => $request->type_id,
            'facility_id' => $facility->id,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = time() . '-' . $file->getClientOriginalName();
                $path = $file->storeAs('sanBong', $fileName, 'public');

                Image::create([
                    'field_id' => $field->id,
                    'name' => $path,
                ]);
            }
        }

        return Redirect::route('sanBong.index')->with('success', 'Thêm sân bóng thành công!');
    }

    public function show(Field $field)
    {
    }

    public function edit(Field $field)
    {
    }

    public function update(UpdateFieldRequest $request, Field $sanBong)
    {
        $facility = $this->saveFacility($request->address, $request->cluster_name);

        $sanBong->update([
            'name' => $request->name,
            'address' => $request->address,
            'type_id' => $request->type_id,
            'status' => $request->status,
            'facility_id' => $facility->id,
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

    public function destroy(Field $sanBong)
    {
        $sanBong->delete();

        return redirect()->route('sanBong.index')->with('success', 'Xóa sân bóng thành công');
    }

    private function saveFacility($address, $clusterName)
    {
        $facility = Facility::where('address', $address)->first();

        if ($facility) {
            if (!$clusterName) {
                return $facility;
            }

            if ($facility->name != $clusterName) {
                $facility->update([
                    'name' => $clusterName,
                ]);
            }

            return $facility;
        }

        if (!$clusterName) {
            $clusterName = $address;
        }

        return Facility::create([
            'name' => $clusterName,
            'address' => $address,
        ]);
    }
}
