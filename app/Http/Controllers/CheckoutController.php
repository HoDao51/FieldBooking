<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function vnpay_payment(Request $request)
{
    $code_cart = rand(00, 9999);
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://127.0.0.1:8000/customer/success";
    $vnp_TmnCode = "5HU1HQC5";
    $vnp_HashSecret = "G1G3HSJWHEFV3A8VP2CA7LXXD66X4LKO";

    $vnp_TxnRef = $code_cart;
    $vnp_OrderInfo = 'Thanh toán đơn hàng test';
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = $request->total_vnpay * 100;
    $vnp_Locale = 'vn';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    $inputData = [
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    ];

    ksort($inputData);
    $query = "";
    $hashdata = "";

    foreach ($inputData as $key => $value) {
        $hashdata .= urlencode($key) . "=" . urlencode($value) . '&';
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $hashdata = rtrim($hashdata, '&');

    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= "?" . $query . 'vnp_SecureHash=' . $vnpSecureHash;

    return redirect($vnp_Url);
}
}
