<!DOCTYPE html>
<html lang="th">
<head>
    <title>ยืนยันการสั่งจอง {{ $product->name }} - SCI EV Hub</title>
    @include('partials.meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased min-h-screen">

    <!-- Navbar ย่อขนาดสำหรับการ Checkout -->
    <nav class="w-full bg-white shadow-sm border-b border-gray-100 py-4 px-6 sticky top-0 z-50">
        <div class="max-w-[1200px] mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold tracking-[0.1em] uppercase text-gray-900">SCI EV Hub</a>
            <a href="{{ route('product.detail', $product->id) }}" class="text-sm font-bold tracking-wide text-gray-500 hover:text-gray-900 transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                ยกเลิกและกลับไปที่สินค้า
            </a>
        </div>
    </nav>

    <main class="max-w-[1200px] mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            
            <!-- ส่วนสรุปข้อมูลสินค้า (ซ้าย) -->
            <div class="w-full lg:w-5/12 order-2 lg:order-1">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 sticky top-24">
                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-2">Order Summary</p>
                    <h2 class="text-2xl font-extrabold mb-8 tracking-tight">สรุปรายการสั่งจอง</h2>
                    
                    @php
                        $checkoutImg =$product->image_url;
                        if ($checkoutImg && !str_starts_with($checkoutImg, 'http')) {
                            $checkoutImg = asset('storage/' .$checkoutImg);
                        }
                    @endphp
                    
                    <div class="flex justify-center mb-8 bg-gray-50 rounded-2xl p-4">
                        <img src="{{ $checkoutImg }}" alt="{{ $product->name }}" class="w-full h-auto object-contain drop-shadow-lg hover:scale-105 transition-transform duration-500">
                    </div>
                    
                    <div class="space-y-5 text-sm">
                        <div class="flex justify-between pb-5 border-b border-gray-100 items-center">
                            <span class="text-[11px] font-bold tracking-widest text-gray-400 uppercase">รุ่นรถยนต์</span>
                            <span class="font-extrabold text-gray-900 text-lg">{{ $product->name }}</span>
                        </div>
                        <div class="flex justify-between pb-5 border-b border-gray-100 items-center">
                            <span class="text-[11px] font-bold tracking-widest text-gray-400 uppercase">อัตราเร่ง 0-100</span>
                            <span class="font-bold text-gray-900">{{ $product->accel_0_100 }}</span>
                        </div>
                        <div class="flex justify-between pb-5 border-b border-gray-100 items-center">
                            <span class="text-[11px] font-bold tracking-widest text-gray-400 uppercase">ระยะทาง (Range)</span>
                            <span class="font-bold text-gray-900">{{ $product->max_range }}</span>
                        </div>
                        <div class="flex justify-between items-end pt-4">
                            <span class="text-gray-900 font-extrabold tracking-tight">ราคาสุทธิ</span>
                            <span class="font-extrabold text-3xl text-gray-900 tracking-tight">฿ {{ number_format($product->price, 0) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ส่วนฟอร์มกรอกข้อมูลผู้จอง (ขวา) -->
            <div class="w-full lg:w-7/12 order-1 lg:order-2">
                <div class="mb-10">
                    <p class="text-[11px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-2">Customer Details</p>
                    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">ข้อมูลผู้สั่งจอง</h1>
                </div>
                
                <form action="{{ route('checkout.store', $product->id) }}" method="POST" class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100 space-y-8">
                    @csrf

                    <!-- ดึงข้อมูลผู้ใช้จากระบบแบบอ่านอย่างเดียว (Readonly) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ชื่อ - นามสกุล</label>
                            <input type="text" value="{{ Auth::user()->name }}" readonly class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed outline-none font-bold">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">อีเมลติดต่อ</label>
                            <input type="email" value="{{ Auth::user()->email }}" readonly class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed outline-none font-bold">
                        </div>
                    </div>

                    <!-- ช่องกรอกเบอร์โทรหรือข้อความเพิ่มเติม (บันทึกลงฟิลด์ notes) -->
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">เบอร์โทรศัพท์ และ ความต้องการเพิ่มเติม</label>
                        <textarea name="notes" rows="4" class="w-full px-5 py-4 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition placeholder-gray-400 font-medium resize-none" placeholder="ระบุเบอร์โทรศัพท์ หรือสีรถที่ต้องการ..."></textarea>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-2xl flex items-start gap-4 border border-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 flex-shrink-0 text-black mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm tracking-wide">ขั้นตอนถัดไป</h4>
                            <p class="text-[13px] text-gray-600 mt-1 leading-relaxed">การสั่งจองนี้เป็นการลงทะเบียนแสดงความสนใจ ทีมงานจะติดต่อกลับไปยังข้อมูลของท่านเพื่อยืนยันรายละเอียดและนัดหมายทำสัญญา</p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full px-8 py-5 bg-black text-white font-bold rounded-full hover:bg-gray-800 shadow-xl hover:shadow-2xl transition-all uppercase tracking-widest text-[13px]">
                            ยืนยันการสั่งจอง
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>

    <!-- นำเข้า SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script สำหรับดักจับ Flash Message (Error) กรณีจองซ้ำ -->
    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                html: `
                    <div style="display: flex; align-items: center; text-align: left; width: 100%;">
                        <div style="background-color: #ef4444; color: #ffffff; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-right: 14px; box-shadow: 0 0 10px rgba(239, 68, 68, 0.4);">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 18px; height: 18px;"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" /></svg>
                        </div>
                        <div>
                            <div style="font-size: 14px; font-weight: 600; color: #ffffff; margin-bottom: 2px; letter-spacing: 0.3px;">ไม่สามารถทำรายการซ้ำได้</div>
                            <div style="font-size: 12px; color: #a3a3a3; font-weight: 400; line-height: 1.4;">{{ session('error') }}</div>
                        </div>
                    </div>
                `,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 6000,
                timerProgressBar: true,
                background: '#1a1a1a',
                color: '#ffffff',
                padding: '16px 20px',
                width: 'auto',
                customClass: {
                    popup: 'custom-premium-popup'
                },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        });
    </script>

    <style>
        .custom-premium-popup {
            border-radius: 14px !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            margin-top: 80px !important; /* เว้นระยะลงมาจาก Navbar */
        }
    </style>
    @endif

</body>
</html>