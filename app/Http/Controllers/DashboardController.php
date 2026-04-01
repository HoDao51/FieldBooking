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
        $revenue = Booking::where('status', 2)->sum('totalPrice');

        $booking = $query
            ->orderByRaw("FIELD(status, 1, 0, 2, 3, 4)")
            ->orderBy('id', 'desc')
            ->paginate(3)
            ->withQueryString();

        return view('admins.dashboard.index', compact('booking', 'customers', 'fields', 'bookings', 'revenue'));
    }
}
