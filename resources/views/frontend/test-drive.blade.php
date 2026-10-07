<!DOCTYPE html>
<html lang="th">
<head>
    <title>จองคิวทดลองขับ - SCI EV Hub</title>
    @include('partials.meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased min-h-screen">

    <!-- Navbar -->
    <nav class="w-full bg-white shadow-sm border-b border-gray-100 py-4 px-6 sticky top-0 z-50">
        <!-- ปรับเป็น grid 3 คอลัมน์ เพื่อให้ปุ่มอยู่ซ้าย และโลโก้อยู่ตรงกลาง -->
        <div class="max-w-[1200px] mx-auto grid grid-cols-3 items-center">
            
            <!-- ฝั่งซ้าย: ปุ่มกลับ -->
            <div class="flex justify-start">
                <a href="/" class="text-sm font-medium text-gray-500 hover:text-gray-900 flex items-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                    กลับสู่หน้าหลัก
                </a>
            </div>

            <!-- ตรงกลาง: โลโก้ -->
            <div class="flex justify-center text-center">
                <a href="/" class="text-xl font-bold tracking-[0.1em] uppercase text-gray-900">SCI EV Hub</a>
            </div>

            <!-- ฝั่งขวา: ปล่อยว่างไว้รักษาสมดุล -->
            <div class="flex justify-end"></div>
            
        </div>
    </nav>

    <main class="max-w-[1000px] mx-auto px-4 py-12">
        
        <!-- Header Section -->
        <div class="text-center mb-12">
            <span class="text-xs font-bold tracking-widest uppercase text-gray-500 mb-2 block">Experience the Future</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Book a Test Drive</h1>
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">สัมผัสสมรรถนะแห่งอนาคตและเทคโนโลยีการขับขี่สุดล้ำ เลือกรุ่นรถและเวลาที่คุณสะดวกเพื่อทดลองขับด้วยตัวคุณเอง</p>
        </div>

        <form action="{{ route('test-drive.store') }}" method="POST" class="space-y-10">
            @csrf

            <!-- 1. เลือกรุ่นรถยนต์ (Visual Selector) -->
            <div class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">1</span> 
                    เลือกรถยนต์ที่ต้องการทดลองขับ
                </h3>
                
                @error('product_id')
                    <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">{{ $message }}</div>
                @enderror

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $car)
                        @php
                            // ดึงรูปรถจากหน้าดีเทลมาแสดงโดยตรง
                            $img = $car->image_url;
                            if ($img && !str_starts_with($img, 'http')) {
                                $img = asset('storage/' . $img);
                            } elseif (!$img) {
                                $img = 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                            }
                        @endphp
                        
                        <label class="relative cursor-pointer group">
                            <!-- ซ่อน Input Radio ไว้ แต่ใช้คลาส peer เพื่อตรวจจับสถานะ Checked -->
                            <input type="radio" name="product_id" value="{{ $car->id }}" class="peer sr-only" required {{ (isset($selectedProductId) && $selectedProductId == $car->id) ? 'checked' : '' }}>
                            
                            <!-- โครงสร้างการ์ดที่จะเปลี่ยนสไตล์เมื่อ Radio ด้านบนถูก Checked -->
                            <div class="rounded-2xl border-2 border-gray-100 bg-white p-6 transition-all duration-300 hover:shadow-lg peer-checked:border-gray-900 peer-checked:ring-1 peer-checked:ring-gray-900 peer-checked:bg-gray-50 h-full flex flex-col items-center justify-center relative overflow-hidden">
                                
                                <!-- ไอคอนติ๊กถูก (จะโผล่มาเมื่อถูกเลือก) -->
                                <div class="absolute top-4 right-4 text-gray-900 opacity-0 transition-opacity duration-300 peer-checked:opacity-100 z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <img src="{{ $img }}" alt="{{ $car->name }}" class="w-full h-32 object-contain mb-4 transform transition-transform duration-500 group-hover:scale-110 drop-shadow-md">
                                
                                <div class="text-center w-full mt-auto">
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $car->name }}</h4>
                                    <span class="inline-block mt-2 px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold tracking-wider uppercase">
                                        {{ $car->energy_type ?? 'Electric' }}
                                    </span>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                
                <!-- 2. ข้อมูลผู้ติดต่อ (ดึงจากระบบอัตโนมัติ) -->
                <div class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">2</span> 
                        ข้อมูลผู้ติดต่อ
                    </h3>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">ชื่อ - นามสกุล</label>
                            <input type="text" value="{{ Auth::user()->name }}" readonly class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed outline-none font-medium">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">อีเมลติดต่อ</label>
                            <input type="email" value="{{ Auth::user()->email }}" readonly class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-500 cursor-not-allowed outline-none font-medium">
                        </div>
                    </div>
                </div>

                <!-- 3. วันเวลาและรายละเอียด -->
                <div class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm">3</span> 
                        นัดหมายเวลา
                    </h3>
                    
                    <div class="space-y-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">วันที่ต้องการ</label>
                                <input type="date" name="booking_date" required min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none transition text-gray-700">
                                @error('booking_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">เวลาที่สะดวก</label>
                                <input type="time" name="booking_time" required class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none transition text-gray-700">
                                @error('booking_time')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">เบอร์โทรศัพท์ / หมายเหตุ (ถ้ามี)</label>
                            <textarea name="notes" rows="3" class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none transition placeholder-gray-400" placeholder="ระบุเบอร์โทรติดต่อ หรือสิ่งที่ต้องการเน้นย้ำในการทดลองขับ..."></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="pt-6 pb-12 flex justify-center">
                <button type="submit" class="px-12 py-4 bg-gray-900 text-white rounded-full font-bold text-lg shadow-xl hover:bg-black hover:shadow-2xl transition-all transform hover:-translate-y-1 w-full md:w-auto">
                    ยืนยันการจองคิวทดลองขับ
                </button>
            </div>
            
        </form>
    </main>
<!-- นำเข้า SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ใช้ Swal.fire แบบกำหนด Custom HTML เองเพื่อให้ล้างดีไซน์เขียวเดิมออกหมดเกลี้ยง
            Swal.fire({
                html: `
                    <div style="display: flex; align-items: center; text-align: left; width: 100%;">
                        <div style="background-color: #ffffff; color: #000000; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-right: 14px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 18px; height: 18px;"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" /></svg>
                        </div>
                        <div>
                            <div style="font-size: 14px; font-weight: 600; color: #ffffff; margin-bottom: 2px; letter-spacing: 0.3px;">จองคิวทดลองขับเรียบร้อยแล้ว</div>
                            <div style="font-size: 12px; color: #a3a3a3; font-weight: 400;">เจ้าหน้าที่จะติดต่อกลับเพื่อยืนยันนัดหมายโดยเร็วที่สุด</div>
                        </div>
                    </div>
                `,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: false,
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

    <!-- CSS ปรับแต่งขอบและตำแหน่ง -->
    <style>
        .custom-premium-popup {
            border-radius: 14px !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            margin-top: 80px !important;
        }
    </style>
    @endif
    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ป๊อปอัปแจ้งเตือนข้อผิดพลาด (Premium Dark Style)
            Swal.fire({
                html: `
                    <div style="display: flex; align-items: center; text-align: left; width: 100%;">
                        <div style="background-color: #ef4444; color: #ffffff; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-right: 14px; box-shadow: 0 0 10px rgba(239, 68, 68, 0.4);">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 18px; height: 18px;"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" /></svg>
                        </div>
                        <div>
                            <div style="font-size: 14px; font-weight: 600; color: #ffffff; margin-bottom: 2px; letter-spacing: 0.3px;">ไม่สามารถจองคิวซ้ำได้</div>
                            <div style="font-size: 12px; color: #a3a3a3; font-weight: 400; line-height: 1.4;">{{ session('error') }}</div>
                        </div>
                    </div>
                `,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true, // เปิดบาร์โหลดเพื่อระบุว่าเดี๋ยวจะหายไป
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
    @endif
</body>
</html>