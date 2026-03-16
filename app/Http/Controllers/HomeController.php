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

    public function search(Request $request){

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

        return view('customers.fields.search', compact('search', 'fields', 'types'));
    }
    
    public function show(Request $request, $id)
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

        return view('customers.fields.show', compact('search', 'field', 'prices', 'date', 'timeSlots', 'bookedSlots'));
    }
}
