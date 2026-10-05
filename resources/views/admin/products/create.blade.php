@extends('layouts.admin')

@section('title', 'เพิ่มสินค้ารถยนต์ใหม่')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 max-w-4xl">
    
    <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-6">
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

        <!-- โค้ดฝัง 3D Model & รายละเอียด -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">โค้ดฝัง 3D Model (Iframe จาก Sketchfab)</label>
            <textarea name="embed_code" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 outline-none transition font-mono text-sm" placeholder='<div class="sketchfab-embed-wrapper">...</iframe></div>'></textarea>
            <p class="text-xs text-gray-400 mt-2">* วางโค้ดที่คัดลอกมาจากเว็บไซต์ Sketchfab</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">รายละเอียดเพิ่มเติม</label>
            <textarea name="description" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 outline-none transition" placeholder="อธิบายจุดเด่นอื่นๆ..."></textarea>
        </div>

        <!-- ปุ่มดำเนินการ -->
        <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 text-gray-600 font-medium hover:bg-gray-100 rounded-xl transition">ยกเลิก</a>
            <button type="submit" class="px-8 py-3 bg-primary text-white font-semibold rounded-xl shadow-md hover:bg-gray-800 transition">
                บันทึกข้อมูลสินค้า
            </button>
        </div>

    </form>
</div>
@endsection