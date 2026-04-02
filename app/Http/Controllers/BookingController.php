<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Bill;
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

        $query = Booking::with(['Fields', 'TimeSlot', 'PaymentMethod', 'Bills', 'Employee']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('contactName', 'like', '%' . $search . '%')
                    ->orWhere('contactPhone', 'like', '%' . $search . '%')
                    ->orWhere('contactEmail', 'like', '%' . $search . '%');
            });
        }

        $booking = $query
            ->orderByRaw("FIELD(status, 1, 0, 2, 3, 4)")
            ->orderBy('id', 'desc')
            ->paginate(4)
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

        $field = Field::with(['conflicts', 'reverseConflicts'])
            ->findOrFail($request->field_id);

        try {
            $booking = DB::transaction(function () use ($request, $user, $field) {

                $conflictFieldIds = $field->getConflictFieldIds();

                Field::whereIn('id', $conflictFieldIds)
                    ->lockForUpdate()
                    ->get();

                $exists = Booking::whereIn('field_id', $conflictFieldIds)
                    ->where('bookingDate', $request->date)
                    ->where('time_id', $request->time_id)
                    ->whereNotIn('status', [3, 4])
                    ->exists();

                if ($exists) {
                    throw new \Exception('Khung giờ này đã được đặt!');
                }

                $billAmount = $request->price;

                if ($request->payment_type === 'deposit') {
                    $billAmount = $request->price / 2;
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
                    'customer_id' => $user->customers->id,
                ]);

                $booking->Bills()->create([
                    'payment_id' => $request->payment_id,
                    'amount' => $billAmount,
                    'status' => 0,
                    'payment_type' => $request->payment_type,
                ]);

                return $booking;
            });

            return redirect()
                ->route('booking.success', $booking->id)
                ->with('success', 'Đặt sân bóng thành công!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['time_id' => $e->getMessage()]);
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
        $depositPrice = $price / 2;

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
            'payments',
            'depositPrice'
        ));
    }

    public function success(Request $request, $id)
    {
        $booking = Booking::with(['Fields', 'TimeSlot', 'PaymentMethod', 'Bills'])->findOrFail($id);

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
