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

</body>
</html>