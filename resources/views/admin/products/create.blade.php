@extends('layouts.admin')

@section('title', 'เพิ่มสินค้ารถยนต์ใหม่')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 max-w-4xl">
    
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- ข้อมูลหลัก -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ชื่อรุ่นรถยนต์</label>
                <input type="text" name="name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 outline-none transition" placeholder="เช่น Tesla Model 3">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ราคา (บาท)</label>
                <input type="number" name="price" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 outline-none transition" placeholder="เช่น 1599000">
            </div>
        </div>

        <!-- ข้อมูลเพิ่มเติมสำหรับการ์ดแสดงผล (ส่วนที่เพิ่มใหม่) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ป้ายสถานะ (Status Badge)</label>
                <input type="text" name="status_badge" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 outline-none transition" placeholder="เช่น Available, Pre-Order">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ประเภทพลังงาน (Energy Type)</label>
                <input type="text" name="energy_type" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 outline-none transition" placeholder="เช่น Electric, Hybrid">
            </div>
        </div>

        <!-- รูปภาพสำหรับแสดงบนการ์ดหน้าแรก -->
<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">รูปภาพหน้าการ์ด (สำหรับโชว์หน้าแรก)</label>
    <input type="file" name="card_image" accept="image/*" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-900 file:text-white hover:file:bg-black">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">รูปรถคันใหญ่ (สำหรับโชว์ในหน้ารายละเอียด)</label>
    <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-900 file:text-white hover:file:bg-black">
</div>

        <!-- สเปคเด่น -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-gray-50 rounded-2xl border border-gray-100">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">อัตราเร่ง 0-100</label>
                <input type="text" name="accel_0_100" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none" placeholder="เช่น 4.4 วินาที">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ระยะทางสูงสุด (Range)</label>
                <input type="text" name="max_range" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none" placeholder="เช่น 629 กม.">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ความเร็วสูงสุด</label>
                <input type="text" name="top_speed" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none" placeholder="เช่น 201 กม./ชม.">
            </div>
        </div>

        <!-- คำอธิบายสั้น (ส่วนที่เพิ่มใหม่) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">คำอธิบายสั้น (โชว์บนการ์ดหน้าแรก)</label>
            <input type="text" name="short_description" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 outline-none transition" placeholder="เช่น รถยนต์ซีดานไฟฟ้า 100% สไตล์มินิมอล">
        </div>

        <!-- โค้ดฝัง 3D Model & รายละเอียด -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">โค้ดฝัง 3D Model (Iframe จาก Sketchfab)</label>
            <textarea name="embed_code" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 outline-none transition font-mono text-sm" placeholder='<div class="sketchfab-embed-wrapper">...</iframe></div>'></textarea>
            <p class="text-xs text-gray-400 mt-2">* วางโค้ดที่คัดลอกมาจากเว็บไซต์ Sketchfab</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">รายละเอียดเพิ่มเติม (โชว์ในหน้ารายละเอียด)</label>
            <textarea name="description" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 outline-none transition" placeholder="อธิบายจุดเด่นอื่นๆ..."></textarea>
        </div>

        <!-- ปุ่มดำเนินการ -->
        <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 text-gray-600 font-medium hover:bg-gray-100 rounded-xl transition">ยกเลิก</a>
            <button type="submit" class="px-8 py-3 bg-primary text-white font-semibold rounded-xl shadow-md hover:bg-gray-800 transition" style="background-color: #1a1a1a;">
                บันทึกข้อมูลสินค้า
            </button>
        </div>

    </form>
</div>
@endsection