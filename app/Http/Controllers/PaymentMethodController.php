<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = PaymentMethod::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $paymentMethods = $query->orderBy('id', 'desc')->paginate(4)->withQueryString();

        return view('admins.payment_method.index', compact('paymentMethods', 'search'));
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
    public function store(StorePaymentMethodRequest $request)
    {
        PaymentMethod::create([
            'name' => $request->name,
        ]);

        return Redirect::route('phuongThucThanhToan.index')->with('success', 'Thêm phương thức thanh toán thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentMethod $phuongThucThanhToan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentMethod $phuongThucThanhToan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentMethodRequest $request, PaymentMethod $phuongThucThanhToan)
    {
        $phuongThucThanhToan->update([
            'name' => $request->name,
        ]);

        return Redirect::route('phuongThucThanhToan.index')->with('success', 'Cập nhật phương thức thanh toán thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentMethod $phuongThucThanhToan)
    {
        if ($phuongThucThanhToan->Bill()->exists()) {
            return Redirect::route('phuongThucThanhToan.index')
                ->with('error', 'Không thể xóa phương thức này vì đã phát sinh hóa đơn.');
        }

        $phuongThucThanhToan->delete();

        return Redirect::route('phuongThucThanhToan.index')->with('success', 'Xóa phương thức thanh toán thành công!');
    }
}
