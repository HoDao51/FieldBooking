<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {    
        Booking::updateCompletedBookings();

        $query = Booking::with(['Fields', 'TimeSlot', 'PaymentMethod', 'Bills']);

        $customers = Customer::count();
        $fields = Field::count();
        $bookings = Booking::count();
        $revenue = Booking::whereIn('status', [1, 3])->sum('totalPrice');
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

        // 1. Thống kê sân được đặt nhiều nhất (Top 5)
        $mostBookedFields = Booking::select('field_id', DB::raw('count(*) as total_bookings'))
            ->where('status', '!=', 2) // Không tính đơn hủy
            ->with('Fields.facility')
            ->groupBy('field_id')
            ->orderByDesc('total_bookings')
            ->take(5)
            ->get();

        // 2. Thống kê khung giờ được đặt nhiều nhất theo từng cụm sân
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

        // Lấy top 3 khung giờ cho mỗi cụm sân
        $topTimeSlotsByFacility = $popularTimeSlots->map(function ($items) {
            return $items->take(3);
        });

        return view('admins.dashboard.index', compact('booking', 'customers', 'fields', 'bookings', 'revenue', 'formattedRevenue', 'mostBookedFields', 'topTimeSlotsByFacility'));
    }
}
