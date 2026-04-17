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

        $facilities = Facility::query()
            ->with(['fields' => function ($q) {
                $q->where('status', 0)->orderBy('id');
            }])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%');
                });
            })
            ->get();

        $facilities = $facilities->map(function ($facility) {
            $representativeField = $facility->fields->first();
            
            return (object) [
                'id' => $facility->id,
                'name' => $facility->name,
                'address' => $facility->address,
                'representative_field_id' => $representativeField?->id,
                'fields_count' => $facility->fields->count(),
            ];
        })->filter(fn($f) => $f->representative_field_id !== null);

        $representativeIds = $facilities->pluck('representative_field_id');
        $representativeFields = Field::with(['images'])
            ->whereIn('id', $representativeIds)
            ->get()
            ->keyBy('id');

        $types = FieldType::all();

        return view('customers.home.index', compact('search', 'facilities', 'representativeFields', 'types'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $type_id = $request->get('type_id');
        $province = $request->get('province');

        $facilitiesQuery = Facility::query();

        // Search in facility name or address
        if ($search) {
            $facilitiesQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        // Filter by province in facility address
        if ($province) {
            $province = str_replace(['Thành phố ', 'Tỉnh '], '', $province);
            $facilitiesQuery->where('address', 'like', "%$province%");
        }

        $facilitiesQuery->with(['fields' => function ($q) use ($type_id) {
            $q->where('status', 0)->orderBy('id');
            if ($type_id) {
                $q->where('type_id', $type_id);
            }
        }]);

        $facilities = $facilitiesQuery->get();

        $facilities = $facilities->map(function ($facility) {
            $representativeField = $facility->fields->first();
            
            return (object) [
                'id' => $facility->id,
                'name' => $facility->name,
                'address' => $facility->address,
                'representative_field_id' => $representativeField?->id,
                'fields_count' => $facility->fields->count(),
            ];
        })->filter(fn($f) => $f->representative_field_id !== null)->values();

        $representativeIds = $facilities->pluck('representative_field_id');
        $representativeFields = Field::with(['images', 'fieldType'])
            ->whereIn('id', $representativeIds)
            ->get()
            ->keyBy('id');

        $types = FieldType::all();

        return view('customers.fields.search', compact(
            'search',
            'facilities',
            'representativeFields',
            'types',
            'type_id'
        ));
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
            ->where('address', $field->address)
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
