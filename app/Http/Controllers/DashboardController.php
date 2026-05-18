<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Field;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        Booking::updateCompletedBookings();

        $customers = Customer::count();
        $fields = Field::count();
        $bookings = Booking::count();

        $booking = Booking::with(['Fields', 'TimeSlot', 'PaymentMethod', 'Bills'])
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(3)
            ->withQueryString();

        $mostBookedFields = Booking::join('fields', 'bookings.field_id', '=', 'fields.id')
            ->join('facilities', 'fields.facility_id', '=', 'facilities.id')
            ->select(
                'bookings.field_id',
                'facilities.name as facility_name',
                DB::raw('count(*) as total_bookings')
            )
            ->where('bookings.status', '!=', 2)
            ->with(['Fields.facility', 'Fields.FieldType', 'Fields.images'])
            ->groupBy('bookings.field_id', 'facilities.name')
            ->orderByDesc('total_bookings')
            ->get()
            ->groupBy('facility_name')
            ->map(function ($items) {
                return $items->first();
            })
            ->sortByDesc('total_bookings')
            ->take(3);

        $topTimeSlotsByFacility = Booking::join('fields', 'bookings.field_id', '=', 'fields.id')
            ->join('facilities', 'fields.facility_id', '=', 'facilities.id')
            ->select(
                'facilities.id as facility_id',
                'facilities.name as facility_name',
                'bookings.time_id',
                DB::raw('count(*) as total_bookings'),
                DB::raw('sum(count(*)) over (partition by facilities.name) as facility_total')
            )
            ->where('bookings.status', '!=', 2)
            ->with('TimeSlot:id,startTime,endTime')
            ->groupBy('facilities.id', 'facilities.name', 'bookings.time_id')
            ->orderByDesc('facility_total')
            ->orderByDesc('total_bookings')
            ->get()
            ->groupBy('facility_name')
            ->sortByDesc(function ($items) {
                return $items->first()->facility_total;
            })
            ->take(3)
            ->map(function ($items) {
                return $items->take(3);
            });

        $currentYear = date('Y');
        $currentMonth = date('m');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        $monthlyRevenues = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyRevenues[$month] = 0;
        }

        $bookingsThisYear = Booking::whereIn('status', [1, 3])
            ->whereYear('created_at', $currentYear)
            ->get();

        foreach ($bookingsThisYear as $b) {
            $monthOfBooking = $b->created_at->format('n');
            $monthlyRevenues[$monthOfBooking] = $monthlyRevenues[$monthOfBooking] + $b->totalPrice;
        }

        $dailyRevenues = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dailyRevenues[$day] = 0;
        }

        $bookingsThisMonth = Booking::whereIn('status', [1, 3])
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->get();

        foreach ($bookingsThisMonth as $b) {
            $dayOfBooking = $b->created_at->format('j');
            $dailyRevenues[$dayOfBooking] = $dailyRevenues[$dayOfBooking] + $b->totalPrice;
        }

        return view('admins.dashboard.index', compact(
            'booking', 'customers', 'fields', 'bookings', 
            'mostBookedFields', 'topTimeSlotsByFacility', 'monthlyRevenues', 'dailyRevenues',
            'currentYear', 'currentMonth'
        ));
    }

    public function detailedFields(Request $request)
    {
        $query = Booking::join('fields', 'bookings.field_id', '=', 'fields.id')
            ->join('facilities', 'fields.facility_id', '=', 'facilities.id')
            ->select(
                'bookings.field_id',
                'facilities.name as facility_name',
                DB::raw('count(*) as total_bookings')
            )
            ->where('bookings.status', '!=', 2)
            ->with(['Fields.facility', 'Fields.FieldType', 'Fields.images']);

        if ($request->has('facility_id')) {
            $query->where('facilities.id', $request->facility_id);
        }

        $mostBookedFields = $query->groupBy('bookings.field_id', 'facilities.name')
            ->orderByDesc('total_bookings')
            ->get()
            ->groupBy('facility_name');

        return view('admins.dashboard.detailed_fields', compact('mostBookedFields'));
    }

    public function detailedTimeSlots(Request $request)
    {
        $query = Booking::join('fields', 'bookings.field_id', '=', 'fields.id')
            ->join('facilities', 'fields.facility_id', '=', 'facilities.id')
            ->select(
                'facilities.id as facility_id',
                'facilities.name as facility_name',
                'fields.id as field_id',
                'fields.name as field_name',
                'bookings.time_id',
                DB::raw('count(*) as total_bookings'),
                DB::raw('sum(count(*)) over (partition by facilities.name) as facility_total')
            )
            ->where('bookings.status', '!=', 2)
            ->with('TimeSlot:id,startTime,endTime');

        if ($request->has('facility_id')) {
            $query->where('facilities.id', $request->facility_id);
        }

        $topTimeSlotsByFacility = $query->groupBy('facilities.id', 'facilities.name', 'fields.id', 'fields.name', 'bookings.time_id')
            ->orderByDesc('facility_total')
            ->orderByDesc('total_bookings')
            ->get()
            ->groupBy('facility_name');

        if (!$request->has('facility_id')) {
            $topTimeSlotsByFacility = $topTimeSlotsByFacility
                ->sortByDesc(function ($items) {
                    return $items->first()->facility_total;
                })
                ->take(3);
        }

        $topTimeSlotsByFacility = $topTimeSlotsByFacility
            ->map(function ($facilities) {
                return $facilities->groupBy('field_name');
            });

        return view('admins.dashboard.detailed_timeslots', compact('topTimeSlotsByFacility'));
    }
}
