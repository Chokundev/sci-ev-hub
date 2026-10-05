<!-- บอกให้ไฟล์นี้ใช้ Layout จาก resources/views/layouts/admin.blade.php -->
@extends('layouts.admin')

<!-- กำหนดชื่อหัวข้อ (Title) -->
@section('title', 'แดชบอร์ดภาพรวม')

<!-- ส่วนของเนื้อหา -->
@section('content')

    <!-- การ์ดสรุปสถิติ (Grid Layout) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition flex items-center gap-4">
            <div class="p-4 bg-cyan-100 text-cyan-600 rounded-xl text-2xl">🚘</div>
            <div>
                <p class="text-sm text-gray-500 font-medium">สินค้าทั้งหมด</p>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition flex items-center gap-4">
            <div class="p-4 bg-green-100 text-green-600 rounded-xl text-2xl">🛒</div>
            <div>
                <p class="text-sm text-gray-500 font-medium">คำสั่งซื้อใหม่</p>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition flex items-center gap-4">
            <div class="p-4 bg-purple-100 text-purple-600 rounded-xl text-2xl">👥</div>
            <div>
                <p class="text-sm text-gray-500 font-medium">ผู้ใช้งานระบบ</p>
                <h3 class="text-3xl font-bold text-gray-800">0</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition flex items-center gap-4">
            <div class="p-4 bg-orange-100 text-orange-600 rounded-xl text-2xl">💰</div>
            <div>
                <p class="text-sm text-gray-500 font-medium">ยอดขายรวม</p>
                <h3 class="text-3xl font-bold text-gray-800">฿0</h3>
            </div>
        </div>

    </div>

    <!-- ส่วนข้อความต้อนรับและอัปเดต -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 relative overflow-hidden">
        <!-- ตกแต่งพื้นหลังเล็กน้อย -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 transform translate-x-1/2 -translate-y-1/2"></div>
        
        <div class="relative z-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">ยินดีต้อนรับกลับมา, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-gray-600 leading-relaxed max-w-2xl">
                ระบบจัดการหลังบ้าน SCI EV Hub พร้อมใช้งานแล้ว คุณสามารถจัดการข้อมูลรถยนต์ไฟฟ้า ตรวจสอบรายการสั่งซื้อ และจัดการสิทธิ์ผู้ใช้งานได้จากเมนูด้านซ้ายมือ สถานะระบบปัจจุบันทำงานได้อย่างสมบูรณ์
            </p>
            <div class="mt-6 flex gap-4">
                <button class="bg-primary text-white px-6 py-2 rounded-lg text-sm font-semibold hover:bg-gray-800 transition shadow-md">
                    + เพิ่มสินค้าใหม่
                </button>
            </div>
        </div>
    </div>

@endsection