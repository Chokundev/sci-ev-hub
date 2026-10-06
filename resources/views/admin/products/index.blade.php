@extends('layouts.admin')

@section('title', 'จัดการสินค้า (รถยนต์ไฟฟ้า)')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-10">
    
    <!-- ส่วนหัวของหน้า -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">แคตตาล็อกรถยนต์</h2>
            <p class="text-sm text-gray-500 mt-1">จัดการข้อมูลรุ่นรถยนต์ไฟฟ้า ราคา และสถานะการจัดจำหน่าย</p>
        </div>
        <!-- เปลี่ยนจาก <a> เป็น <button> เพื่อเปิด Modal สร้างสินค้าใหม่ -->
        <button onclick="openModal('create')" class="bg-black text-white px-8 py-3.5 rounded-full text-sm font-bold hover:bg-gray-800 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
            + เพิ่มรุ่นรถยนต์ใหม่
        </button>
    </div>

    <!-- ตารางแสดงสินค้า -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="text-[11px] font-bold tracking-widest text-gray-400 uppercase border-b-2 border-gray-100">
                    <th class="p-4 pl-0">โมเดลรถยนต์</th>
                    <th class="p-4">ราคาเริ่มต้น</th>
                    <th class="p-4">สถานะ</th>
                    <th class="p-4">อัตราเร่ง (0-100)</th>
                    <th class="p-4 text-right pr-0">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                    <td class="p-4 pl-0 font-bold text-gray-900 text-lg">{{ $product->name }}</td>
                    <td class="p-4 text-gray-600 font-medium">฿ {{ number_format($product->price, 0) }}</td>
                    <td class="p-4">
                        <span class="px-4 py-1.5 bg-gray-100 text-black text-[11px] font-bold tracking-widest uppercase rounded-full border border-gray-200">
                            {{ $product->status_badge ?? 'พร้อมจำหน่าย' }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-600 font-medium">{{ $product->accel_0_100 }}</td>
                    
                    <td class="p-4 pr-0 text-right">
                        <!-- ปุ่มเปิด Modal จัดการข้อมูล -->
                        <button onclick="openModal('{{ $product->id }}')" class="inline-flex items-center gap-2 px-5 py-2 bg-white border-2 border-gray-200 text-gray-900 rounded-full text-sm font-bold hover:border-black transition-all">
                            จัดการ
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-16 text-center">
                        <p class="text-gray-400 font-medium">ยังไม่มีข้อมูลสินค้าในระบบ</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ========================================== -->
<!-- 1. Modal สำหรับ เพิ่มสินค้ารถยนต์ใหม่ -->
<!-- ========================================== -->
<div id="editModal-create" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeModal('create')"></div>
    
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col transform transition-all">
        
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-1">Add New Vehicle</p>
                <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">เพิ่มรุ่นรถยนต์ใหม่</h3>
            </div>
            <button onclick="closeModal('create')" class="text-gray-400 hover:text-black transition-colors p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <div class="px-8 py-6 overflow-y-auto flex-1 custom-scrollbar">
            <!-- ฟอร์มสำหรับสร้างข้อมูลใหม่ (ส่งไปที่ store) -->
            <form id="createForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ชื่อรุ่นรถยนต์</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ราคา (บาท)</label>
                        <input type="number" name="price" required class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ประเภทพลังงาน</label>
                        <input type="text" name="energy_type" placeholder="เช่น Electric, Plug-in Hybrid" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ป้ายสถานะ (Badge)</label>
                        <input type="text" name="status_badge" placeholder="เช่น Available, Pre-order" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">อัตราเร่ง 0-100</label>
                        <input type="text" name="accel_0_100" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ระยะทางสูงสุด (Range)</label>
                        <input type="text" name="max_range" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ความเร็วสูงสุด</label>
                        <input type="text" name="top_speed" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รูปภาพประกอบ (หน้าการ์ด)</label>
                        <input type="file" name="card_image" accept="image/*" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รูปภาพหลัก (หน้ารายละเอียด)</label>
                        <input type="file" name="image" accept="image/*" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl outline-none text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">โค้ดฝัง 3D Model (ถ้ามี)</label>
                    <textarea name="embed_code" rows="2" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none font-mono text-sm text-gray-600"></textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รายละเอียดเพิ่มเติม</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none font-medium"></textarea>
                </div>
            </form>
        </div>

        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex justify-end items-center gap-3">
            <button type="button" onclick="closeModal('create')" class="w-full sm:w-auto px-6 py-3 border-2 border-gray-200 text-gray-700 font-bold rounded-full hover:border-gray-400 transition-colors">
                ยกเลิก
            </button>
            <button type="button" onclick="document.getElementById('createForm').submit();" class="w-full sm:w-auto px-8 py-3 bg-black text-white font-bold rounded-full hover:bg-gray-800 shadow-lg hover:shadow-xl transition-all">
                บันทึกข้อมูลรถยนต์
            </button>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- 2. Modals สำหรับ แก้ไข/ลบ ข้อมูล -->
<!-- ========================================== -->
@foreach ($products as $product)
<div id="editModal-{{ $product->id }}" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeModal('{{ $product->id }}')"></div>
    
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col transform transition-all">
        
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-1">Edit Vehicle</p>
                <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ $product->name }}</h3>
            </div>
            <button onclick="closeModal('{{ $product->id }}')" class="text-gray-400 hover:text-black transition-colors p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <div class="px-8 py-6 overflow-y-auto flex-1 custom-scrollbar">
            <!-- ฟอร์มสำหรับแก้ไขข้อมูล -->
            <form id="updateForm-{{ $product->id }}" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ชื่อรุ่นรถยนต์</label>
                        <input type="text" name="name" value="{{ $product->name }}" required class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ราคา (บาท)</label>
                        <input type="number" name="price" value="{{ $product->price }}" required class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ประเภทพลังงาน</label>
                        <input type="text" name="energy_type" value="{{ $product->energy_type }}" placeholder="เช่น Electric, Plug-in Hybrid" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ป้ายสถานะ (Badge)</label>
                        <input type="text" name="status_badge" value="{{ $product->status_badge }}" placeholder="เช่น Available, Pre-order" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">อัตราเร่ง 0-100</label>
                        <input type="text" name="accel_0_100" value="{{ $product->accel_0_100 }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ระยะทางสูงสุด (Range)</label>
                        <input type="text" name="max_range" value="{{ $product->max_range }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ความเร็วสูงสุด</label>
                        <input type="text" name="top_speed" value="{{ $product->top_speed }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รูปภาพประกอบ (หน้าการ์ด)</label>
                        <input type="file" name="card_image" accept="image/*" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl outline-none text-sm">
                        <p class="text-xs text-gray-400 mt-2">* อัปโหลดใหม่เฉพาะเมื่อต้องการเปลี่ยนรูป</p>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รูปภาพหลัก (หน้ารายละเอียด)</label>
                        <input type="file" name="image" accept="image/*" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl outline-none text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">โค้ดฝัง 3D Model (ถ้ามี)</label>
                    <textarea name="embed_code" rows="2" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none font-mono text-sm text-gray-600">{{ $product->embed_code }}</textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รายละเอียดเพิ่มเติม</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none font-medium">{{ $product->description }}</textarea>
                </div>
            </form>
        </div>

        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
            <!-- ฟอร์มลบข้อมูล -->
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบรถยนต์รุ่น {{ $product->name }}? ข้อมูลทั้งหมดจะสูญหาย');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold tracking-wide uppercase transition-colors px-2 py-1">
                    ลบข้อมูลรถยนต์
                </button>
            </form>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <button type="button" onclick="closeModal('{{ $product->id }}')" class="w-full sm:w-auto px-6 py-3 border-2 border-gray-200 text-gray-700 font-bold rounded-full hover:border-gray-400 transition-colors">
                    ยกเลิก
                </button>
                <button type="button" onclick="document.getElementById('updateForm-{{ $product->id }}').submit();" class="w-full sm:w-auto px-8 py-3 bg-black text-white font-bold rounded-full hover:bg-gray-800 shadow-lg hover:shadow-xl transition-all">
                    บันทึกการเปลี่ยนแปลง
                </button>
            </div>
        </div>

    </div>
</div>
@endforeach

<!-- Script สำหรับควบคุม Modal -->
<script>
    function openModal(id) {
        const modal = document.getElementById('editModal-' + id);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(id) {
        const modal = document.getElementById('editModal-' + id);
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