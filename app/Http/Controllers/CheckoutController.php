<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Field;
use App\Models\PaymentMethod;
use App\Models\TimeSlot;

class CheckoutController extends Controller
{
    public function vnpayPayment(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/customer/vnpayReturn";
        $vnp_TmnCode = "5HU1HQC5";
        $vnp_HashSecret = "G1G3HSJWHEFV3A8VP2CA7LXXD66X4LKO";

        $vnp_TxnRef = time();
        $vnp_Amount = $request->total_vnpay * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $vnp_OrderInfo = 'Thanh toan dat san';

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
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
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

    public function vnpayReturn(Request $request)
    {
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');

        $data = session('booking_data');

        if ($vnp_ResponseCode == '00' && $data) {
            $status = 0;
            if ($data['payment_type'] == 0) {
                $status = 1;
            }

            $booking = Booking::create([
                'bookingDate' => $data['date'],
                'totalPrice' => $data['price'],
                'status' => $status,
                'contactName' => $data['contactName'],
                'contactPhone' => $data['contactPhone'],
                'contactEmail' => $data['contactEmail'],
                'field_id' => $data['field_id'],
                'time_id' => $data['time_id'],
                'customer_id' => $data['user_id'],
            ]);

            $billAmount = $data['price'];
            if ($data['payment_type'] == 1) {
                $billAmount = $data['price'] / 2;
            }

            $payment = PaymentMethod::where('name', 'VNPay')->first();

            $booking->Bills()->create([
                'payment_id' => $payment->id,
                'amount' => $billAmount,
                'status' => 1,
                'payment_type' => $data['payment_type'],
            ]);

            session()->forget('booking_data');

            return redirect()->route('booking.success', $booking->id)
                ->with('success', 'Thanh toán thành công!');
        }

        return redirect()->route('booking.checkout', [
            'field_id' => $data['field_id'],
            'time_id' => $data['time_id'],
            'date' => $data['date'],
            'price' => $data['price'],
        ])->with('error', 'Thanh toán thất bại hoặc đã bị hủy.');
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);

        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $result = curl_exec($ch);

        if ($result === false) {
            dd(curl_error($ch));
        }

        curl_close($ch);

        return $result;
    }

    public function momoPayment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $request->total_momo;
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/customer/momoReturn";
        $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        //Just a example, please check more in there
        return redirect()->to($jsonResult['payUrl']);
    }


    public function momoReturn(Request $request)
    {
        $resultCode = $request->input('resultCode');
        $data = session('booking_data');

        if ($resultCode == 0 && $data) {
            $status = 0;
            if ($data['payment_type'] == 0) {
                $status = 1;
            }

            $booking = Booking::create([
                'bookingDate' => $data['date'],
                'totalPrice' => $data['price'],
                'status' => $status,
                'contactName' => $data['contactName'],
                'contactPhone' => $data['contactPhone'],
                'contactEmail' => $data['contactEmail'],
                'field_id' => $data['field_id'],
                'time_id' => $data['time_id'],
                'customer_id' => $data['user_id'],
            ]);

            $billAmount = $data['price'];
            if ($data['payment_type'] == 1) {
                $billAmount = $data['price'] / 2;
            }

            $payment = PaymentMethod::where('name', 'Ví điện tử MoMo')->first();

            $booking->Bills()->create([
                'payment_id' => $payment->id,
                'amount' => $billAmount,
                'status' => 1,
                'payment_type' => $data['payment_type'],
            ]);

            session()->forget('booking_data');

            return redirect()->route('booking.success', $booking->id)
                ->with('success', 'Thanh toán MoMo thành công!');
        }

        if ($data) {
            return redirect()->route('booking.checkout', [
                'field_id' => $data['field_id'],
                'time_id' => $data['time_id'],
                'date' => $data['date'],
                'price' => $data['price'],
            ])->with('error', 'Thanh toán MoMo thất bại hoặc đã hủy.');
        }

        return redirect()->route('home')
            ->with('error', 'Dữ liệu không hợp lệ.');
    }
}
