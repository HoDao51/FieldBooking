<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Booking;
use App\Models\Refund;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Bill::with(['Booking.Fields', 'Booking.TimeSlot', 'PaymentMethod'])
            ->orderBy('id', 'desc');

        if ($search) {
            $query->whereHas('Booking', function ($q) use ($search) {
                $q->where('contactName', 'like', '%' . $search . '%')
                    ->orWhere('contactPhone', 'like', '%' . $search . '%')
                    ->orWhere('contactEmail', 'like', '%' . $search . '%');
            });
        }

        $bills = $query->paginate(4, ['*'], 'bill_page')->withQueryString();

        $refundQuery = Refund::with(['Booking.Fields', 'Booking.TimeSlot'])
            ->orderBy('id', 'desc');

        if ($search) {
            $refundQuery->whereHas('Booking', function ($q) use ($search) {
                $q->where('contactName', 'like', '%' . $search . '%')
                    ->orWhere('contactPhone', 'like', '%' . $search . '%')
                    ->orWhere('contactEmail', 'like', '%' . $search . '%');
            });
        }

        $refunds = $refundQuery->paginate(4, ['*'], 'refund_page')->withQueryString();

        return view('admins.bill.index', compact('search', 'bills', 'refunds'));
    }

    public function show($booking_id)
    {
        $booking = Booking::with(['Fields.facility', 'TimeSlot', 'Bills.PaymentMethod', 'refund'])
            ->findOrFail($booking_id);

        return view('admins.bill.show', compact('booking'));
    }
}
