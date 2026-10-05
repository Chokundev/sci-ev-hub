<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SCI EV Hub</title>
    <!-- เรียกใช้ Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 overflow-hidden">
    
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-72 bg-primary text-white flex flex-col shadow-2xl z-20">
            <div class="p-6 text-center border-b border-gray-800">
                <h2 class="text-3xl font-bold text-accent tracking-tighter">SCI EV Hub</h2>
                <p class="text-sm text-gray-400 mt-2 font-light">ระบบจัดการหลังบ้าน</p>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-3 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl bg-gray-800 text-white font-medium shadow-sm transition">
                    <span class="mr-3">📊</span> แดชบอร์ดภาพรวม
                </a>
                <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-gray-800 transition">
                    <span class="mr-3">👥</span> จัดการผู้ใช้
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-gray-800 transition">
                    <span class="mr-3">🚘</span> จัดการสินค้า
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-gray-800 transition">
                    <span class="mr-3">🛒</span> จัดการรายการสั่งซื้อ
                </a>
                
                <!-- เช็คสิทธิ์: แสดงเมนูนี้เฉพาะ superadmin เท่านั้น -->
                @if(Auth::user()->role === 'superadmin')
                <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-gray-800 transition border border-gray-700 mt-4">
                    <span class="mr-3">🛡️</span> จัดการผู้ดูแลระบบ
                </a>
                @endif
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Topbar -->
            <header class="h-20 bg-white/80 backdrop-blur-md shadow-sm flex items-center justify-between px-8 z-10">
                <h1 class="text-2xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
                
                <div class="flex items-center gap-6">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 uppercase">{{ Auth::user()->role }}</p>
                    </div>
                    
                    <!-- ปุ่มออกจากระบบ -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-100 transition">
                            ออกจากระบบ
                        </button>
                    </form>
                </div>
            </header>

            <!-- พื้นที่แสดงเนื้อหาของแต่ละหน้า (Content) -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-8">
                @yield('content')
            </main>
        </div>
    </div>

</body>
<!-- Script ตรวจสอบ Flash Message เพื่อแสดง SweetAlert2 -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#1CAAD9',
                confirmButtonText: 'ตกลง'
            });
        });
    </script>
    @endif
</html>