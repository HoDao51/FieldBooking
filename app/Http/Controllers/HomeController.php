<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $fields = Field::query()
            ->where('status', 0)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%');
                });
            })
            ->orderByDesc('id')
            ->get(['id', 'address']);

        $facilities = $fields
            ->groupBy('address')
            ->map(function ($group, $address) {
                $representative = $group->first();

                return (object) [
                    'address' => $address,
                    'representative_field_id' => $representative->id,
                    'fields_count' => $group->count(),
                ];
            })
            ->values();

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

        $fields = Field::query()
            ->where('status', 0)
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%');
                });
            });

        if ($province) {
            $province = str_replace(['Thành phố ', 'Tỉnh '], '', $request->province);
            $fields->where('address', 'like', "%$province%");
        }

        if ($type_id) {
            $fields->where('type_id', $type_id);
        }

        $fields = $fields
            ->orderByDesc('id')
            ->get(['id', 'address']);

        $facilities = $fields
            ->groupBy('address')
            ->map(function ($group, $address) {
                $representative = $group->first();

                return (object) [
                    'address' => $address,
                    'representative_field_id' => $representative->id,
                    'fields_count' => $group->count(),
                ];
            })
            ->values();

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
