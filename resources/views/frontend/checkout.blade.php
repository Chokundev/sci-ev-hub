<!DOCTYPE html>
<html lang="th">
<head>
    <title>ยืนยันการสั่งจอง {{ $product->name }} - SCI EV Hub</title>
    @include('partials.meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased min-h-screen">

    <!-- Navbar ย่อขนาดสำหรับการ Checkout -->
    <nav class="w-full bg-white shadow-sm border-b border-gray-100 py-4 px-6">
        <div class="max-w-[1200px] mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold tracking-[0.1em] uppercase text-gray-900">SCI EV Hub</a>
            <a href="{{ route('product.detail', $product->id) }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">ยกเลิกและกลับไปที่สินค้า</a>
        </div>
    </nav>

    <main class="max-w-[1200px] mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <!-- ส่วนสรุปข้อมูลสินค้า (ซ้าย) -->
            <div class="w-full lg:w-5/12 order-2 lg:order-1">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 sticky top-8">
                    <h2 class="text-xl font-bold mb-6">สรุปรายการสั่งจอง</h2>
                    
                    @php
                        $checkoutImg = $product->image_url;
                        if ($checkoutImg && !str_starts_with($checkoutImg, 'http')) {
                            $checkoutImg = asset('storage/' . $checkoutImg);
                        }
                    @endphp
                    <img src="{{ $checkoutImg }}" alt="{{ $product->name }}" class="w-full h-auto object-contain mb-6 drop-shadow-sm">
                    
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between pb-4 border-b border-gray-100">
                            <span class="text-gray-500">รุ่นรถยนต์</span>
                            <span class="font-semibold text-gray-900">{{ $product->name }}</span>
                        </div>
                        <div class="flex justify-between pb-4 border-b border-gray-100">
                            <span class="text-gray-500">อัตราเร่ง 0-100</span>
                            <span class="font-medium text-gray-900">{{ $product->accel_0_100 }}</span>
                        </div>
                        <div class="flex justify-between pb-4 border-b border-gray-100">
                            <span class="text-gray-500">ระยะทาง (Range)</span>
                            <span class="font-medium text-gray-900">{{ $product->max_range }}</span>
                        </div>
                        <div class="flex justify-between items-end pt-4">
                            <span class="text-gray-900 font-bold text-lg">ราคาสุทธิ</span>
                            <span class="font-bold text-2xl text-gray-900">฿ {{ number_format($product->price, 0) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ส่วนฟอร์มกรอกข้อมูลผู้จอง (ขวา) -->
            <div class="w-full lg:w-7/12 order-1 lg:order-2">
                <h1 class="text-3xl font-bold mb-8">ข้อมูลผู้สั่งจอง</h1>
                
                <form action="{{ route('checkout.store', $product->id) }}" method="POST" class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 space-y-6">
                    @csrf

                    <!-- ดึงข้อมูลผู้ใช้จากระบบแบบอ่านอย่างเดียว (Readonly) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ชื่อ - นามสกุล</label>
                            <input type="text" value="{{ Auth::user()->name }}" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">อีเมลติดต่อ</label>
                            <input type="email" value="{{ Auth::user()->email }}" readonly class="w-full px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed outline-none">
                        </div>
                    </div>

                    <!-- ช่องกรอกเบอร์โทรหรือข้อความเพิ่มเติม (บันทึกลงฟิลด์ notes) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">เบอร์โทรศัพท์ และ ความต้องการเพิ่มเติม</label>
                        <textarea name="notes" rows="4" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none transition placeholder-gray-400" placeholder="ระบุเบอร์โทรศัพท์ หรือสีรถที่ต้องการ..."></textarea>
                    </div>

                    <div class="bg-blue-50 text-blue-800 p-4 rounded-xl text-sm leading-relaxed border border-blue-100">
                        <strong>หมายเหตุ:</strong> การสั่งจองนี้เป็นเพียงการลงทะเบียนแสดงความสนใจ ทีมงาน SCI EV Hub จะติดต่อกลับไปยังข้อมูลติดต่อของท่านเพื่อยืนยันรายละเอียดและนัดหมายทำสัญญาในขั้นตอนถัดไป
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full bg-gray-900 text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-black hover:shadow-xl transition-all">
                            ยืนยันการสั่งจอง
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
</body>
</html>