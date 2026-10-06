@extends('layouts.admin')

@section('title', 'จัดการรายการสั่งซื้อ')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-10">
    
    <!-- ส่วนหัวของหน้า -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">รายการสั่งซื้อทั้งหมด</h2>
            <p class="text-sm text-gray-500 mt-1">จัดการคำสั่งซื้อ ตรวจสอบรายละเอียด และอัปเดตสถานะการส่งมอบ</p>
        </div>
    </div>

    <!-- ตารางแสดงคำสั่งซื้อ -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[1000px]">
            <thead>
                <tr class="text-[11px] font-bold tracking-widest text-gray-400 uppercase border-b-2 border-gray-100">
                    <th class="p-4 pl-0">เลขที่ออเดอร์</th>
                    <th class="p-4">ข้อมูลลูกค้า</th>
                    <th class="p-4">สินค้ารถยนต์</th>
                    <th class="p-4">ราคารวม</th>
                    <th class="p-4">สถานะ</th>
                    <th class="p-4 text-right pr-0">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                @php
                    // จัดการรูปโปรไฟล์ลูกค้า
                    $avatarUrl = $order->user->avatar ? asset('storage/' . $order->user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($order->user->name).'&color=FFFFFF&background=111827';
                    
                    // จัดการรูปรถยนต์
                    $carImg = $order->product->image_url ?? '';
                    if ($carImg && !str_starts_with($carImg, 'http')) {
                        $carImg = asset('storage/' . $carImg);
                    } elseif (!$carImg) {
                        $carImg = 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80';
                    }
                @endphp
                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                    <td class="p-4 pl-0 font-extrabold text-gray-900 text-lg">{{ $order->order_number ?? 'ORD-'.str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                    
                    <!-- ข้อมูลลูกค้าพร้อม Avatar -->
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $avatarUrl }}" alt="{{ $order->user->name }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                            <div>
                                <p class="font-bold text-gray-900 leading-tight">{{ $order->user->name }}</p>
                                <p class="text-[11px] text-gray-500">{{ $order->user->email }}</p>
                            </div>
                        </div>
                    </td>

                    <!-- ข้อมูลรถพร้อมรูป -->
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $carImg }}" alt="{{ $order->product->name }}" class="w-14 h-10 rounded-lg object-cover border border-gray-100">
                            <p class="font-bold text-gray-900">{{ $order->product->name }}</p>
                        </div>
                    </td>

                    <td class="p-4 text-gray-900 font-bold">฿ {{ number_format($order->total_price, 0) }}</td>
                    
                    <!-- ป้ายสถานะ -->
                    <td class="p-4">
                        <span class="px-3 py-1.5 text-[10px] font-bold tracking-widest uppercase rounded-full border 
                            {{ $order->status == 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                            {{ $order->status == 'processing' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                            {{ $order->status == 'completed' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                            {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    
                    <td class="p-4 pr-0 text-right">
                        <!-- ปุ่มเปิด Modal จัดการ -->
                        <button onclick="openOrderModal('{{ $order->id }}')" class="inline-flex items-center gap-2 px-5 py-2 bg-white border-2 border-gray-200 text-gray-900 rounded-full text-sm font-bold hover:border-black transition-all">
                            จัดการ
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-16 text-center">
                        <p class="text-gray-400 font-medium">ยังไม่มีรายการสั่งซื้อในระบบ</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ========================================== -->
<!-- Modals สำหรับจัดการคำสั่งซื้อ -->
<!-- ========================================== -->
@foreach ($orders as $order)
@php
    $avatarUrl = $order->user->avatar ? asset('storage/' . $order->user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($order->user->name).'&color=FFFFFF&background=111827';
    $carImg = $order->product->image_url ?? '';
    if ($carImg && !str_starts_with($carImg, 'http')) {
        $carImg = asset('storage/' . $carImg);
    } elseif (!$carImg) {
        $carImg = 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
    }
@endphp

<div id="orderModal-{{ $order->id }}" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeOrderModal('{{ $order->id }}')"></div>
    
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-hidden flex flex-col transform transition-all">
        
        <!-- Header -->
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-1">Order Details</p>
                <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ $order->order_number ?? 'ORD-'.str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h3>
            </div>
            <button onclick="closeOrderModal('{{ $order->id }}')" class="text-gray-400 hover:text-black transition-colors p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <!-- Body -->
        <div class="px-8 py-8 overflow-y-auto flex-1 custom-scrollbar space-y-8">
            
            <!-- รูปภาพและข้อมูลรถ -->
            <div class="flex flex-col sm:flex-row gap-6 items-center sm:items-start bg-gray-50 p-6 rounded-2xl border border-gray-100">
                <img src="{{ $carImg }}" class="w-40 h-28 object-cover rounded-xl shadow-sm border border-gray-200">
                <div class="flex-1 w-full">
                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-1">Vehicle Model</p>
                    <h4 class="text-xl font-bold text-gray-900">{{ $order->product->name }}</h4>
                    <p class="text-sm text-gray-500 mt-1">{{ $order->product->energy_type ?? 'Electric Vehicle' }}</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-500 font-medium">ราคาสุทธิ: <span class="text-lg font-bold text-black ml-2">฿ {{ number_format($order->total_price, 0) }}</span></p>
                    </div>
                </div>
            </div>

            <!-- ข้อมูลลูกค้า & วันที่ -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-3">Customer Info</p>
                    <div class="flex items-center gap-4">
                        <img src="{{ $avatarUrl }}" class="w-12 h-12 rounded-full object-cover border border-gray-200">
                        <div>
                            <p class="font-bold text-gray-900">{{ $order->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-3">Order Timeline</p>
                    <p class="text-sm text-gray-900 font-medium">วันที่สั่งซื้อ: <span class="text-gray-500 font-normal ml-2">{{ $order->created_at->format('d M Y, H:i') }}</span></p>
                    <p class="text-sm text-gray-900 font-medium mt-2">อัปเดตล่าสุด: <span class="text-gray-500 font-normal ml-2">{{ $order->updated_at->format('d M Y, H:i') }}</span></p>
                </div>
            </div>

            <!-- ฟอร์มอัปเดตสถานะ (แบบการ์ดตัวเลือก SVG) -->
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-3">Update Status</p>
                <form id="statusForm-{{ $order->id }}" action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- ตัวเลือก: รอดำเนินการ -->
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="pending" class="peer hidden" {{ $order->status == 'pending' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-100 rounded-2xl p-4 transition-all hover:border-yellow-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-50/50">
                                <div class="flex items-center gap-3 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-yellow-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-wide">Pending</span>
                                </div>
                                <span class="block text-xs text-gray-500 ml-9">รอดำเนินการ / ชำระเงิน</span>
                            </div>
                        </label>

                        <!-- ตัวเลือก: กำลังจัดเตรียมรถ -->
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="processing" class="peer hidden" {{ $order->status == 'processing' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-100 rounded-2xl p-4 transition-all hover:border-blue-200 peer-checked:border-blue-500 peer-checked:bg-blue-50/50">
                                <div class="flex items-center gap-3 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-wide">Processing</span>
                                </div>
                                <span class="block text-xs text-gray-500 ml-9">กำลังจัดเตรียมรถและเอกสาร</span>
                            </div>
                        </label>

                        <!-- ตัวเลือก: ส่งมอบแล้ว -->
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="completed" class="peer hidden" {{ $order->status == 'completed' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-100 rounded-2xl p-4 transition-all hover:border-green-200 peer-checked:border-green-500 peer-checked:bg-green-50/50">
                                <div class="flex items-center gap-3 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-wide">Completed</span>
                                </div>
                                <span class="block text-xs text-gray-500 ml-9">ส่งมอบรถยนต์เรียบร้อยแล้ว</span>
                            </div>
                        </label>

                        <!-- ตัวเลือก: ยกเลิก -->
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="cancelled" class="peer hidden" {{ $order->status == 'cancelled' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-100 rounded-2xl p-4 transition-all hover:border-red-200 peer-checked:border-red-500 peer-checked:bg-red-50/50">
                                <div class="flex items-center gap-3 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-wide">Cancelled</span>
                                </div>
                                <span class="block text-xs text-gray-500 ml-9">ยกเลิกคำสั่งซื้อนี้</span>
                            </div>
                        </label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex justify-end items-center gap-3">
            <button type="button" onclick="closeOrderModal('{{ $order->id }}')" class="w-full sm:w-auto px-6 py-3 border-2 border-gray-200 text-gray-700 font-bold rounded-full hover:border-gray-400 transition-colors">
                ปิดหน้าต่าง
            </button>
            <button type="button" onclick="document.getElementById('statusForm-{{ $order->id }}').submit();" class="w-full sm:w-auto px-8 py-3 bg-black text-white font-bold rounded-full hover:bg-gray-800 shadow-lg hover:shadow-xl transition-all">
                บันทึกการเปลี่ยนแปลง
            </button>
        </div>

    </div>
</div>
@endforeach

<!-- Script สำหรับควบคุม Modal -->
<script>
    function openOrderModal(id) {
        const modal = document.getElementById('orderModal-' + id);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeOrderModal(id) {
        const modal = document.getElementById('orderModal-' + id);
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 20px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #d1d5db; }
</style>
@endsection