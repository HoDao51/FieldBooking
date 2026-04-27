<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Bill;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Field;
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
            ->orderByRaw("FIELD(status, 0, 1, 3, 2, 4)")
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
            ->paginate(5)
            ->withQueryString();

        return view('customers.information.transaction_history', compact('bills'));
    }
}
