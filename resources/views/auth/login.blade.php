<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - SCI EV Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white flex min-h-screen">

    <!-- ============================================== -->
    <!-- ฝั่งซ้าย: แบนเนอร์/ภาพประกอบ (ซ่อนในมือถือ แสดงเฉพาะจอใหญ่) -->
    <!-- ============================================== -->
    <div class="hidden lg:flex lg:w-1/2 bg-black relative overflow-hidden items-center justify-center">
        <!-- ภาพพื้นหลังรถ EV สไตล์ Dark & Sleek -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1593941707882-a5bba14938c7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Sleek EV Car" class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
        </div>

        <!-- ข้อความต้อนรับ -->
        <div class="relative z-10 p-16 text-white text-center max-w-lg mt-32">
            <h1 class="text-5xl font-extrabold tracking-widest mb-4 uppercase">Welcome Back</h1>
            <p class="text-gray-300 leading-relaxed font-medium">เข้าสู่ระบบ SCI EV Hub เพื่อจัดการคำสั่งซื้อ ติดตามสถานะการส่งมอบ และจองคิวทดลองขับยานยนต์ไฟฟ้าของคุณ</p>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- ฝั่งขวา: ฟอร์มเข้าสู่ระบบ -->
    <!-- ============================================== -->
    <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 sm:p-12 md:p-16 lg:p-24 bg-white relative">
        
        <!-- ปุ่มกลับหน้าหลัก -->
        <a href="{{ route('home') }}" class="absolute top-8 left-8 sm:top-12 sm:left-12 flex items-center gap-2 text-gray-400 hover:text-black transition-colors text-[11px] font-bold tracking-widest uppercase group">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 transform transition-transform group-hover:-translate-x-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>
            Back
        </a>

        <div class="w-full max-w-md mt-10 lg:mt-0">
            
            <div class="mb-10 text-center lg:text-left">
                <p class="text-[11px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-2">Sign In to SCI EV Hub</p>
                <h2 class="text-3xl font-extrabold text-black tracking-tight">เข้าสู่ระบบ</h2>
            </div>

            <!-- Session Status (ข้อความแจ้งเตือนสีเขียว เช่น กรณีรีเซ็ตรหัสผ่านสำเร็จ) -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-600 rounded-xl text-sm font-medium">
                    {{ session('status') }}
                </div>
            @endif

            <!-- ฟอร์มส่งข้อมูลไปยังระบบ Auth ของ Laravel -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- ข้อมูล: อีเมล -->
                <div>
                    <label for="email" class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">อีเมลติดต่อ</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="hello@example.com" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                    @error('email') 
                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> 
                    @enderror
                </div>

                <!-- ข้อมูล: รหัสผ่าน -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase">รหัสผ่าน</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[11px] font-bold tracking-wide text-gray-400 hover:text-black transition-colors underline">
                                ลืมรหัสผ่าน?
                            </a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium text-lg tracking-widest">
                    @error('password') 
                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p> 
                    @enderror
                </div>

                <!-- ข้อมูล: จำการเข้าระบบ (Remember Me) -->
                <div class="flex items-center">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-black shadow-sm focus:ring-black w-4 h-4 transition-colors cursor-pointer">
                        <span class="ml-3 text-sm text-gray-600 font-medium group-hover:text-black transition-colors">จดจำฉันไว้ในระบบ</span>
                    </label>
                </div>

                <!-- ปุ่ม Submit -->
                <div class="pt-2">
                    <button type="submit" class="w-full px-8 py-4 bg-black text-white font-bold rounded-full hover:bg-gray-800 shadow-lg hover:shadow-xl transition-all uppercase tracking-widest text-[13px]">
                        ลงชื่อเข้าใช้งาน
                    </button>
                </div>

                <!-- ลิงก์ไปหน้าสมัครสมาชิก -->
                <div class="text-center mt-8 pt-6 border-t border-gray-100">
                    <p class="text-sm text-gray-500 font-medium">
                        ยังไม่มีบัญชีผู้ใช้ใช่ไหม? 
                        <a href="{{ route('register') }}" class="text-black font-bold hover:underline transition-all ml-1">สมัครสมาชิกเลย</a>
                    </p>
                </div>
            </form>

        </div>
    </div>

</body>
</html>