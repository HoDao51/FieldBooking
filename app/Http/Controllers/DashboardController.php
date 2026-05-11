<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Field;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {    
        Booking::updateCompletedBookings();

        $query = Booking::with(['Fields', 'TimeSlot', 'PaymentMethod', 'Bills']);

        $customers = Customer::count();
        $fields = Field::count();
        $bookings = Booking::count();
        $fromDate = $request->input('from_date')
            ? Carbon::parse($request->input('from_date'))->startOfDay()
            : now()->subDays(6)->startOfDay();
        $toDate = $request->input('to_date')
            ? Carbon::parse($request->input('to_date'))->startOfDay()
            : now()->startOfDay();

        if ($fromDate->gt($toDate)) {
            [$fromDate, $toDate] = [$toDate, $fromDate];
        }

        $revenueByDate = Booking::select('bookingDate', DB::raw('sum(totalPrice) as total_revenue'))
            ->whereIn('status', [1, 3])
            ->whereBetween('bookingDate', [$fromDate->toDateString(), $toDate->toDateString()])
            ->groupBy('bookingDate')
            ->orderBy('bookingDate')
            ->pluck('total_revenue', 'bookingDate');

        $revenueChart = collect();
        $currentDate = $fromDate->copy();

        while ($currentDate->lte($toDate)) {
            $dateKey = $currentDate->toDateString();
            $revenueChart->push([
                'date' => $dateKey,
                'label' => $currentDate->format('d/m'),
                'revenue' => (int) ($revenueByDate[$dateKey] ?? 0),
            ]);
            $currentDate->addDay();
        }

        $revenue = $revenueChart->sum('revenue');
        $maxRevenue = max($revenueChart->max('revenue') ?? 0, 1);
        $formattedRevenue = number_format($revenue) . 'đ';

        if ($revenue >= 1000000000) {
            $formattedRevenue = number_format($revenue / 1000000000, 2, ',', '.') . ' tỷ';
        } elseif ($revenue >= 1000000) {
            $formattedRevenue = number_format($revenue / 1000000, 2, ',', '.') . ' triệu';
        }

        $booking = $query
            ->orderBy('status','asc')
            ->orderBy('id', 'desc')
            ->paginate(3)
            ->withQueryString();

        $mostBookedFields = Booking::select('field_id', DB::raw('count(*) as total_bookings'))
            ->where('status', '!=', 2)
            ->with('Fields.facility')
            ->groupBy('field_id')
            ->orderByDesc('total_bookings')
            ->take(5)
            ->get();

        $popularTimeSlots = Booking::join('fields', 'bookings.field_id', '=', 'fields.id')
            ->join('facilities', 'fields.facility_id', '=', 'facilities.id')
            ->select('fields.facility_id', 'facilities.name as facility_name', 'bookings.time_id', DB::raw('count(*) as total_bookings'))
            ->where('bookings.status', '!=', 2)
            ->with('TimeSlot')
            ->groupBy('fields.facility_id', 'facilities.name', 'bookings.time_id')
            ->orderBy('fields.facility_id')
            ->orderByDesc('total_bookings')
            ->get()
            ->groupBy('facility_name');

        $topTimeSlotsByFacility = $popularTimeSlots->map(function ($items) {
            return $items->take(3);
        });

        return view('admins.dashboard.index', compact('booking', 'customers', 'fields', 'bookings', 'revenue', 'formattedRevenue', 'revenueChart', 'maxRevenue', 'fromDate', 'toDate', 'mostBookedFields', 'topTimeSlotsByFacility'));
    }
}
