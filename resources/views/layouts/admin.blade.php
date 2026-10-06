<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - SCI EV Hub</title>
    <!-- เรียกใช้ Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900 overflow-hidden selection:bg-black selection:text-white">
    
    <div class="flex h-screen">
        <!-- Sidebar (ปรับเป็นสีขาว คลีน มินิมอล) -->
        <aside class="w-72 bg-white text-gray-900 flex flex-col shadow-[4px_0_24px_rgba(0,0,0,0.02)] border-r border-gray-100 z-20">
            <div class="p-8 text-center border-b border-gray-100">
                <h2 class="text-2xl font-extrabold tracking-[0.2em] uppercase text-black">
                    SCI EV Hub
                </h2>
                <p class="text-[11px] text-gray-400 mt-2 font-bold tracking-widest uppercase">Admin Workspace</p>
            </div>
            
            <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto">
                <!-- แดชบอร์ดภาพรวม -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3.5 rounded-2xl {{ request()->routeIs('admin.dashboard') ? 'bg-black text-white shadow-md' : 'text-gray-500 hover:text-black hover:bg-gray-50' }} transition-all group font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-4 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-black' }} transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    แดชบอร์ดภาพรวม
                </a>

                <!-- จัดการสินค้า -->
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3.5 rounded-2xl {{ request()->routeIs('admin.products.*') ? 'bg-black text-white shadow-md' : 'text-gray-500 hover:text-black hover:bg-gray-50' }} transition-all group font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-4 {{ request()->routeIs('admin.products.*') ? 'text-white' : 'text-gray-400 group-hover:text-black' }} transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                    </svg>
                    จัดการรถยนต์
                </a>

                <!-- จัดการรายการสั่งซื้อ -->
                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3.5 rounded-2xl {{ request()->routeIs('admin.orders.*') ? 'bg-black text-white shadow-md' : 'text-gray-500 hover:text-black hover:bg-gray-50' }} transition-all group font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-4 {{ request()->routeIs('admin.orders.*') ? 'text-white' : 'text-gray-400 group-hover:text-black' }} transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    คำสั่งซื้อรถยนต์
                </a>

                <!-- จัดการจองทดลองขับ -->
                <a href="{{ route('admin.test-drives.index') }}" class="flex items-center px-4 py-3.5 rounded-2xl {{ request()->routeIs('admin.test-drives.*') ? 'bg-black text-white shadow-md' : 'text-gray-500 hover:text-black hover:bg-gray-50' }} transition-all group font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-4 {{ request()->routeIs('admin.test-drives.*') ? 'text-white' : 'text-gray-400 group-hover:text-black' }} transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    คิวทดลองขับ
                </a>

                <!-- จัดการผู้ใช้ -->
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3.5 rounded-2xl {{ request()->routeIs('admin.users.*') ? 'bg-black text-white shadow-md' : 'text-gray-500 hover:text-black hover:bg-gray-50' }} transition-all group font-medium mt-6 border-t border-gray-100 pt-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-4 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-400 group-hover:text-black' }} transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    จัดการผู้ใช้งาน
                </a>
                
                <!-- หมายเหตุ: ลบเมนูจัดการผู้ดูแลระบบ (href="#") ออกไปแล้ว เพื่อให้มีเฉพาะปุ่มที่ใช้งานได้จริง -->
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-gray-50/50">
            <!-- Topbar (ปรับแต่งให้เนียนไปกับพื้นหลัง) -->
            <header class="h-24 bg-white/80 backdrop-blur-md flex items-center justify-between px-10 z-10 sticky top-0">
                <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">@yield('title', 'Dashboard')</h1>
                
                <div class="flex items-center gap-8">
                    <div class="flex items-center gap-4">
                        <!-- ไอคอนโปรไฟล์มินิมอล -->
                        <div class="w-11 h-11 rounded-full bg-gray-100 flex items-center justify-center text-black font-extrabold text-lg border border-gray-200 shadow-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="text-left hidden sm:block">
                            <p class="text-sm font-bold text-gray-900 leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] tracking-widest text-gray-400 uppercase font-bold mt-0.5">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    
                    <!-- ปุ่มออกจากระบบ -->
                    <form method="POST" action="{{ route('logout') }}" class="border-l border-gray-200 pl-8">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 text-gray-400 hover:text-black transition-colors font-bold uppercase tracking-widest text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <!-- พื้นที่แสดงเนื้อหาของแต่ละหน้า (Content) -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-10">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Script ตรวจสอบ Flash Message เพื่อแสดง SweetAlert2 แบบมินิมอล -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#000000', // เปลี่ยนปุ่มคอนเฟิร์มเป็นสีดำ
                confirmButtonText: 'ตกลง',
                customClass: {
                    popup: 'rounded-3xl'
                }
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
                confirmButtonColor: '#000000', 
                confirmButtonText: 'ตกลง',
                customClass: {
                    popup: 'rounded-3xl'
                }
            });
        });
    </script>
    @endif
</body>
</html>