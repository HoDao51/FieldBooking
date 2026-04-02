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

        if ($request->province) {
            $province = str_replace(['Thành phố ', 'Tỉnh '], '', $request->province);
            $query->where('address', 'like', "%$province%");
        }

        if ($type_id) {
            $query->where('type_id', $type_id);
        }

        $fields = $query->latest()->paginate(6);
        $types = FieldType::all();

        return view('customers.fields.search', compact('search', 'fields', 'types', 'type_id'));
    }

    public function show(Request $request, $id)
    {
        $field = Field::with([
            'FieldPrice.TimeSlot',
            'conflicts',
            'reverseConflicts'
        ])->findOrFail($id);

        $date = $request->get('date', now()->toDateString());

        $prices = $field->getPricesByDate($date);

        $slots = $field->splitTimeSlots($prices);

        $bookedSlots = $field->getBookedSlots($date);

        return view('customers.fields.show', [
            'field' => $field,
            'date' => $date,
            'morning' => $slots['morning'],
            'afternoon' => $slots['afternoon'],
            'evening' => $slots['evening'],
            'bookedSlots' => $bookedSlots,
        ]);
    }
}
