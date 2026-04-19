<?php

namespace App\Http\Controllers;

use App\Models\Bill;
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

        $bills = $query->paginate(6)->withQueryString();

        return view('admins.bill.index', compact('search', 'bills'));
    }
}
