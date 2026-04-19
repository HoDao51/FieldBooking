<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Field;
use App\Models\FieldType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Facility::with([
            'fields' => function ($q) {
                $q->where('status', 0)
                    ->orderBy('id')
                    ->with(['images', 'fieldType']);
            }
        ]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        $facilities = $query->get()->filter(function ($facility) {
            return $facility->representativeField != null;
        });

        $types = FieldType::all();

        return view('customers.home.index', compact('search', 'facilities', 'types'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $type_id = $request->get('type_id');
        $province = $request->get('province');

        $query = Facility::with([
            'fields' => function ($q) use ($type_id) {
                $q->where('status', 0)
                    ->orderBy('id')
                    ->with(['images', 'fieldType']);

                if ($type_id) {
                    $q->where('type_id', $type_id);
                }
            }
        ]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        if ($province) {
            $province = str_replace(['Thành phố ', 'Tỉnh '], '', $province);
            $query->where('address', 'like', '%' . $province . '%');
        }

        $facilities = $query->get()->filter(function ($facility) {
            return $facility->representativeField != null;
        })->values();

        $types = FieldType::all();

        return view('customers.fields.search', compact('search', 'facilities', 'types', 'type_id'));
    }

    public function show(Request $request, $id)
    {
        $field = Field::with([
            'FieldPrice.TimeSlot',
            'fieldType',
            'images',
        ])->findOrFail($id);

        $date = $request->get('date', now()->toDateString());

        $facilityFields = Field::with(['fieldType', 'images'])
            ->withoutTrashed()
            ->where('status', 0)
            ->where('facility_id', $field->facility_id)
            ->orderBy('type_id')
            ->orderBy('name')
            ->get();

        $prices = $field->getPricesByDate($date);
        $slots = $field->splitTimeSlots($prices);
        $blockedSlots = $field->getBlockedSlots($date);

        return view('customers.fields.show', [
            'field' => $field,
            'facilityFields' => $facilityFields,
            'date' => $date,
            'morning' => $slots['morning'],
            'afternoon' => $slots['afternoon'],
            'evening' => $slots['evening'],
            'blockedSlots' => $blockedSlots
        ]);
    }
}
