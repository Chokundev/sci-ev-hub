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
                    <td class="p-4 pl-0 font-bold text-gray-900 text-lg flex items-center gap-3">
                        @if($product->card_image_url)
                            <img src="{{ asset('storage/' . $product->card_image_url) }}" alt="" class="w-10 h-10 object-cover rounded-lg border border-gray-100 shadow-sm">
                        @endif
                        {{ $product->name }}
                    </td>
                    <td class="p-4 text-gray-600 font-medium">฿ {{ number_format($product->price, 0) }}</td>
                    <td class="p-4">
                        <span class="px-4 py-1.5 bg-gray-100 text-black text-[11px] font-bold tracking-widest uppercase rounded-full border border-gray-200">
                            {{ $product->status_badge ?? 'พร้อมจำหน่าย' }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-600 font-medium">{{ $product->accel_0_100 }}</td>
                    <td class="p-4 pr-0 text-right">
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
            <form id="createForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ชื่อรุ่นรถยนต์</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium" placeholder="เช่น Tesla Model 3">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ราคา (บาท)</label>
                        <input type="number" name="price" required class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium" placeholder="เช่น 1599000">
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
                        <input type="text" name="accel_0_100" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium bg-white" placeholder="เช่น 4.4 วินาที">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ระยะทางสูงสุด (Range)</label>
                        <input type="text" name="max_range" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium bg-white" placeholder="เช่น 629 กม.">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ความเร็วสูงสุด</label>
                        <input type="text" name="top_speed" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium bg-white" placeholder="เช่น 201 กม./ชม.">
                    </div>
                </div>

                <!-- ส่วนอัปโหลดรูปพร้อมพรีวิว UI สวยงาม -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- รูปการ์ด -->
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รูปภาพประกอบ (หน้าการ์ด)</label>
                        <div class="flex items-center gap-4 p-4 bg-gray-50 border border-gray-200 rounded-2xl">
                            <div class="w-16 h-16 bg-white rounded-xl border border-gray-200 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                                <img id="preview-card-create" src="https://placehold.co/100x100?text=No+Image" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <label class="inline-block px-4 py-2 bg-black text-white text-xs font-bold rounded-full cursor-pointer hover:bg-gray-800 transition-all shadow-sm">
                                    เลือกรูปภาพ
                                    <input type="file" name="card_image" accept="image/*" class="hidden" onchange="previewImage(event, 'preview-card-create')">
                                </label>
                                <p class="text-[11px] text-gray-400 mt-1.5">PNG, JPG ไม่เกิน 5MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- รูปรถใหญ่ -->
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รูปภาพหลัก (หน้ารายละเอียด)</label>
                        <div class="flex items-center gap-4 p-4 bg-gray-50 border border-gray-200 rounded-2xl">
                            <div class="w-16 h-16 bg-white rounded-xl border border-gray-200 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                                <img id="preview-main-create" src="https://placehold.co/100x100?text=No+Image" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <label class="inline-block px-4 py-2 bg-black text-white text-xs font-bold rounded-full cursor-pointer hover:bg-gray-800 transition-all shadow-sm">
                                    เลือกรูปภาพ
                                    <input type="file" name="image" accept="image/*" class="hidden" onchange="previewImage(event, 'preview-main-create')">
                                </label>
                                <p class="text-[11px] text-gray-400 mt-1.5">PNG, JPG ไม่เกิน 5MB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">โค้ดฝัง 3D Model (ถ้ามี)</label>
                    <textarea name="embed_code" rows="2" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none font-mono text-sm text-gray-600" placeholder='<div class="sketchfab-embed-wrapper">...</div>'></textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รายละเอียดเพิ่มเติม</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none font-medium" placeholder="อธิบายจุดเด่นของรถยนต์รุ่นนี้..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">คำอธิบายสั้น (โชว์บนการ์ดหน้าแรก)</label>
                    <input type="text" name="short_description" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 outline-none transition" placeholder="เช่น รถยนต์ซีดานไฟฟ้า 100% สไตล์มินิมอล">
                </div>
            </form>
        </div>

        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex justify-end items-center gap-3">
            <button type="button" onclick="closeModal('create')" class="px-6 py-3 border-2 border-gray-200 text-gray-700 font-bold rounded-full hover:border-gray-400 transition-colors">
                ยกเลิก
            </button>
            <button type="button" onclick="document.getElementById('createForm').submit();" class="px-8 py-3 bg-black text-white font-bold rounded-full hover:bg-gray-800 shadow-lg hover:shadow-xl transition-all">
                บันทึกข้อมูลรถยนต์
            </button>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- 2. Modals สำหรับ แก้ไขข้อมูลของแต่ละรถ -->
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
                        <input type="text" name="energy_type" value="{{ $product->energy_type }}" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none font-medium">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ป้ายสถานะ (Badge)</label>
                        <input type="text" name="status_badge" value="{{ $product->status_badge }}" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none font-medium">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">อัตราเร่ง 0-100</label>
                        <input type="text" name="accel_0_100" value="{{ $product->accel_0_100 }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ระยะทางสูงสุด (Range)</label>
                        <input type="text" name="max_range" value="{{ $product->max_range }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ความเร็วสูงสุด</label>
                        <input type="text" name="top_speed" value="{{ $product->top_speed }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none font-medium bg-white">
                    </div>
                </div>

                <!-- ส่วนอัปโหลดรูปพร้อมพรีวิวภาพเก่าและภาพใหม่ -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- รูปการ์ด -->
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รูปภาพประกอบ (หน้าการ์ด)</label>
                        <div class="flex items-center gap-4 p-4 bg-gray-50 border border-gray-200 rounded-2xl">
                            <div class="w-16 h-16 bg-white rounded-xl border border-gray-200 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                                <img id="preview-card-{{ $product->id }}" src="{{ $product->card_image_url ? asset('storage/' . $product->card_image_url) : 'https://placehold.co/100x100?text=No+Image' }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <label class="inline-block px-4 py-2 bg-black text-white text-xs font-bold rounded-full cursor-pointer hover:bg-gray-800 transition-all shadow-sm">
                                    เปลี่ยนรูปภาพ
                                    <input type="file" name="card_image" accept="image/*" class="hidden" onchange="previewImage(event, 'preview-card-{{ $product->id }}')">
                                </label>
                                <p class="text-[11px] text-gray-400 mt-1.5">อัปโหลดใหม่เพื่อแทนที่รูปเดิม</p>
                            </div>
                        </div>
                    </div>

                    <!-- รูปรถใหญ่ -->
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รูปภาพหลัก (หน้ารายละเอียด)</label>
                        <div class="flex items-center gap-4 p-4 bg-gray-50 border border-gray-200 rounded-2xl">
                            <div class="w-16 h-16 bg-white rounded-xl border border-gray-200 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                                <img id="preview-main-{{ $product->id }}" src="{{ $product->image_url ? asset('storage/' . $product->image_url) : 'https://placehold.co/100x100?text=No+Image' }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <label class="inline-block px-4 py-2 bg-black text-white text-xs font-bold rounded-full cursor-pointer hover:bg-gray-800 transition-all shadow-sm">
                                    เปลี่ยนรูปภาพ
                                    <input type="file" name="image" accept="image/*" class="hidden" onchange="previewImage(event, 'preview-main-{{ $product->id }}')">
                                </label>
                                <p class="text-[11px] text-gray-400 mt-1.5">อัปโหลดใหม่เพื่อแทนที่รูปเดิม</p>
                            </div>
                        </div>
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
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">คำอธิบายสั้น (โชว์บนการ์ดหน้าแรก)</label>
                    <input type="text" name="short_description" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 outline-none transition" placeholder="เช่น รถยนต์ซีดานไฟฟ้า 100% สไตล์มินิมอล">
                </div>
            </form>
        </div>

        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
            <!-- ปุ่มลบข้อมูล -->
            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบรถยนต์รุ่น {{ $product->name }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-bold tracking-widest uppercase transition-colors px-2 py-1">
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

<!-- Script สำหรับควบคุม Modal และระบบพรีวิวรูปภาพ -->
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

    // ฟังก์ชันสำหรับแสดงรูปพรีวิวทันทีที่เลือกไฟล์
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById(previewId);
            output.src = reader.result;
        };
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
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