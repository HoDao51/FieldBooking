@extends('admins.layouts.app')
@section('content')
<div class="flex h-screen">
    <!-- Main -->
    <div class="flex-1 flex flex-col">
        <!-- Content -->
        <main class="p-6 overflow-auto">

            <!-- Thống kê nhanh -->
            <div class="grid grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-5 rounded shadow">
                    <p class="text-gray-500">Tổng khách hàng</p>
                    <h2 class="text-2xl font-bold">120</h2>
                </div>
                <div class="bg-white p-5 rounded shadow">
                    <p class="text-gray-500">Tổng sân</p>
                    <h2 class="text-2xl font-bold">15</h2>
                </div>
                <div class="bg-white p-5 rounded shadow">
                    <p class="text-gray-500">Đơn đặt hôm nay</p>
                    <h2 class="text-2xl font-bold">8</h2>
                </div>
                <div class="bg-white p-5 rounded shadow">
                    <p class="text-gray-500">Doanh thu hôm nay</p>
                    <h2 class="text-2xl font-bold text-green-600">3.500.000đ</h2>
                </div>
            </div>

            <!-- Bảng quản lý đặt sân -->
            <div class="bg-white rounded shadow">
                <div class="p-4 border-b font-semibold">
                    Danh sách đặt sân
                </div>

                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2">Khách hàng</th>
                            <th class="px-4 py-2">Sân</th>
                            <th class="px-4 py-2">Khung giờ</th>
                            <th class="px-4 py-2">Ngày đặt</th>
                            <th class="px-4 py-2">Tổng tiền</th>
                            <th class="px-4 py-2">Trạng thái</th>
                            <th class="px-4 py-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-4 py-2">Nguyễn Văn A</td>
                            <td class="px-4 py-2">Sân 5 người</td>
                            <td class="px-4 py-2">18:00 - 19:00</td>
                            <td class="px-4 py-2">21/02/2026</td>
                            <td class="px-4 py-2">500.000đ</td>
                            <td class="px-4 py-2 text-yellow-600">Chờ xác nhận</td>
                            <td class="px-4 py-2 space-x-2">
                                <button class="bg-green-600 text-white px-3 py-1 rounded text-sm">Xác nhận</button>
                                <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Từ chối</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>
    </div>

</div>
@endsection
