<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Field;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        Booking::updateCompletedBookings();

        $customers = Customer::count();
        $fields = Field::count();
        $bookings = Booking::count();
        $revenue = Booking::whereIn('status', [1, 3])->sum('totalPrice');
        $formattedRevenue = number_format($revenue) . 'đ';

        if ($revenue >= 1000000000) {
            $formattedRevenue = rtrim(rtrim(number_format($revenue / 1000000000, 2, ',', '.'), '0'), ',') . ' tỷ';
        } elseif ($revenue >= 1000000) {
            $formattedRevenue = rtrim(rtrim(number_format($revenue / 1000000, 2, ',', '.'), '0'), ',') . ' triệu';
        }

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
            ->with('Fields.facility')
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
                'facilities.name as facility_name',
                'bookings.time_id',
                DB::raw('count(*) as total_bookings'),
                DB::raw('sum(count(*)) over (partition by facilities.name) as facility_total')
            )
            ->where('bookings.status', '!=', 2)
            ->with('TimeSlot:id,startTime,endTime')
            ->groupBy('facilities.name', 'bookings.time_id')
            ->orderByDesc('facility_total')
            ->orderByDesc('total_bookings')
            ->get()
            ->groupBy('facility_name')
            ->map(function ($items) {
                return $items->take(3);
            });

        return view('admins.dashboard.index', compact('booking', 'customers', 'fields', 'bookings', 'formattedRevenue', 'mostBookedFields', 'topTimeSlotsByFacility'));
    }
}
