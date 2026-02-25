<?php

namespace App\Http\Controllers;

use App\Models\FieldPrice;
use App\Models\Field;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFieldPriceRequest;
use App\Http\Requests\UpdateFieldPriceRequest;

class FieldPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm
        $search = $request->get('search');

        // Query cơ bản
        $query = Field::with('images', 'fieldType')->where('status', 0);

        // Nếu có tìm kiếm
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        // Sắp xếp
        $query->orderBy('id', 'desc');

        // Phân trang
        $fields = $query->paginate(6)->appends([
            'search' => $search
        ]);

        return view('admins.pricing_configuration.index', compact(
            'fields',
            'search',
        ));
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
    public function store(StoreFieldPriceRequest $request)
    {
        FieldPrice::create([
            'field_id'     => $request->field_id,
            'time_id' => $request->time_id,
            'day_of_week'  => $request->day_of_week,
            'price'        => $request->price,
        ]);

        return redirect()->back()
            ->with('success', 'Thêm giá thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $field = Field::findOrFail($id);

        $timeSlots = TimeSlot::orderBy('startTime')->get();

        $prices = FieldPrice::with('timeSlot')
        ->where('field_id', $id)
        ->join('time_slots', 'field_prices.time_id', '=', 'time_slots.id')
        ->orderBy('day_of_week')
        ->orderBy('time_slots.startTime')
        ->select('field_prices.*')
        ->get()
        ->groupBy('day_of_week');

        return view('admins.pricing_configuration.show', compact('field', 'prices', 'timeSlots'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FieldPrice $fieldPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFieldPriceRequest $request, FieldPrice $cauHinhGiaGio)
    {
        $cauHinhGiaGio->update($request->all());

        return back()->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FieldPrice $cauHinhGiaGio)
    {
        $cauHinhGiaGio->delete();
        return back()->with('success', 'Xoá thành công');
    }
}
