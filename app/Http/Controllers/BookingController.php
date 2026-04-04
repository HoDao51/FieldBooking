<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreDirectBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Field;
use App\Models\PaymentMethod;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
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

    public function create(Request $request)
    {
        $customers = Customer::orderBy('name')->get();
        $fields = Field::with(['fieldType'])
            ->where('status', 0)
            ->orderBy('name')
            ->get();
        $payments = PaymentMethod::orderBy('name')->get();

        $selectedField = null;
        $date = $request->get('date', now()->toDateString());
        $morning = collect();
        $afternoon = collect();
        $evening = collect();
        $bookedSlots = [];

        if ($request->field_id) {
            $selectedField = Field::with([
                'FieldPrice.TimeSlot',
                'fieldType',
                'images',
                'conflicts',
                'reverseConflicts',
            ])->findOrFail($request->field_id);

            $prices = $selectedField->getPricesByDate($date);
            $slots = $selectedField->splitTimeSlots($prices);
            $bookedSlots = $selectedField->getBookedSlots($date);

            $morning = $slots['morning'];
            $afternoon = $slots['afternoon'];
            $evening = $slots['evening'];
        }

        return view('admins.order.create', compact(
            'customers',
            'fields',
            'payments',
            'selectedField',
            'date',
            'morning',
            'afternoon',
            'evening',
            'bookedSlots'
        ));
    }

    public function store(StoreBookingRequest $request)
    {
        $user = Auth::user();
        $field = Field::with(['conflicts', 'reverseConflicts'])->findOrFail($request->field_id);
        $conflictFieldIds = $field->getConflictFieldIds();

        $exists = Booking::whereIn('field_id', $conflictFieldIds)
            ->where('bookingDate', $request->date)
            ->where('time_id', $request->time_id)
            ->whereNotIn('status', [3, 4])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['time_id' => 'Khung giờ này đã được đặt!']);
        }

        $billAmount = $request->price;

        if ($request->payment_type == 1) {
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

        return redirect()
            ->route('booking.success', $booking->id)
            ->with('success', 'Đặt sân bóng thành công!');
    }

    public function show(Booking $booking)
    {
        //
    }

    public function edit(Booking $booking)
    {
        //
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    public function destroy(Booking $booking)
    {
        //
    }

    public function storeAtField(StoreDirectBookingRequest $request)
    {
        $user = Auth::user();
        $field = Field::with(['conflicts', 'reverseConflicts'])->findOrFail($request->field_id);
        $conflictFieldIds = $field->getConflictFieldIds();

        $exists = Booking::whereIn('field_id', $conflictFieldIds)
            ->where('bookingDate', $request->date)
            ->where('time_id', $request->time_id)
            ->whereNotIn('status', [3, 4])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['time_id' => 'Khung giờ này đã được đặt.']);
        }

        $employeeId = null;

        if ($user->employees) {
            $employeeId = $user->employees->id;
        }

        $customerId = null;

        if ($request->customer_type === 'existing') {
            $customerId = $request->customer_id;
        }

        $booking = Booking::create([
            'bookingDate' => $request->date,
            'totalPrice' => $request->price,
            'status' => 2,
            'contactName' => $request->contactName,
            'contactPhone' => $request->contactPhone,
            'contactEmail' => $request->contactEmail,
            'field_id' => $request->field_id,
            'time_id' => $request->time_id,
            'customer_id' => $customerId,
            'employee_id' => $employeeId,
        ]);

        $booking->Bills()->create([
            'payment_id' => $request->payment_id,
            'amount' => $request->price,
            'status' => 1,
            'payment_type' => 0,
        ]);

        return redirect()
            ->route('donDatSan.index')
            ->with('success', 'Tạo đơn đặt sân tại sân thành công!');
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

        $time = date('H:i', strtotime($timeSlot->startTime)) . ' - ' . date('H:i', strtotime($timeSlot->endTime));

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
