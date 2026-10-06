@extends('layouts.admin')

@section('title', 'จัดการสินค้า (รถยนต์ไฟฟ้า)')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800">รายการรถยนต์ทั้งหมด</h2>
        <a href="{{ route('admin.products.create') }}" class="bg-primary text-white px-6 py-2 rounded-lg text-sm font-semibold hover:bg-gray-800 transition shadow-md">
            + เพิ่มสินค้ารถยนต์
        </a>
    </div>

    <!-- ตารางแสดงสินค้า -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-100">
                    <th class="p-4 font-medium rounded-tl-xl">ชื่อรุ่น</th>
                    <th class="p-4 font-medium">ราคา</th>
                    <th class="p-4 font-medium">สถานะ</th>
                    <th class="p-4 font-medium">อัตราเร่ง</th>
                    <th class="p-4 font-medium rounded-tr-xl">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 font-semibold text-gray-800">{{ $product->name }}</td>
                    <td class="p-4 text-gray-600">฿{{ number_format($product->price, 0) }}</td>
                    <td class="p-4">
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">{{ $product->status_badge ?? 'พร้อมจำหน่าย' }}</span>
                    </td>
                    <td class="p-4 text-gray-600">{{ $product->accel_0_100 }}</td>
                    
                    <!-- ส่วนปุ่มจัดการที่อัปเดตแล้ว -->
                    <td class="p-4 flex gap-4 items-center">
                        
                        <!-- ลิงก์ไปหน้าแก้ไขข้อมูล -->
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium transition">
                            แก้ไข
                        </a>
                        
                        <!-- ฟอร์มสำหรับลบข้อมูล -->
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบรถยนต์รุ่น {{ $product->name }}? การกระทำนี้ไม่สามารถย้อนกลับได้');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium transition">
                                ลบ
                            </button>
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-400">ยังไม่มีข้อมูลสินค้าในระบบ</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection