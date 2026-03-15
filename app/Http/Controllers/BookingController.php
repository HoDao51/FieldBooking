<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Field;
use App\Models\PaymentMethod;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Booking::with(['Fields', 'TimeSlot', 'PaymentMethod']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('contactName', 'like', '%' . $search . '%')
                    ->orWhere('contactPhone', 'like', '%' . $search . '%')
                    ->orWhere('contactEmail', 'like', '%' . $search . '%');
            });
        }

        $booking = $query
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('admins.order.index', compact('search', 'booking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // tách giờ
        [$start, $end] = explode(' - ', $request->time);

        // format về dạng database
        $start = date('H:i:s', strtotime($start));
        $end = date('H:i:s', strtotime($end));

        $timeSlot = \App\Models\TimeSlot::where('startTime', $start)
            ->where('endTime', $end)
            ->first();

        $booking = Booking::create([
            'bookingDate' => $request->date,
            'totalPrice' => $request->price,
            'status' => 0,
            'contactName' => $request->contactName,
            'contactPhone' => $request->contactPhone,
            'contactEmail' => $request->contactEmail,
            'field_id' => $request->field_id,
            'time_id' => $timeSlot->id,
            'payment_id' => $request->payment_id,
        ]);

        return redirect()->route('booking.success', $booking->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function checkout(Request $request)
    {
        $field = Field::findOrFail($request->field_id);
        $payments = PaymentMethod::all();

        return view('customers.booking.checkout', compact('field', 'payments'), [
            'field' => $field,
            'date' => $request->date,
            'time' => $request->time,
            'price' => $request->price,
        ]);
    }

    public function success($id)
    {
        $booking = Booking::with(['Fields', 'TimeSlot', 'PaymentMethod'])->findOrFail($id);

        return view('customers.booking.success', compact('booking'));
    }

    public function confirm($id)
    {
        Booking::findOrFail($id)->update(['status' => 1]);
        return back();
    }

    public function reject($id)
    {
        Booking::findOrFail($id)->update(['status' => 4]);
        return back();
    }

    public function complete($id)
    {
        Booking::findOrFail($id)->update(['status' => 2]);
        return back();
    }

    public function cancel($id)
    {
        Booking::findOrFail($id)->update(['status' => 3]);
        return back();
    }
}
