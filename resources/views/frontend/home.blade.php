<!DOCTYPE html>
<html lang="th">
<head>
    <title>SCI EV Hub - นวัตกรรมยานยนต์ไฟฟ้า</title>
    @include('partials.meta')
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600&display=swap" rel="stylesheet">
</head>
<body id="page-body" class="bg-gray-50 transition-colors duration-1000 ease-in-out font-sans antialiased overflow-x-hidden text-gray-900">

    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-40 bg-transparent">
        <div class="max-w-[1440px] mx-auto px-6 py-6 grid grid-cols-3 items-center">
            
            <div class="flex justify-start">
                <button onclick="openMenu()" class="flex items-center gap-2 text-white hover:text-gray-500 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <span class="text-sm font-medium tracking-wide hidden sm:block">Menu</span>
                </button>
            </div>

            <div class="flex justify-center text-center">
                <a href="{{ route('home') }}" id="mainLogo" class="text-xl md:text-2xl font-bold tracking-[0.2em] uppercase text-white hover:text-gray-300 transition-opacity duration-300">
                    SCI EV Hub
                </a>
            </div>
            
            <div class="flex justify-end">
                <a href="{{ Auth::check() ? route('dashboard') : route('login') }}" class="text-white hover:text-gray-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </a>
            </div>
            
        </div>
    </nav>

    <!-- Backdrop เมนู -->
    <div id="menuBackdrop" onclick="closeMenu()" class="fixed inset-0 bg-black/80 z-[90] opacity-0 pointer-events-none transition-opacity duration-300">
        <button onclick="closeMenu()" class="absolute top-8 right-8 w-12 h-12 flex items-center justify-center bg-white/10 hover:bg-white/20 rounded-full text-white transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- แผงเมนูหลัก -->
    <div id="sideMenu" class="fixed top-0 left-0 bottom-0 z-[100] w-full md:w-[90%] lg:w-[85%] max-w-[1200px] bg-white flex flex-col md:flex-row transform -translate-x-full transition-transform duration-500 ease-[cubic-bezier(0.19,1,0.22,1)] shadow-2xl">
        
        <!-- ฝั่งซ้าย: ลิงก์เมนู -->
        <div class="w-full md:w-[35%] bg-white h-full overflow-y-auto py-8 md:py-12 px-8 flex flex-col border-r border-gray-100">
            <div class="flex flex-col space-y-1">
                <a href="{{ route('home') }}" class="flex items-center justify-between py-4 text-[17px] font-medium text-black hover:bg-gray-50 px-4 -mx-4 transition-colors rounded-xl">
                    หน้าแรก
                </a>
                
                <button onclick="switchTab('modelsPanel', this)" class="tab-btn flex items-center justify-between py-4 text-[17px] font-medium text-black hover:bg-gray-50 px-4 -mx-4 transition-colors w-full text-left rounded-xl bg-gray-100">
                    รุ่นรถยนต์ทั้งหมด
                </button>
                
                <button onclick="switchTab('techPanel', this)" class="tab-btn flex items-center justify-between py-4 text-[17px] font-medium text-black hover:bg-gray-50 px-4 -mx-4 transition-colors w-full text-left rounded-xl">
                    เทคโนโลยี EV
                </button>
                
                <!-- อัปเดตลิงก์จริง -->
                <a href="{{ route('test-drive.index') }}" class="flex items-center justify-between py-4 text-[17px] font-medium text-black hover:bg-gray-50 px-4 -mx-4 transition-colors rounded-xl">
                    จองคิวทดลองขับ
                </a>
                <a href="{{ route('contact.index') }}" class="flex items-center justify-between py-4 text-[17px] font-medium text-black hover:bg-gray-50 px-4 -mx-4 transition-colors rounded-xl">
                    ติดต่อเรา
                </a>
            </div>

            <!-- โซนบัญชีผู้ใช้ -->
            <div class="mt-auto pt-10">
                <div class="flex items-center gap-2 mb-4 text-gray-900 font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
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

        <!-- ฝั่งขวา: พื้นที่แสดงเนื้อหา -->
        <div class="hidden md:flex w-[65%] bg-[#f9f9f9] h-full overflow-y-auto py-12 px-10 lg:px-20 flex-col items-center relative">
            <div id="modelsPanel" class="w-full max-w-sm flex flex-col gap-16 pb-20 transition-opacity duration-500">
                @if(isset($products))
                    @foreach($products as $item)
                        @php
                            $menuImg = $item->image_url;
                            if ($menuImg && !str_starts_with($menuImg, 'http')) {
                                $menuImg = asset('storage/' . $menuImg);
                            }
                        @endphp
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

            <div id="techPanel" class="w-full max-w-2xl pb-20 transition-opacity duration-500 hidden opacity-0 absolute top-12">
                <div class="mb-12">
                    <span class="text-xs font-bold tracking-widest uppercase text-gray-500 mb-2 block">Area 9 Innovation</span>
                    <h2 class="text-4xl font-extrabold text-black tracking-tight leading-tight mb-6">ขับเคลื่อนอนาคตด้วย<br>สถาปัตยกรรมไฟฟ้า 800V</h2>
                    <p class="text-gray-600 text-[16px] leading-relaxed">
                        หัวใจหลักของรถยนต์ไฟฟ้าใน SCI EV Hub คือการผสานเทคโนโลยีแบตเตอรี่ขั้นสูงเข้ากับมอเตอร์ประสิทธิภาพสูง เพื่อลบข้อจำกัดเดิมของยานยนต์ไฟฟ้า มอบระยะทางที่ไกลขึ้นและการชาร์จที่รวดเร็วที่สุด
                    </p>
                </div>
                <div class="grid grid-cols-1 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-black text-white rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-black mb-3">Ultra-Fast DC Charging</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            รองรับเทคโนโลยีการชาร์จไฟฟ้ากระแสตรง (DC Fast Charge) สูงสุด 350 kW ภายใต้สถาปัตยกรรม 800 โวลต์ สามารถชาร์จพลังงานจาก 10% ถึง 80% ได้ภายในเวลาเพียง 18 นาที
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-black text-white rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-2.25-1.313M21 7.5v2.25m0-2.25l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3l2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75l2.25-1.313M12 21.75V19.5m0 2.25l-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-black mb-3">LFP & NMC Battery Cell</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            ระบบจัดการแบตเตอรี่ (BMS) ขั้นสูง ควบคุมอุณหภูมิเซลล์แบตเตอรี่แบบ Liquid Cooling เพิ่มรอบอายุการใช้งาน (Cycle Life) ให้ยาวนานกว่า 1,500,000 กิโลเมตร และป้องกันความร้อนสะสม
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-black text-white rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-black mb-3">Regenerative Braking</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            ระบบดึงพลังงานจลน์จากการเบรกและการถอนคันเร่งกลับมาแปลงเป็นพลังงานไฟฟ้า ช่วยเพิ่มระยะทางขับขี่ (Range) ได้สูงสุดถึง 15-20% พร้อมรองรับระบบ One-Pedal Driving
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 1. Hero Section -->
    <section class="relative w-full h-screen flex items-center">
        <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?q=80&w=2000&auto=format&fit=crop" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>

        <div class="relative z-10 w-full max-w-[1400px] mx-auto px-4 md:px-8">
            <div class="max-w-3xl" data-aos="fade-right">
                <h1 class="text-6xl md:text-8xl font-bold text-white leading-tight mb-8">
                    The new <br>EV Generation.
                </h1>
                <a href="#discover-section" class="inline-block px-8 py-3 bg-white/10 backdrop-blur-sm border border-white/50 text-white rounded hover:bg-white hover:text-black transition-all duration-300 font-medium">
                    Discover now
                </a>
            </div>
        </div>
    </section>

    <!-- 2. โซนการ์ดไฮไลต์ 3 ใบ -->
    <div id="discover-section" class="pt-24 pb-12 relative z-20 transition-colors duration-1000">
        <section class="px-4 max-w-[1200px] mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold transition-colors duration-1000" id="explore-title" data-aos="fade-up">Explore the Future</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="100">
                <!-- Card 1: อัปเดตลิงก์จริง -->
                <a href="{{ route('charging.index') }}" class="group relative block h-64 md:h-72 rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1542362567-b07e54358753?q=80&w=1000&auto=format&fit=crop" alt="Accessories" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 flex justify-between items-end">
                        <h3 class="text-white font-semibold text-xl md:text-2xl w-2/3 leading-tight">EV Charging Solutions.</h3>
                        <div class="w-10 h-10 rounded-full border border-white/50 flex items-center justify-center text-white transition-colors group-hover:bg-white group-hover:text-black backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </div>
                    </div>
                </a>
                <!-- Card 2: อัปเดตลิงก์จริง -->
                <a href="{{ route('motorsport.index') }}" class="group relative block h-64 md:h-72 rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1619682817481-e994891cd1f5?q=80&w=1000&auto=format&fit=crop" alt="Motorsport" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 flex justify-between items-end">
                        <h3 class="text-white font-semibold text-xl md:text-2xl w-2/3 leading-tight">Future of Motorsport.</h3>
                        <div class="w-10 h-10 rounded-full border border-white/50 flex items-center justify-center text-white transition-colors group-hover:bg-white group-hover:text-black backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </div>
                    </div>
                </a>
                <!-- Card 3: อัปเดตลิงก์จริง -->
                <a href="{{ route('suv.index') }}" class="group relative block h-64 md:h-72 rounded-3xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1593941707882-a5bba14938c7?q=80&w=1000&auto=format&fit=crop" alt="SUV" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 flex justify-between items-end">
                        <h3 class="text-white font-semibold text-xl md:text-2xl w-2/3 leading-tight">New Electric SUV.</h3>
                        <div class="w-10 h-10 rounded-full border border-white/50 flex items-center justify-center text-white transition-colors group-hover:bg-white group-hover:text-black backdrop-blur-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    </div>

    <!-- 3. โซนการ์ดสินค้าหลัก -->
    <section id="product-trigger-section" class="pt-24 pb-24 px-4 w-full relative z-10">
        <div class="max-w-[1400px] mx-auto">
            
            <h2 id="journey-title" class="text-4xl md:text-5xl font-bold mb-16 text-center transition-colors duration-1000 text-gray-900" data-aos="fade-up">
                Your SCI EV journey starts now.
            </h2>

            @if(isset($products) && $products->count() > 0)
                <div class="flex flex-col gap-4 max-w-[1440px] mx-auto px-6 py-12">
                    @foreach($products->chunk(2) as $chunk)
                        <div class="flex flex-col md:flex-row w-full gap-4 h-[700px] md:h-[450px]">
                            @foreach($chunk as $product)
                                @php
                                    $cardImg = $product->card_image_url ?: $product->image_url;
                                    if ($cardImg && !str_starts_with($cardImg, 'http')) {
                                        $cardImg = asset('storage/' . $cardImg);
                                    } elseif (!$cardImg) {
                                        $cardImg = 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80';
                                    }
                                @endphp

                                <a href="{{ route('product.detail', $product->id) }}" class="relative flex-1 rounded-3xl overflow-hidden group cursor-pointer bg-black transition-all duration-[800ms] ease-[cubic-bezier(0.25,1,0.5,1)] hover:flex-[1.8] focus:outline-none">
                                    <img src="{{ $cardImg }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1000ms] ease-out group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80 transition-opacity duration-700 group-hover:opacity-100"></div>
                                    <div class="absolute bottom-0 left-0 w-full p-8 md:p-10 flex flex-col justify-end h-full z-10 text-white">
                                        <h3 class="text-4xl md:text-5xl font-bold tracking-tight mb-3 transform transition-transform duration-700 group-hover:-translate-y-2">{{ $product->name }}</h3>
                                        <div class="flex items-center gap-3 transform transition-transform duration-700 group-hover:-translate-y-2">
                                            @if($product->energy_type)
                                                <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm border border-white/30 rounded-md text-[11px] font-semibold tracking-wider uppercase">
                                                    {{ $product->energy_type }}
                                                </span>
                                            @endif
                                            <p class="text-gray-300 text-sm line-clamp-1">
                                                {{ $product->short_description ?? 'สัมผัสประสบการณ์การขับขี่แห่งอนาคต' }}
                                            </p>
                                        </div>
                                        <div class="absolute bottom-8 right-8 md:bottom-10 md:right-10 flex items-center gap-2 opacity-0 transform translate-x-8 transition-all duration-700 group-hover:opacity-100 group-hover:translate-x-0 font-medium text-white">
                                            Explore
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex items-center justify-center h-[30vh]">
                    <h2 class="text-xl text-gray-500">กำลังเตรียมข้อมูลยานยนต์ไฟฟ้ารุ่นใหม่...</h2>
                </div>
            @endif
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, offset: 100 });

        document.addEventListener("DOMContentLoaded", function() {
            const body = document.getElementById('page-body');
            const targetSection = document.getElementById('product-trigger-section');
            const titleExplore = document.getElementById('explore-title');
            const titleJourney = document.getElementById('journey-title');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        body.classList.remove('bg-gray-50');
                        body.classList.add('bg-[#121212]');
                        titleExplore.classList.remove('text-gray-900');
                        titleExplore.classList.add('text-white');
                        titleJourney.classList.remove('text-gray-900');
                        titleJourney.classList.add('text-white');
                    } else {
                        body.classList.add('bg-gray-50');
                        body.classList.remove('bg-[#121212]');
                        titleExplore.classList.add('text-gray-900');
                        titleExplore.classList.remove('text-white');
                        titleJourney.classList.add('text-gray-900');
                        titleJourney.classList.remove('text-white');
                    }
                });
            }, { threshold: 0.25 });

            if(targetSection) observer.observe(targetSection);
        });
    </script>
    
    @include('partials.footer')
    
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

        window.addEventListener('scroll', function() {
            const logo = document.getElementById('mainLogo');
            if (window.scrollY > 50) {
                logo.classList.add('opacity-0', 'pointer-events-none');
            } else {
                logo.classList.remove('opacity-0', 'pointer-events-none');
            }
        });

        function switchTab(panelId, btnElement) {
            const tabs = document.querySelectorAll('.tab-btn');
            tabs.forEach(tab => tab.classList.remove('bg-gray-100'));
            btnElement.classList.add('bg-gray-100');

            const modelsPanel = document.getElementById('modelsPanel');
            const techPanel = document.getElementById('techPanel');
            
            modelsPanel.classList.add('opacity-0');
            techPanel.classList.add('opacity-0');
            
            setTimeout(() => {
                modelsPanel.classList.add('hidden');
                techPanel.classList.add('hidden');
                
                const activePanel = document.getElementById(panelId);
                activePanel.classList.remove('hidden');
                
                setTimeout(() => {
                    activePanel.classList.remove('opacity-0');
                }, 50);
            }, 300);
        }
    </script>
</body>
</html>