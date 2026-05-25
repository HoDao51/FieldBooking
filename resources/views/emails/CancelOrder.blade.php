<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông báo hủy đơn đặt sân</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding:20px;">
    <div style="max-width:600px; margin:auto; background:#fff; padding:20px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
        <h2 style="color:#d32f2f;">Thông báo hủy đơn đặt sân</h2>
        <p>Kính gửi quý khách <strong>{{ $booking->Customer->name }}</strong>,</p>

        <p>Rất tiếc, đơn đặt sân của quý khách đã bị hủy
            với lý do: <strong style="color:#d32f2f;">{{ $booking->refund->reason }}</strong>.
        </p>

        <p>Nếu có sai sót hoặc cần hỗ trợ thêm, vui lòng liên hệ với quản trị viên để được giải quyết.</p>

        <p style="margin-top:20px;">Trân trọng,<br>
    </div>
</body>
</html>
