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
    public function index()
    {
        $types = FieldType::all();
        $fields = Field::where('status', 0)
            ->latest()
            ->take(6)
            ->get();

        return view('customers.home.index', compact('fields', 'types'));
    }

    public function show(Request $request, $id)
    {
        $field = Field::with(['FieldPrice.TimeSlot'])->findOrFail($id);

        // ngày được chọn
        $date = $request->date ?? Carbon::today()->toDateString();

        // lấy thứ
        $dayOfWeek = Carbon::parse($date)->dayOfWeekIso;

        // bảng giá theo thứ
        $prices = $field->FieldPrice
            ->where('day_of_week', $dayOfWeek)
            ->sortBy(fn($p) => $p->TimeSlot->startTime);

        // tất cả khung giờ
        $timeSlots = $prices->map(function ($price) {
            return $price->TimeSlot;
        });

        // các khung giờ đã đặt
        $bookedSlots = Booking::where('field_id', $field->id)
            ->where('bookingDate', $date)
            ->pluck('time_id')
            ->toArray();

        return view('customers.fields.show', compact('field', 'prices', 'date', 'timeSlots', 'bookedSlots'));
    }
}
