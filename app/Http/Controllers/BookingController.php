<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Field;
use App\Models\PaymentMethod;
use App\Models\TimeSlot;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

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
    public function store(StoreBookingRequest $request)
    {
        $user = Auth::user();
        $customerId = $user->customers->id;

        DB::beginTransaction();

        try {
            $exists = Booking::where('field_id', $request->field_id)
                ->where('bookingDate', $request->date)
                ->where('time_id', $request->time_id)
                ->lockForUpdate()
                ->exists();

            if ($exists) {
                DB::rollBack();
                return back()->withInput()->withErrors(['time_id' => 'Khung giờ này đã được đặt!']);
            }

            $booking = Booking::create([
                'bookingDate' => $request->date,
                'totalPrice' => $request->price,
                'status' => 0,
                'contactName' => $request->contactName,
                'contactPhone' => $request->contactPhone,
                'contactEmail' => $request->contactEmail,
                'field_id' => $request->field_id,
                'time_id' => $request->time_id,
                'payment_id' => $request->payment_id,
                'customer_id' => $customerId,
            ]);

            DB::commit();
            return redirect()->route('booking.success', $booking->id);
        } catch (QueryException $e) {
            DB::rollBack();

            if ($e->getCode() == 23000) {
                return back()->withErrors(['time_id' => 'Khung giờ này đã được đặt.']);
            }

            throw $e;
        }
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

    public function checkout(CheckoutRequest $request)
    {
        $field = Field::findOrFail($request->field_id);

        $timeSlot = TimeSlot::findOrFail($request->time_id);

        $date = $request->date;
        $price = $request->price;
        $time_id = $request->time_id;
        $payments = PaymentMethod::all();

        $time =
            date('H:i', strtotime($timeSlot->startTime)) .
            ' - ' .
            date('H:i', strtotime($timeSlot->endTime));

        return view('customers.booking.checkout', compact(
            'field',
            'date',
            'time',
            'time_id',
            'price',
            'payments'
        ));
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
