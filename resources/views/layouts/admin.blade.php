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
        <aside class="w-72 bg-gray-900 text-white flex flex-col shadow-2xl z-20">
            <div class="p-6 text-center border-b border-gray-800">
                <h2 class="text-3xl font-bold text-white tracking-tighter">
                    <span class="text-cyan-400">⚡</span> SCI EV Hub
                </h2>
                <p class="text-sm text-gray-400 mt-2 font-light">ระบบจัดการหลังบ้าน</p>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <!-- แดชบอร์ดภาพรวม -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-600 text-white shadow-md' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-cyan-400' }} transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    แดชบอร์ดภาพรวม
                </a>

                <!-- จัดการสินค้า -->
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.products.*') ? 'bg-cyan-600 text-white shadow-md' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.products.*') ? 'text-white' : 'text-gray-400 group-hover:text-cyan-400' }} transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                    </svg>
                    จัดการสินค้ารถยนต์
                </a>

                <!-- จัดการรายการสั่งซื้อ -->
                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.orders.*') ? 'bg-cyan-600 text-white shadow-md' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.orders.*') ? 'text-white' : 'text-gray-400 group-hover:text-cyan-400' }} transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    จัดการรายการสั่งซื้อ
                </a>

                <!-- จัดการจองทดลองขับ (เมนูใหม่ที่เพิ่มเข้ามารอ) -->
                <a href="{{ route('admin.test-drives.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-gray-800 transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 text-gray-400 group-hover:text-cyan-400 transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    จัดการจองทดลองขับ
                </a>

                <!-- จัดการผู้ใช้ -->
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-cyan-600 text-white shadow-md' : 'text-gray-400 hover:text-white hover:bg-gray-800' }} transition group mt-4 border-t border-gray-800 pt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-cyan-400' }} transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    จัดการผู้ใช้งาน
                </a>
                
                <!-- เช็คสิทธิ์: แสดงเมนูนี้เฉพาะ superadmin เท่านั้น -->
                @if(Auth::user()->role === 'superadmin')
                <a href="#" class="flex items-center px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-gray-800 transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-3 text-gray-400 group-hover:text-cyan-400 transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                    </svg>
                    จัดการผู้ดูแลระบบ
                </a>
                @endif
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Topbar -->
            <header class="h-20 bg-white/80 backdrop-blur-md shadow-sm flex items-center justify-between px-8 z-10 border-b border-gray-100">
                <h1 class="text-2xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
                
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3">
                        <!-- ไอคอนโปรไฟล์แบบเรียบง่าย -->
                        <div class="w-10 h-10 rounded-full bg-cyan-100 flex items-center justify-center text-cyan-700 font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-semibold text-gray-800 leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 uppercase">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    
                    <!-- ปุ่มออกจากระบบ -->
                    <form method="POST" action="{{ route('logout') }}" class="border-l border-gray-200 pl-6">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 text-gray-500 hover:text-red-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            <span class="text-sm font-medium">ออกจากระบบ</span>
                        </button>
                    </form>
                </div>
            </header>

            <!-- พื้นที่แสดงเนื้อหาของแต่ละหน้า (Content) -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-8 bg-gray-50/50">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Script ตรวจสอบ Flash Message เพื่อแสดง SweetAlert2 -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#0891b2', // ใช้สีให้เข้ากับธีม cyan
                confirmButtonText: 'ตกลง'
            });
        });
    </script>
    @endif
    
    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#ef4444', 
                confirmButtonText: 'ตกลง'
            });
        });
    </script>
    @endif
</body>
</html>