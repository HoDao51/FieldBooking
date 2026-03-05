<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldPrice;
use App\Models\FieldType;
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

        // lấy ngày được chọn
        $date = $request->date ?? Carbon::today()->toDateString();

        // lấy thứ trong tuần
        $dayOfWeek = Carbon::parse($date)->dayOfWeekIso;

        // lọc bảng giá theo thứ
        $prices = $field->FieldPrice->where('day_of_week', $dayOfWeek);

        return view('customers.fields.show', compact('field','prices','date'));
    }
}
