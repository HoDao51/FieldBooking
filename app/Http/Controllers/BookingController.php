<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreDirectBookingRequest;
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
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(4)
            ->withQueryString();

        return view('admins.order.index', compact('search', 'booking'));
    }

    public function create(Request $request)
    {
        $customers = Customer::orderBy('name')->get();
        $fields = Field::with('fieldType')
            ->where('status', 0)
            ->orderBy('name')
            ->get();
        $payments = PaymentMethod::all();

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
            ])->findOrFail($request->field_id);

            $prices = $selectedField->getPricesByDate($date);
            $slots = $selectedField->splitTimeSlots($prices);

            $morning = $slots['morning'];
            $afternoon = $slots['afternoon'];
            $evening = $slots['evening'];
            $bookedSlots = $selectedField->getBlockedSlots($date);
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
        $field = Field::findOrFail($request->field_id);

        $error = $this->checkTimeSlot($field, $request->date, $request->time_id);
        if ($error) {
            return back()
                ->withInput()
                ->withErrors(['time_id' => $error]);
        }

        $billAmount = $request->price;
        if ($request->payment_type == 1) {
            $billAmount = $request->price / 2;
        }

        $payment = PaymentMethod::find($request->payment_id);

        if ($payment && $payment->name == 'VNPay') {
            session([
                'booking_data' => $this->getBookingSessionData($request, $user->customers->id)
            ]);

            return redirect()->route('vnpay.payment', [
                'total_vnpay' => $billAmount
            ]);
        }

        if ($payment && $payment->name == 'Ví điện tử MoMo') {
            session([
                'booking_data' => $this->getBookingSessionData($request, $user->customers->id)
            ]);

            return redirect()->route('momo.payment', [
                'total_momo' => $billAmount
            ]);
        }

        $status = 0;
        if ($request->payment_type == 0) {
            $status = 1;
        }

        $booking = Booking::create([
            'bookingDate' => $request->date,
            'totalPrice' => $request->price,
            'status' => $status,
            'contactName' => $request->contactName,
            'contactPhone' => $request->contactPhone,
            'contactEmail' => $request->contactEmail,
            'field_id' => $request->field_id,
            'time_id' => $request->time_id,
            'customer_id' => $user->customers->id,
        ]);

        $billStatus = 0;
        if ($status == 1) {
            $billStatus = 1;
        }

        $booking->Bills()->create([
            'payment_id' => $request->payment_id,
            'amount' => $billAmount,
            'status' => $billStatus,
            'payment_type' => $request->payment_type,
        ]);

        return redirect()
            ->route('booking.success', $booking->id)
            ->with('success', 'Đặt sân bóng thành công!');
    }

    public function storeAtField(StoreDirectBookingRequest $request)
    {
        $user = Auth::user();
        $field = Field::findOrFail($request->field_id);

        $error = $this->checkTimeSlot($field, $request->date, $request->time_id);
        if ($error) {
            return back()
                ->withInput()
                ->withErrors(['time_id' => $error]);
        }

        $employeeId = null;
        if ($user->employees) {
            $employeeId = $user->employees->id;
        }

        $customerId = null;
        if ($request->customer_type == 'existing') {
            $customerId = $request->customer_id;
        }

        $booking = Booking::create([
            'bookingDate' => $request->date,
            'totalPrice' => $request->price,
            'status' => 1,
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

        if ($timeSlot->status != 1) {
            return back()->withErrors(['time_id' => 'Khung giờ này đang tạm khóa để bảo trì.']);
        }

        $date = $request->date;
        $price = $request->price;
        $time_id = $request->time_id;
        $payments = PaymentMethod::where('name', 'NOT LIKE', '%thanh toán tiền mặt%')->get();
        $depositPrice = $price / 2;

        $time = date('H:i', strtotime($timeSlot->startTime)) . ' - ' .
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
        $booking = Booking::with(['Fields', 'TimeSlot', 'PaymentMethod', 'Bills'])
            ->findOrFail($id);

        return view('customers.booking.success', compact('booking'));
    }

    public function completePage($id)
    {
        $booking = Booking::with(['Fields', 'TimeSlot', 'Bills.PaymentMethod'])->findOrFail($id);

        $paidAmount = $booking->Bills->sum('amount');
        $remainingAmount = $booking->totalPrice - $paidAmount;

        if ($remainingAmount < 0) {
            $remainingAmount = 0;
        }

        return view('admins.order.complete', compact('booking', 'paidAmount', 'remainingAmount'));
    }

    public function complete($id)
    {
        $booking = Booking::with('Bills')->findOrFail($id);

        $paidAmount = $booking->Bills->sum('amount');
        $remainingAmount = $booking->totalPrice - $paidAmount;

        $cashPayment = PaymentMethod::where('name', 'like', '%tiền mặt%')->first();

        if (!$cashPayment) {
            return back()->with('error', 'Chưa có phương thức thanh toán tiền mặt.');
        }

        $booking->Bills()->create([
            'payment_id' => $cashPayment->id,
            'amount' => $remainingAmount,
            'status' => 1,
            'payment_type' => 0,
            'paid_at' => now(),
        ]);

        $booking->update([
            'status' => 1,
        ]);

        return redirect()
            ->route('donDatSan.index')
            ->with('success', 'Xác nhận thanh toán thành công!');
    }

    public function cancel($id)
    {
        Booking::findOrFail($id)->update(['status' => 2]);
        return back();
    }

    private function checkTimeSlot($field, $date, $timeId)
    {
        $isTimeSlotAvailable = TimeSlot::where('id', $timeId)
            ->where('status', 1)
            ->exists();

        if (!$isTimeSlotAvailable) {
            return 'Khung giờ này đang tạm khóa để bảo trì.';
        }

        $blockedSlots = $field->getBlockedSlots($date);

        if (in_array($timeId, $blockedSlots)) {
            return 'Khung giờ này đã được đặt.';
        }

        return null;
    }

    private function getBookingSessionData($request, $customerId)
    {
        return [
            'date' => $request->date,
            'price' => $request->price,
            'field_id' => $request->field_id,
            'time_id' => $request->time_id,
            'contactName' => $request->contactName,
            'contactPhone' => $request->contactPhone,
            'contactEmail' => $request->contactEmail,
            'payment_type' => $request->payment_type,
            'user_id' => $customerId,
        ];
    }
}
