<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - SCI EV Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center font-sans relative overflow-hidden">
    
    <!-- พื้นหลังตกแต่ง (Background Decoration) -->
    <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-cyan-300 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>

    <!-- กล่อง Login แบบ Glassmorphism -->
    <div class="w-full max-w-md p-8 m-4 rounded-3xl shadow-2xl glass-panel relative z-10 bg-white/60 backdrop-blur-xl border border-white/40">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">SCI EV Hub</h1>
            <p class="text-gray-500 mt-2">เข้าสู่ระบบเพื่อดำเนินการต่อ</p>
        </div>

        <!-- แจ้งเตือนกรณีรหัสผ่านผิด -->
        @if ($errors->any())
            <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-600 text-sm">
                อีเมลหรือรหัสผ่านไม่ถูกต้อง
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">อีเมล</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full px-4 py-3 bg-white/50 border border-gray-300 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 transition-all outline-none"
                    placeholder="your@email.com">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">รหัสผ่าน</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full px-4 py-3 bg-white/50 border border-gray-300 rounded-xl focus:border-cyan-500 focus:ring-cyan-500 transition-all outline-none"
                    placeholder="••••••••">
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-cyan-600 shadow-sm focus:ring-cyan-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">จดจำฉัน</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-cyan-600 hover:text-cyan-800 transition" href="{{ route('password.request') }}">
                        ลืมรหัสผ่าน?
                    </a>
                @endif
            </div>

            <!-- ปุ่ม Submit -->
            <button type="submit" class="w-full py-3 px-4 bg-gray-900 text-white font-semibold rounded-xl shadow-md hover:bg-gray-800 transition-all focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                เข้าสู่ระบบ
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-gray-600">
            ยังไม่มีบัญชีใช่หรือไม่? 
            <a href="{{ route('register') }}" class="font-medium text-cyan-600 hover:text-cyan-800 transition">สร้างบัญชีผู้ใช้</a>
        </p>
    </div>

</body>
</html>