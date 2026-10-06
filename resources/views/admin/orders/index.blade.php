@extends('layouts.admin')

@section('title', 'จัดการรายการสั่งซื้อ')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-gray-800">รายการสั่งซื้อทั้งหมด</h2>
            <p class="text-sm text-gray-500">จัดการและอัปเดตสถานะการสั่งซื้อของลูกค้า</p>
        </div>
    </div>

    <!-- ตารางแสดงคำสั่งซื้อ -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-100">
                    <th class="p-4 font-medium rounded-tl-xl">เลขที่ Order</th>
                    <th class="p-4 font-medium">ลูกค้า</th>
                    <th class="p-4 font-medium">สินค้ารถยนต์</th>
                    <th class="p-4 font-medium">ราคารวม (บาท)</th>
                    <th class="p-4 font-medium">วันที่สั่ง</th>
                    <th class="p-4 font-medium rounded-tr-xl">อัปเดตสถานะ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 font-semibold text-gray-900">{{ $order->order_number }}</td>
                    <td class="p-4 text-gray-800">
                        {{ $order->user->name }}<br>
                        <span class="text-xs text-gray-500">{{ $order->user->email }}</span>
                    </td>
                    <td class="p-4 text-gray-800">{{ $order->product->name }}</td>
                    <td class="p-4 text-gray-600">฿ {{ number_format($order->total_price, 0) }}</td>
                    <td class="p-4 text-gray-500 text-sm">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-4">
                        <!-- ฟอร์มอัปเดตสถานะ -->
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex gap-2 items-center">
                            @csrf
                            @method('PUT')
                            <select name="status" class="px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-sm outline-none focus:border-gray-900 transition">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>รอดำเนินการ</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>กำลังจัดเตรียมรถ</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>ส่งมอบแล้ว</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>ยกเลิก</option>
                            </select>
                            <button type="submit" class="px-3 py-1.5 bg-gray-900 text-white rounded-lg text-xs hover:bg-black transition font-medium shadow-sm">
                                บันทึก
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-400">ยังไม่มีรายการสั่งซื้อในระบบ</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection