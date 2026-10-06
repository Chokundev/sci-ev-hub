@extends('layouts.admin')

@section('title', 'จัดการจองคิวทดลองขับ')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-10">
    
    <!-- ส่วนหัวของหน้า -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">คิวทดลองขับทั้งหมด</h2>
            <p class="text-sm text-gray-500 mt-1">ตรวจสอบ ยืนยันเวลานัดหมาย และจัดการคิวทดลองขับของลูกค้า</p>
        </div>
    </div>

    <!-- ตารางแสดงคิวทดลองขับ -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[1000px]">
            <thead>
                <tr class="text-[11px] font-bold tracking-widest text-gray-400 uppercase border-b-2 border-gray-100">
                    <th class="p-4 pl-0">ข้อมูลลูกค้า</th>
                    <th class="p-4">รุ่นรถยนต์</th>
                    <th class="p-4">วันและเวลานัดหมาย</th>
                    <th class="p-4">สถานะ</th>
                    <th class="p-4 text-right pr-0">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($testDrives as $booking)
                @php
                    // จัดการรูปโปรไฟล์ลูกค้า
                    $avatarUrl = $booking->user->avatar ? asset('storage/' . $booking->user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($booking->user->name).'&color=FFFFFF&background=111827';
                    
                    // จัดการรูปรถยนต์
                    $carImg = $booking->product->image_url ?? '';
                    if ($carImg && !str_starts_with($carImg, 'http')) {
                        $carImg = asset('storage/' . $carImg);
                    } elseif (!$carImg) {
                        $carImg = 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80';
                    }
                @endphp
                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                    
                    <!-- ข้อมูลลูกค้าพร้อม Avatar -->
                    <td class="p-4 pl-0">
                        <div class="flex items-center gap-3">
                            <img src="{{ $avatarUrl }}" alt="{{ $booking->user->name }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                            <div>
                                <p class="font-bold text-gray-900 leading-tight">{{ $booking->user->name }}</p>
                                <p class="text-[11px] text-gray-500">{{ $booking->user->email }}</p>
                            </div>
                        </div>
                    </td>

                    <!-- ข้อมูลรถพร้อมรูป -->
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $carImg }}" alt="{{ $booking->product->name }}" class="w-14 h-10 rounded-lg object-cover border border-gray-100">
                            <p class="font-bold text-gray-900">{{ $booking->product->name }}</p>
                        </div>
                    </td>

                    <!-- วันและเวลา -->
                    <td class="p-4">
                        <span class="block text-gray-900 font-bold">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                        <span class="text-sm text-gray-500 font-medium">เวลา: {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} น.</span>
                    </td>
                    
                    <!-- ป้ายสถานะ -->
                    <td class="p-4">
                        <span class="px-3 py-1.5 text-[10px] font-bold tracking-widest uppercase rounded-full border 
                            {{ $booking->status == 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : '' }}
                            {{ $booking->status == 'confirmed' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                            {{ $booking->status == 'completed' ? 'bg-green-50 text-green-700 border-green-200' : '' }}
                            {{ $booking->status == 'cancelled' ? 'bg-red-50 text-red-700 border-red-200' : '' }}">
                            {{ $booking->status }}
                        </span>
                    </td>
                    
                    <td class="p-4 pr-0 text-right">
                        <!-- ปุ่มเปิด Modal จัดการ -->
                        <button onclick="openTestDriveModal('{{ $booking->id }}')" class="inline-flex items-center gap-2 px-5 py-2 bg-white border-2 border-gray-200 text-gray-900 rounded-full text-sm font-bold hover:border-black transition-all">
                            จัดการ
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-16 text-center">
                        <p class="text-gray-400 font-medium">ยังไม่มีรายการจองคิวทดลองขับ</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ========================================== -->
<!-- Modals สำหรับจัดการคิวทดลองขับ -->
<!-- ========================================== -->
@foreach ($testDrives as $booking)
@php
    $avatarUrl = $booking->user->avatar ? asset('storage/' . $booking->user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($booking->user->name).'&color=FFFFFF&background=111827';
    $carImg = $booking->product->image_url ?? '';
    if ($carImg && !str_starts_with($carImg, 'http')) {
        $carImg = asset('storage/' . $carImg);
    } elseif (!$carImg) {
        $carImg = 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
    }
@endphp

<div id="testDriveModal-{{ $booking->id }}" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeTestDriveModal('{{ $booking->id }}')"></div>
    
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-hidden flex flex-col transform transition-all">
        
        <!-- Header -->
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-1">Test Drive Booking</p>
                <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">รายละเอียดการจองคิว</h3>
            </div>
            <button onclick="closeTestDriveModal('{{ $booking->id }}')" class="text-gray-400 hover:text-black transition-colors p-2">
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
                    <h4 class="text-xl font-bold text-gray-900">{{ $booking->product->name }}</h4>
                    <p class="text-sm text-gray-500 mt-1">{{ $booking->product->energy_type ?? 'Electric Vehicle' }}</p>
                    
                    <div class="mt-4 pt-4 border-t border-gray-200 flex gap-6">
                        <div>
                            <p class="text-xs text-gray-500 font-medium mb-1">วันที่นัดหมาย</p>
                            <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium mb-1">เวลา</p>
                            <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }} น.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ข้อมูลลูกค้า & หมายเหตุ -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-3">Customer Info</p>
                    <div class="flex items-center gap-4">
                        <img src="{{ $avatarUrl }}" class="w-12 h-12 rounded-full object-cover border border-gray-200">
                        <div>
                            <p class="font-bold text-gray-900">{{ $booking->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $booking->user->email }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-3">Additional Notes</p>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 min-h-[3rem]">
                        <p class="text-sm text-gray-700 italic">{{ $booking->notes ?? 'ไม่มีหมายเหตุเพิ่มเติม' }}</p>
                    </div>
                </div>
            </div>

            <!-- ฟอร์มอัปเดตสถานะ (แบบการ์ดตัวเลือก SVG) -->
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-3">Update Status</p>
                <form id="statusForm-{{ $booking->id }}" action="{{ route('admin.test-drives.updateStatus', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- ตัวเลือก: รอดำเนินการ -->
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="pending" class="peer hidden" {{ $booking->status == 'pending' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-100 rounded-2xl p-4 transition-all hover:border-yellow-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-50/50">
                                <div class="flex items-center gap-3 mb-1">
                                    <!-- ไอคอนนาฬิกา -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-yellow-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-wide">Pending</span>
                                </div>
                                <span class="block text-xs text-gray-500 ml-9">รอดำเนินการยืนยันคิว</span>
                            </div>
                        </label>

                        <!-- ตัวเลือก: ยืนยันคิวแล้ว (แทน Processing) -->
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="confirmed" class="peer hidden" {{ $booking->status == 'confirmed' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-100 rounded-2xl p-4 transition-all hover:border-blue-200 peer-checked:border-blue-500 peer-checked:bg-blue-50/50">
                                <div class="flex items-center gap-3 mb-1">
                                    <!-- ไอคอนปฏิทินติ๊กถูก -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5M11.625 14.625l1.5 1.5 3.75-3.75" />
                                    </svg>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-wide">Confirmed</span>
                                </div>
                                <span class="block text-xs text-gray-500 ml-9">อนุมัติคิวทดลองขับแล้ว</span>
                            </div>
                        </label>

                        <!-- ตัวเลือก: ทดสอบเสร็จสิ้น -->
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="completed" class="peer hidden" {{ $booking->status == 'completed' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-100 rounded-2xl p-4 transition-all hover:border-green-200 peer-checked:border-green-500 peer-checked:bg-green-50/50">
                                <div class="flex items-center gap-3 mb-1">
                                    <!-- ไอคอนเครื่องหมายถูกวงกลม -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-wide">Completed</span>
                                </div>
                                <span class="block text-xs text-gray-500 ml-9">ลูกค้าเข้าทดลองขับเรียบร้อย</span>
                            </div>
                        </label>

                        <!-- ตัวเลือก: ยกเลิก -->
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="cancelled" class="peer hidden" {{ $booking->status == 'cancelled' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-100 rounded-2xl p-4 transition-all hover:border-red-200 peer-checked:border-red-500 peer-checked:bg-red-50/50">
                                <div class="flex items-center gap-3 mb-1">
                                    <!-- ไอคอนกากบาทวงกลม -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-wide">Cancelled</span>
                                </div>
                                <span class="block text-xs text-gray-500 ml-9">ยกเลิกคิวทดลองขับ</span>
                            </div>
                        </label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex justify-end items-center gap-3">
            <button type="button" onclick="closeTestDriveModal('{{ $booking->id }}')" class="w-full sm:w-auto px-6 py-3 border-2 border-gray-200 text-gray-700 font-bold rounded-full hover:border-gray-400 transition-colors">
                ปิดหน้าต่าง
            </button>
            <button type="button" onclick="document.getElementById('statusForm-{{ $booking->id }}').submit();" class="w-full sm:w-auto px-8 py-3 bg-black text-white font-bold rounded-full hover:bg-gray-800 shadow-lg hover:shadow-xl transition-all">
                บันทึกสถานะ
            </button>
        </div>

    </div>
</div>
@endforeach

<!-- Script สำหรับควบคุม Modal -->
<script>
    function openTestDriveModal(id) {
        const modal = document.getElementById('testDriveModal-' + id);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeTestDriveModal(id) {
        const modal = document.getElementById('testDriveModal-' + id);
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