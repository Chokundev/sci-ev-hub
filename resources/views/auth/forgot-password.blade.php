<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลืมรหัสผ่าน - SCI EV Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased selection:bg-black selection:text-white flex min-h-screen items-center justify-center p-6">

    <div class="w-full max-w-lg bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 p-8 sm:p-12 relative overflow-hidden">
        
        <!-- ตกแต่งพื้นหลังเล็กน้อยเพิ่มความล้ำสมัย -->
        <div class="absolute top-0 right-0 w-40 h-40 bg-gray-50 rounded-full mix-blend-multiply filter blur-2xl opacity-70 transform translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

        <!-- ปุ่มกลับหน้าเข้าสู่ระบบ -->
        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-black transition-colors text-[11px] font-bold tracking-widest uppercase mb-10 group relative z-10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 transform transition-transform group-hover:-translate-x-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>
            Back to Login
        </a>

        <div class="relative z-10">
            <h2 class="text-3xl font-extrabold text-black tracking-tight mb-4">ลืมรหัสผ่านใช่ไหม?</h2>
            <p class="text-[14px] text-gray-500 font-medium leading-relaxed mb-8">
                ไม่ต้องกังวล เพียงกรอกอีเมลที่คุณใช้สมัครสมาชิก เราจะส่งลิงก์สำหรับตั้งค่ารหัสผ่านใหม่ไปให้คุณทางอีเมลอย่างปลอดภัย
            </p>

            <!-- แจ้งเตือนสถานะเมื่อส่งอีเมลสำเร็จ (Session Status) -->
            @if (session('status'))
                <div class="mb-8 p-5 bg-green-50 border border-green-100 rounded-2xl flex items-start gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    <div>
                        <h4 class="font-bold text-green-900 text-sm">ส่งลิงก์สำเร็จ</h4>
                        <p class="text-xs text-green-700 mt-1 font-medium">{{ session('status') }}</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- ข้อมูล: อีเมล -->
                <div>
                    <label for="email" class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">อีเมลติดต่อ (Email)</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="hello@example.com" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium text-gray-900">
                    
                    @error('email') 
                        <p class="text-red-500 text-xs mt-2 font-medium flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full px-8 py-4 bg-black text-white font-bold rounded-full hover:bg-gray-800 shadow-lg hover:shadow-xl transition-all uppercase tracking-widest text-[13px]">
                        ส่งลิงก์รีเซ็ตรหัสผ่าน
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>