<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Bill;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Field;
use App\Models\Refund;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Information extends Controller
{

    public function index(Request $request)
    {
        return view('customers.information.profile');
    }

    public function postProfile(UpdateProfileRequest $request)
    {
        $customers = Auth::user()->customers;

        $customers->user->update([
            'name' => $request->name,
        ]);

        $name = $request->name;
        $phoneNumber = $request->phoneNumber;

        // Xử lý ảnh đại diện
        $path = $customers->avatar; // giữ ảnh cũ nếu không upload mới
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . "-" . $file->getClientOriginalName();
            $path = $file->storeAs('khachHang', $fileName, 'public');
        }

        $customers->update([
            'name' => $name,
            'phoneNumber' => $phoneNumber,
            'avatar' => $path
        ]);

        return redirect()->route('information.index')->with('success', 'Cập nhật thông tin thành công');
    }

    public function history(Request $request)
    {
        Booking::updateCompletedBookings();

        $query = Booking::with(['Fields', 'TimeSlot', 'PaymentMethod', 'Bills'])
            ->where('customer_id', Auth::user()->customers->id);

        $booking = $query
            ->orderByRaw("FIELD(status, 4, 0, 1, 3, 2)")
            ->orderBy('id', 'desc')
            ->paginate(5, ['*'], 'booking_page')
            ->withQueryString();

        return view('customers.information.history', compact('booking'));
    }

    public function transactionHistory(Request $request)
    {
        Booking::updateCompletedBookings();

        $bills = Bill::with(['Booking.Fields', 'Booking.TimeSlot', 'PaymentMethod'])
            ->whereHas('Booking', function ($query) {
                $query->where('customer_id', Auth::user()->customers->id);
            })
            ->orderBy('id', 'desc')
            ->paginate(5, ['*'], 'bill_page')
            ->withQueryString();

        $refunds = Refund::with(['Booking.Fields', 'Booking.TimeSlot'])
            ->whereHas('Booking', function ($query) {
                $query->where('customer_id', Auth::user()->customers->id);
            })
            ->orderBy('id', 'desc')
            ->paginate(5, ['*'], 'refund_page')
            ->withQueryString();

        return view('customers.information.transaction_history', compact('bills', 'refunds'));
    }

    public function showTransaction($booking_id)
    {
        $booking = Booking::with(['Fields.facility', 'TimeSlot', 'Bills.PaymentMethod', 'refund'])
            ->where('customer_id', Auth::user()->customers->id)
            ->findOrFail($booking_id);

        return view('customers.information.transaction_detail', compact('booking'));
    }

    public function confirmCancel($id)
    {
        $booking = Booking::with('Bills')
            ->where('customer_id', Auth::user()->customers->id)
            ->findOrFail($id);

        if ($booking->status != 4) {
            return redirect()->back()->with('error', 'Đơn hàng không ở trạng thái chờ xác nhận hủy.');
        }

        $paidAmount = $booking->Bills->sum('amount');

        $booking->update(['status' => 2]);
        $booking->Bills()->update(['status' => 0]);

        if ($paidAmount > 0) {
            \App\Models\Refund::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'amount' => $paidAmount,
                    'reason' => $booking->cancel_reason ?? 'Admin hủy sân',
                ]
            );
        }

        \Illuminate\Support\Facades\Mail::to($booking->contactEmail)
            ->send(new \App\Mail\CancelOrder($booking, $booking->cancel_reason ?? 'Admin hủy sân'));

        return redirect()->route('information.history')->with('success', 'Bạn đã xác nhận hủy đặt sân thành công.');
    }

    public function rejectCancel($id)
    {
        $booking = Booking::where('customer_id', Auth::user()->customers->id)
            ->findOrFail($id);

        if ($booking->status != 4) {
            return redirect()->back()->with('error', 'Đơn hàng không ở trạng thái chờ xác nhận hủy.');
        }

        // Restore to paid status (1) — adjust if your app tracks a different previous status
        $booking->update([
            'status' => 1,
            'cancel_reason' => null,
        ]);

        return redirect()->route('information.history')->with('success', 'Bạn đã từ chối yêu cầu hủy đặt sân.');
    }
}
