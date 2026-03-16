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
        $query = Booking::with(['Fields', 'TimeSlot', 'PaymentMethod']);

        $customers = Customer::count();
        $fields = Field::count();
        $bookings = Booking::count();
        $revenue = Booking::where('status', 3)->sum('totalPrice');

        $booking = $query
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('admins.dashboard.index', compact('booking', 'customers', 'fields', 'bookings', 'revenue'));
    }
}
