@extends('layouts.admin')
@section('title', 'แก้ไขข้อมูลรถยนต์')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 max-w-4xl">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT') <!-- ระบุว่าเป็น HTTP PUT สำหรับการแก้ไข -->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ชื่อรุ่นรถยนต์</label>
                <input type="text" name="name" value="{{ $product->name }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ราคา (บาท)</label>
                <input type="number" name="price" value="{{ $product->price }}" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-cyan-500 outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-gray-50 rounded-2xl border border-gray-100">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">อัตราเร่ง 0-100</label>
                <input type="text" name="accel_0_100" value="{{ $product->accel_0_100 }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ระยะทางสูงสุด (Range)</label>
                <input type="text" name="max_range" value="{{ $product->max_range }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ความเร็วสูงสุด</label>
                <input type="text" name="top_speed" value="{{ $product->top_speed }}" required class="w-full px-4 py-2 border border-gray-200 rounded-lg outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">โค้ดฝัง 3D Model</label>
            <textarea name="embed_code" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none font-mono text-sm">{{ $product->embed_code }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">รายละเอียดเพิ่มเติม</label>
            <textarea name="description" rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none">{{ $product->description }}</textarea>
        </div>

        <div class="flex justify-end gap-4 pt-4 border-t border-gray-100">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 text-gray-600 hover:bg-gray-100 rounded-xl">ยกเลิก</a>
            <button type="submit" class="px-8 py-3 bg-gray-900 text-white font-semibold rounded-xl shadow-md hover:bg-black">อัปเดตข้อมูล</button>
        </div>
    </form>
</div>
@endsection