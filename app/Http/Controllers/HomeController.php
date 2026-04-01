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

        $query = Field::with(['images', 'fieldType', 'conflicts', 'reverseConflicts'])
            ->where('status', 0);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        $fields = $query->orderBy('id', 'desc')->paginate(6)->withQueryString();

        $types = FieldType::all();

        return view('customers.home.index', compact('search', 'fields', 'types'));
    }

    public function search(Request $request)
    {

        $search = $request->get('search');
        $type_id = $request->get('type_id');
        $province = $request->get('province');

        $query = Field::with(['images', 'fieldType', 'conflicts', 'reverseConflicts'])
            ->where('status', 0);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        // lọc theo địa chỉ
        if ($request->province) {
            $province = str_replace(['Thành phố ', 'Tỉnh '], '', $request->province);

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
        $field = Field::with(['FieldPrice.TimeSlot', 'conflicts', 'reverseConflicts'])->findOrFail($id);

        if ($request->has('date')) {
            $date = $request->date;
        } else {
            $date = Carbon::today()->toDateString();
        }

        $dayOfWeek = Carbon::parse($date)->dayOfWeekIso;

        $prices = $field->FieldPrice
            ->where('day_of_week', $dayOfWeek)
            ->sortBy(fn($p) => $p->TimeSlot->startTime);

        $conflictFieldIds = $field->getConflictFieldIds();

        $bookedSlots = Booking::whereIn('field_id', $conflictFieldIds)
            ->where('bookingDate', $date)
            ->whereNotIn('status', [3, 4])
            ->pluck('time_id')
            ->toArray();

        $morning = $prices->filter(function ($p) {
            return Carbon::parse($p->TimeSlot->startTime)->hour < 12;
        });

        $afternoon = $prices->filter(function ($p) {
            $hour = Carbon::parse($p->TimeSlot->startTime)->hour;
            return $hour >= 12 && $hour < 18;
        });

        $evening = $prices->filter(function ($p) {
            return Carbon::parse($p->TimeSlot->startTime)->hour >= 18;
        });

        return view('customers.fields.show', compact(
            'field',
            'date',
            'morning',
            'afternoon',
            'evening',
            'bookedSlots'
        ));
    }
}
