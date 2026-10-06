<!DOCTYPE html>
<html lang="th">

<head>
    <title>{{ $product->name }} - SCI EV Hub</title>
    @include('partials.meta')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-white text-gray-900 font-sans antialiased overflow-x-hidden">

    <nav class="fixed top-0 w-full z-40 bg-transparent">
        <!-- ใช้ grid grid-cols-3 เพื่อแบ่งพื้นที่ ซ้าย-กลาง-ขวา ให้เท่ากันเป๊ะ -->
        <div class="max-w-[1440px] mx-auto px-6 py-6 grid grid-cols-3 items-center">

            <!-- ฝั่งซ้าย: ปุ่ม Menu -->
            <div class="flex justify-start">
                <button onclick="openMenu()" class="flex items-center gap-2 text-back hover:text-gray-500 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- ข้อความ Menu จะซ่อนในมือถือ และโชว์ในจอใหญ่ขึ้นไป -->
                    <span class="text-sm font-medium tracking-wide hidden sm:block">Menu</span>
                </button>
            </div>

            <div class="flex justify-center text-center">
                <!-- ลบแท็ก <a> โลโก้ออกไปแล้ว -->
            </div>

            <!-- ฝั่งขวา: ไอคอน Account -->
            <div class="flex justify-end">
                <a href="{{ Auth::check() ? route('dashboard') : route('login') }}" class="text-back hover:text-gray-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </a>
            </div>

        </div>
    </nav>

    <!-- พื้นหลังสีดำตอนเปิดเมนู (Backdrop) -->
    <div id="menuBackdrop" onclick="closeMenu()" class="fixed inset-0 bg-black/80 z-[90] opacity-0 pointer-events-none transition-opacity duration-300">
        <!-- ปุ่มปิด (X) ตรงพื้นที่สีดำมุมขวาบน -->
        <button onclick="closeMenu()" class="absolute top-8 right-8 w-12 h-12 flex items-center justify-center bg-white/10 hover:bg-white/20 rounded-full text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- แผงเมนูหลัก (สไลด์จากซ้ายไปขวา) -->
    <div id="sideMenu" class="fixed top-0 left-0 bottom-0 z-[100] w-full md:w-[85%] lg:w-[75%] max-w-[1000px] bg-white flex flex-col md:flex-row transform -translate-x-full transition-transform duration-500 ease-[cubic-bezier(0.19,1,0.22,1)] shadow-2xl">

        <!-- ฝั่งซ้าย: ลิงก์เมนู (พื้นหลังสีขาว) -->
        <div class="w-full md:w-[40%] bg-white h-full overflow-y-auto py-8 md:py-12 px-8 flex flex-col border-r border-gray-100">
            <div class="flex flex-col space-y-1">
                <a href="/" class="flex items-center justify-between py-4 text-[17px] font-medium text-black hover:bg-gray-50 px-4 -mx-4 transition-colors">
                    หน้าแรก
                </a>
                <a href="#" class="flex items-center justify-between py-4 text-[17px] font-medium text-black hover:bg-gray-50 px-4 -mx-4 transition-colors">
                    เทคโนโลยี EV
                </a>
                <a href="#" class="flex items-center justify-between py-4 text-[17px] font-medium text-black hover:bg-gray-50 px-4 -mx-4 transition-colors">
                    จองคิวทดลองขับ
                </a>
                <a href="#" class="flex items-center justify-between py-4 text-[17px] font-medium text-black hover:bg-gray-50 px-4 -mx-4 transition-colors">
                    สั่งจองรถยนต์
                </a>
                <a href="#" class="flex items-center justify-between py-4 text-[17px] font-medium text-black hover:bg-gray-50 px-4 -mx-4 transition-colors">
                    ติดต่อเรา
                </a>
            </div>

            <!-- โซนบัญชีผู้ใช้ (ด้านล่างสุด) -->
            <div class="mt-auto pt-10">
                <div class="flex items-center gap-2 mb-4 text-gray-900 font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Account
                </div>
                <div class="flex flex-col space-y-4 pl-7 text-[15px]">
                    @auth
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-black transition-colors">แผงควบคุม (Admin)</a>
                    @else
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-black transition-colors">แผงควบคุมลูกค้า</a>
                    <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-black transition-colors">ตั้งค่าโปรไฟล์</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 transition-colors">ออกจากระบบ</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-black transition-colors">เข้าสู่ระบบ</a>
                    <a href="{{ route('register') }}" class="text-gray-600 hover:text-black transition-colors">สร้างบัญชี</a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- ฝั่งขวา: รายการรถยนต์เรียงแนวตั้ง (พื้นหลังสีเทาอ่อน) -->
        <!-- ซ่อนในจอมือถือ (hidden) และแสดงในจอใหญ่ (md:flex) -->
        <div class="hidden md:flex w-[60%] bg-[#f9f9f9] h-full overflow-y-auto py-12 px-12 flex-col items-center">
            <div class="w-full max-w-sm flex flex-col gap-16 pb-20">

                @if(isset($products))
                @foreach($products as $item)
                @php
                $menuImg = $item->image_url;
                if ($menuImg && !str_starts_with($menuImg, 'http')) {
                $menuImg = asset('storage/' . $menuImg);
                }
                @endphp
                <!-- การ์ดรถแต่ละคัน -->
                <a href="{{ route('product.detail', $item->id) }}" class="flex flex-col items-center group text-center block">
                    <h3 class="text-[19px] font-medium text-black mb-6">{{ $item->name }}</h3>
                    <img src="{{ $menuImg }}" alt="{{ $item->name }}" class="w-full h-auto object-contain mb-5 drop-shadow-sm transition-transform duration-500 group-hover:scale-[1.03]">
                    <span class="px-3 py-1 bg-white border border-gray-200 text-[11px] text-gray-500 font-medium tracking-wider">
                        {{ $item->energy_type ?? 'Electric' }}
                    </span>
                </a>
                @endforeach
                @endif

            </div>
        </div>
    </div>

    <!-- Main Product Hero -->
    <section class="relative pt-24 pb-16 px-4 w-full min-h-[85vh] flex flex-col items-center justify-center overflow-hidden">

        <!-- ปุ่มกลับหน้าหลัก -->
        <div class="absolute top-28 left-4 md:left-12 z-20" data-aos="fade-right">
            <a href="/" class="inline-flex items-center gap-2 text-gray-400 hover:text-gray-900 transition-colors font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                กลับ
            </a>
        </div>

        <!-- ตัวหนังสือลายน้ำพื้นหลังขนาดใหญ่ -->
        @php
        // ดึงคำแรกของชื่อรุ่นมาทำเป็นลายน้ำพื้นหลัง เช่น "Tesla Model 3" ได้คำว่า "Tesla"
        $watermarkText = explode(' ', trim($product->name))[0];
        @endphp
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-0">
            <h1 class="text-[12rem] md:text-[20rem] font-black text-gray-50 whitespace-nowrap tracking-tighter select-none">
                {{ strtoupper($watermarkText) }}
            </h1>
        </div>

        <!-- รูปภาพรถยนต์หลัก และ ปุ่ม 360 -->
        <div class="relative z-10 w-full max-w-5xl mx-auto mt-12 mb-10" data-aos="zoom-in" data-aos-duration="1200">
            @php
            $detailImg = $product->image_url;
            if ($detailImg && !str_starts_with($detailImg, 'http')) {
            $detailImg = asset('storage/' . $detailImg);
            }
            @endphp
            <img src="{{ $detailImg }}" alt="{{ $product->name }}" class="w-full h-auto object-contain ...">

            <!-- ปุ่มเปิด 3D Modal (แสดงเฉพาะเมื่อมีโค้ด embed) -->
            @if($product->embed_code)
            <button onclick="openModal360()" class="absolute bottom-4 right-4 md:bottom-12 md:right-12 bg-white/90 backdrop-blur-md border border-gray-200 text-gray-900 px-5 py-3 rounded-full shadow-xl hover:bg-gray-900 hover:text-white transition-all duration-300 flex items-center gap-2 group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 group-hover:rotate-180 transition-transform duration-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                <span class="font-semibold">ดูแบบ 360°</span>
            </button>
            @endif
        </div>

        <!-- ข้อมูลสินค้า (ด้านล่างภาพ) -->
        <div class="text-center z-10 relative space-y-6" data-aos="fade-up" data-aos-delay="200">
            <!-- แถบประเภทพลังงาน -->
            <div class="flex justify-center gap-3">
                @if($product->energy_type)
                <span class="px-5 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">{{ $product->energy_type }}</span>
                @endif
                @if($product->status_badge)
                <span class="px-5 py-1.5 bg-gray-900 text-white rounded-full text-sm font-medium">{{ $product->status_badge }}</span>
                @endif
            </div>

            <!-- ชื่อรุ่นและราคา -->
            <h2 class="text-5xl md:text-6xl font-bold text-gray-900 tracking-tight">{{ $product->name }}</h2>
            <p class="text-2xl font-light text-gray-500">฿ {{ number_format($product->price, 0) }}</p>

            <p class="text-gray-500 max-w-2xl mx-auto mt-4 leading-relaxed px-4">
                {{ $product->description ?? $product->short_description }}
            </p>

            <!-- ปุ่มดำเนินการ -->
            <div class="flex flex-col sm:flex-row justify-center gap-4 pt-6 px-4">
                <!-- ส่ง ID รถยนต์ไปที่หน้าฟอร์มสั่งจอง -->
                <a href="{{ route('checkout.index', $product->id) }}" class="bg-gray-900 text-white px-10 py-3.5 rounded-full font-semibold shadow-lg hover:bg-black hover:shadow-xl transition-all text-center">
                    สั่งจองทันที
                </a>
                <!-- ปุ่มทดลองขับ เรียกใช้ฟังก์ชันแจ้งเตือนชั่วคราว -->
                <button onclick="showComingSoon(event)" class="bg-white border-2 border-gray-200 text-gray-900 px-10 py-3.5 rounded-full font-semibold hover:border-gray-900 transition-all">
                    ทดลองขับ
                </button>
            </div>
        </div>
    </section>

    <!-- สเปคเด่นแบบตารางด้านล่าง -->
    <section class="max-w-[1200px] mx-auto px-4 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12" data-aos="fade-up" data-aos-delay="300">
            <div class="bg-gray-50 p-8 rounded-3xl text-center hover:shadow-md transition duration-300">
                <h3 class="text-4xl font-bold text-gray-900 mb-2">{{ $product->accel_0_100 }}</h3>
                <p class="text-gray-500 uppercase tracking-wider text-sm">อัตราเร่ง 0-100 กม./ชม.</p>
            </div>
            <div class="bg-gray-50 p-8 rounded-3xl text-center hover:shadow-md transition duration-300">
                <h3 class="text-4xl font-bold text-gray-900 mb-2">{{ $product->max_range }}</h3>
                <p class="text-gray-500 uppercase tracking-wider text-sm">ระยะทางสูงสุดต่อการชาร์จ</p>
            </div>
            <div class="bg-gray-50 p-8 rounded-3xl text-center hover:shadow-md transition duration-300">
                <h3 class="text-4xl font-bold text-gray-900 mb-2">{{ $product->top_speed }}</h3>
                <p class="text-gray-500 uppercase tracking-wider text-sm">ความเร็วสูงสุด</p>
            </div>
        </div>
    </section>

    <!-- ==========================================
         360° Modal (หน้าต่าง Pop-up แสดงโมเดล 3D)
         ========================================== -->
    @if($product->embed_code)
    <div id="modal360" class="fixed inset-0 z-[100] bg-white/95 backdrop-blur-sm flex flex-col items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 p-4">

        <!-- ปุ่มปิด Modal -->
        <button onclick="closeModal360()" class="absolute top-6 right-6 md:top-8 md:right-8 text-gray-900 hover:text-red-500 p-2 transition-colors z-50 bg-gray-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="w-full max-w-6xl aspect-video md:aspect-[21/9] bg-transparent rounded-2xl overflow-hidden relative shadow-2xl border border-gray-200">
            @php
            // แปลงโค้ด Iframe ให้เล่นอัตโนมัติ ธีมสว่าง และซ่อน UI รกๆ
            $embedCode = $product->embed_code;
            $embedCode = preg_replace('/src="([^"]+)"/', 'src="$1' . (strpos($embedCode, '?') !== false ? '&' : '?') . 'autostart=1&ui_theme=light&ui_infos=0&ui_watermark=0&transparent=1"', $embedCode);
            @endphp

            <div class="w-full h-full [&>div]:!h-full [&>div>iframe]:!w-full [&>div>iframe]:!h-full [&>iframe]:!w-full [&>iframe]:!h-full">
                {!! $embedCode !!}
            </div>
        </div>

        <p class="text-gray-500 mt-6 text-sm md:text-base font-medium">ใช้เมาส์หรือนิ้วลากเพื่อหมุน ซูม เพื่อดูรายละเอียดรอบคัน</p>
    </div>
    @endif

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // ฟังก์ชันควบคุมหน้าต่าง 360 Modal
        function openModal360() {
            const modal = document.getElementById('modal360');
            if (modal) {
                modal.classList.remove('pointer-events-none');
                modal.classList.remove('opacity-0');
                document.body.style.overflow = 'hidden'; // ล็อกไม่ให้หน้าเว็บข้างหลังเลื่อนได้
            }
        }

        function closeModal360() {
            const modal = document.getElementById('modal360');
            if (modal) {
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
                document.body.style.overflow = 'auto'; // ปลดล็อกให้หน้าเว็บเลื่อนได้ปกติ
            }
        }
    </script>

    <script>
        function openMenu() {
            const menu = document.getElementById('sideMenu');
            const backdrop = document.getElementById('menuBackdrop');

            menu.classList.remove('-translate-x-full');
            backdrop.classList.remove('pointer-events-none', 'opacity-0');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            const menu = document.getElementById('sideMenu');
            const backdrop = document.getElementById('menuBackdrop');

            menu.classList.add('-translate-x-full');
            backdrop.classList.add('pointer-events-none', 'opacity-0');
            document.body.style.overflow = 'auto';
        }
    </script>
</body>

</html>