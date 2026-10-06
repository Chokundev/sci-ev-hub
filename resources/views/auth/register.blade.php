<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก - SCI EV Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white flex min-h-screen">

    <!-- ============================================== -->
    <!-- ฝั่งซ้าย: แบนเนอร์/ภาพประกอบ (ซ่อนในมือถือ แสดงเฉพาะจอใหญ่) -->
    <!-- ============================================== -->
    <div class="hidden lg:flex lg:w-1/2 bg-gray-900 relative overflow-hidden items-center justify-center">
        <!-- ภาพพื้นหลังรถ EV แบบพรีเมียม -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Premium EV Car" class="w-full h-full object-cover opacity-40">
            <!-- ไล่ระดับสีดำจากด้านล่างขึ้นบนเพื่อให้ข้อความอ่านง่าย -->
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
        </div>

        <!-- ข้อความแบรนดิ้ง -->
        <div class="relative z-10 p-16 text-white text-center max-w-lg">
            <h1 class="text-5xl font-extrabold tracking-widest mb-6 uppercase">SCI EV Hub</h1>
            <p class="text-gray-300 leading-relaxed font-medium">ก้าวสู่โลกแห่งยานยนต์ไฟฟ้าแห่งอนาคต สมัครสมาชิกเพื่อสัมผัสประสบการณ์การขับขี่ที่เหนือกว่า พร้อมรับข้อเสนอและบริการสุดพิเศษ</p>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- ฝั่งขวา: ฟอร์มสมัครสมาชิก -->
    <!-- ============================================== -->
    <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 sm:p-12 md:p-16 lg:p-24 bg-white relative">
        
        <!-- ปุ่มกลับหน้าหลัก (ย้ายมาไว้มุมซ้ายบนของฟอร์ม) -->
        <a href="{{ route('home') }}" class="absolute top-8 left-8 sm:top-12 sm:left-12 flex items-center gap-2 text-gray-400 hover:text-black transition-colors text-[11px] font-bold tracking-widest uppercase group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 transform transition-transform group-hover:-translate-x-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>
            Back
        </a>

        <div class="w-full max-w-md mt-10 lg:mt-0">
            
            <div class="mb-10 text-center lg:text-left">
                <p class="text-[11px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-2">Create Account</p>
                <h2 class="text-3xl font-extrabold text-black tracking-tight">สมัครสมาชิกใหม่</h2>
            </div>

            <!-- เริ่มต้นฟอร์มไปยังระบบของ Laravel Breeze -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- ข้อมูล: ชื่อ - นามสกุล -->
                <div>
                    <label for="name" class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ชื่อ - นามสกุล</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                    @error('name') 
                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> 
                    @enderror
                </div>

                <!-- ข้อมูล: อีเมล -->
                <div>
                    <label for="email" class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">อีเมลติดต่อ</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="hello@example.com" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                    @error('email') 
                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> 
                    @enderror
                </div>

                <!-- ข้อมูล: รหัสผ่าน -->
                <div>
                    <label for="password" class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">รหัสผ่าน</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium text-lg tracking-widest">
                    @error('password') 
                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> 
                    @enderror
                </div>

                <!-- ข้อมูล: ยืนยันรหัสผ่าน -->
                <div>
                    <label for="password_confirmation" class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ยืนยันรหัสผ่านอีกครั้ง</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium text-lg tracking-widest">
                    @error('password_confirmation') 
                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> 
                    @enderror
                </div>

                <!-- ปุ่ม Submit -->
                <div class="pt-4">
                    <button type="submit" class="w-full px-8 py-4 bg-black text-white font-bold rounded-full hover:bg-gray-800 shadow-lg hover:shadow-xl transition-all uppercase tracking-widest text-[13px]">
                        ยืนยันการสร้างบัญชี
                    </button>
                </div>

                <!-- ลิงก์กลับไปหน้าเข้าสู่ระบบ -->
                <div class="text-center mt-8 pt-6 border-t border-gray-100">
                    <p class="text-sm text-gray-500 font-medium">
                        มีบัญชีผู้ใช้อยู่แล้วใช่ไหม? 
                        <a href="{{ route('login') }}" class="text-black font-bold hover:underline transition-all ml-1">เข้าสู่ระบบเลย</a>
                    </p>
                </div>
            </form>

        </div>
    </div>

</body>
</html>