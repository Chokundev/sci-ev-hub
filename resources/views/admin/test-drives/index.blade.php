@extends('layouts.admin')
@section('title', 'จัดการจองคิวทดลองขับ')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800">คิวทดลองขับทั้งหมด</h2>
        <p class="text-sm text-gray-500">ตรวจสอบและยืนยันนัดหมายการทดลองขับของลูกค้า</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-100">
                    <th class="p-4 font-medium rounded-tl-xl">ลูกค้า / ติดต่อ</th>
                    <th class="p-4 font-medium">รุ่นรถยนต์</th>
                    <th class="p-4 font-medium">วันและเวลานัดหมาย</th>
                    <th class="p-4 font-medium">หมายเหตุ</th>
                    <th class="p-4 font-medium rounded-tr-xl">จัดการสถานะ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($testDrives as $booking)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4">
                        <p class="font-semibold text-gray-800">{{ $booking->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $booking->user->email }}</p>
                    </td>
                    <td class="p-4 font-medium text-primary">{{ $booking->product->name }}</td>
                    <td class="p-4">
                        <span class="block text-gray-800 font-semibold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</span>
                        <span class="text-sm text-gray-500">เวลา: {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} น.</span>
                    </td>
                    <td class="p-4 text-sm text-gray-600 max-w-xs truncate" title="{{ $booking->notes }}">
                        {{ $booking->notes ?? '-' }}
                    </td>
                    <td class="p-4">
                        <form action="{{ route('admin.test-drives.updateStatus', $booking->id) }}" method="POST" class="flex gap-2">
                            @csrf
                            @method('PUT')
                            <select name="status" class="px-3 py-1.5 bg-white border border-gray-200 rounded-lg text-sm outline-none focus:border-cyan-500">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>รอดำเนินการ</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>อนุมัติคิวแล้ว</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>ทดสอบเสร็จสิ้น</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>ยกเลิก</option>
                            </select>
                            <button type="submit" class="px-3 py-1.5 bg-gray-900 text-white rounded-lg text-xs hover:bg-black font-medium">บันทึก</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-8 text-center text-gray-400">ยังไม่มีรายการจองคิวทดลองขับ</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection