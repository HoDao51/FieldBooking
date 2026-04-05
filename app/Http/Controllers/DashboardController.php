<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Field;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {    
        $query = Booking::with(['Fields', 'TimeSlot', 'PaymentMethod', 'Bills']);

        $customers = Customer::count();
        $fields = Field::count();
        $bookings = Booking::count();
        $revenue = Booking::where('status', 1)->sum('totalPrice');
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

        return view('admins.dashboard.index', compact('booking', 'customers', 'fields', 'bookings', 'revenue', 'formattedRevenue'));
    }
}
