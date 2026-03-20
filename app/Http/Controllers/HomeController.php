<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use App\Models\FieldPrice;
use App\Models\FieldType;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
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

        $fields = $query->latest()
            ->take(6)
            ->get();

        $types = FieldType::all();

        return view('customers.home.index', compact('search', 'fields', 'types'));
    }

    public function search(Request $request)
    {

        $search = $request->get('search');
        $type_id = $request->get('type_id');
        $province = $request->get('province');

        $query = Field::with(['images', 'fieldType'])
            ->where('status', 0);

        // search theo tên + địa chỉ
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }
        // lọc theo địa chỉ
        if ($request->province) {
            $province = str_replace('Thành phố ', '', $request->province);
            $province = str_replace('Tỉnh ', '', $request->province);

            $query->where('address', 'like', "%$province%");
        }

        // lọc theo loại sân
        if ($type_id) {
            $query->where('type_id', $type_id);
        }

        $fields = $query->latest()->paginate(6);

        $types = FieldType::all();

        return view('customers.fields.search', compact('search', 'fields', 'types', 'type_id'));
    }

    public function show(Request $request, $id)
    {
        $field = Field::with(['FieldPrice.TimeSlot'])->findOrFail($id);

        $date = $request->date ?? Carbon::today()->toDateString();

        $dayOfWeek = Carbon::parse($date)->dayOfWeekIso;

        $prices = $field->FieldPrice
            ->where('day_of_week', $dayOfWeek)
            ->sortBy(fn($p) => $p->TimeSlot->startTime);

        $timeSlots = $prices->map(function ($price) {
            return $price->TimeSlot;
        });

        $bookedSlots = Booking::where('field_id', $field->id)
            ->where('bookingDate', $date)
            ->pluck('time_id')
            ->toArray();

        return view('customers.fields.show', compact('field', 'prices', 'date', 'timeSlots', 'bookedSlots'));
    }
}
