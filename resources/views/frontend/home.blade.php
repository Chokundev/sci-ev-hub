<!DOCTYPE html>
<html lang="th">
<head>
    <title>SCI EV Hub - นวัตกรรมยานยนต์ไฟฟ้า</title>
    @include('partials.meta')
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased overflow-x-hidden">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass-panel shadow-sm transition-all duration-300 backdrop-blur-md bg-white/70">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold tracking-tighter text-primary flex items-center gap-2">
                <span class="text-accent text-3xl">⚡</span> SCI EV Hub
            </a>
            <div class="space-x-4 flex items-center">
                @auth
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'superadmin')
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-primary font-medium">เข้าสู่แผงควบคุม</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary font-medium">แผงควบคุมลูกค้า</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary font-medium">เข้าสู่ระบบ</a>
                    <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2 rounded-full hover:bg-gray-800 transition shadow-md font-medium">สร้างบัญชี</a>
                @endauth
            </div>
        </div>
    </nav>

    @if($product)
    <!-- Header & 3D Model Section -->
    <section class="pt-32 pb-16 px-4 max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row gap-12 items-center">
            
            <!-- ข้อมูลหลักของสินค้า -->
            <div class="w-full lg:w-1/3 space-y-6" data-aos="fade-right">
                <span class="inline-block px-4 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-sm shadow-sm">
                    {{ $product->status_badge }}
                </span>
                <h1 class="text-5xl md:text-6xl font-bold tracking-tight text-gray-900">{{ $product->name }}</h1>
                <p class="text-3xl font-light text-gray-500">฿ {{ number_format($product->price, 0) }}</p>

                <!-- ปุ่มดำเนินการ -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button class="bg-primary text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl hover:bg-gray-800 transition-all text-center" onclick="buyNow()">
                        ซื้อทันที
                    </button>
                    <button class="border-2 border-primary text-primary px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-all text-center">
                        ทดลองขับ
                    </button>
                </div>
            </div>

            <!-- 3D Model Embed -->
            <div class="w-full lg:w-2/3 glass-panel rounded-3xl p-4 shadow-xl border border-white/40 bg-white/40" data-aos="fade-left">
                <div class="w-full rounded-2xl overflow-hidden h-[400px] md:h-[550px] relative">
                    {!! $product->embed_code !!}
                </div>
            </div>
        </div>
    </section>

    <!-- สเปคเด่นแบบการ์ด -->
    <section class="py-16 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center" data-aos="fade-up">
                <div class="glass-panel p-8 rounded-3xl shadow-sm hover:shadow-md transition bg-gray-50/50">
                    <h3 class="text-4xl font-bold text-primary mb-2">{{ $product->accel_0_100 }}</h3>
                    <p class="text-gray-500 font-medium">อัตราเร่ง 0-100 กม./ชม.</p>
                </div>
                <div class="glass-panel p-8 rounded-3xl shadow-sm hover:shadow-md transition bg-gray-50/50">
                    <h3 class="text-4xl font-bold text-primary mb-2">{{ $product->max_range }}</h3>
                    <p class="text-gray-500 font-medium">ระยะทางสูงสุดต่อการชาร์จ</p>
                </div>
                <div class="glass-panel p-8 rounded-3xl shadow-sm hover:shadow-md transition bg-gray-50/50">
                    <h3 class="text-4xl font-bold text-primary mb-2">{{ $product->top_speed }}</h3>
                    <p class="text-gray-500 font-medium">ความเร็วสูงสุด</p>
                </div>
            </div>
        </div>
    </section>
    
    @else
    <!-- กรณีที่ยังไม่มีข้อมูลสินค้าในระบบ -->
    <section class="pt-40 pb-16 px-4 text-center min-h-screen">
        <h2 class="text-2xl text-gray-500">กำลังเตรียมข้อมูลยานยนต์ไฟฟ้ารุ่นใหม่...</h2>
    </section>
    @endif

    <!-- แถบข้อมูลไฮไลต์เพิ่มเติม -->
    <section class="py-24 space-y-24 max-w-7xl mx-auto px-4 overflow-hidden">
        <!-- ระบบ Autopilot -->
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="w-full lg:w-1/2" data-aos="fade-right">
                <h2 class="text-3xl font-bold mb-4">ระบบ Autopilot อันชาญฉลาด</h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    ให้ทุกการเดินทางของคุณปลอดภัยและผ่อนคลายยิ่งขึ้นด้วยระบบประมวลผลวิชั่นที่ล้ำสมัย ตรวจจับสภาพแวดล้อมรอบคัน 360 องศา ช่วยควบคุมพวงมาลัย อัตราเร่ง และเบรกอัตโนมัติ
                </p>
            </div>
            <div class="w-full lg:w-1/2" data-aos="fade-left">
                <div class="bg-gray-200 h-64 md:h-96 rounded-3xl w-full shadow-lg overflow-hidden flex items-center justify-center bg-gradient-to-tr from-cyan-100 to-blue-50">
                    <span class="text-gray-400">ภาพประกอบ Autopilot</span>
                </div>
            </div>
        </div>

        <!-- ความปลอดภัย -->
        <div class="flex flex-col lg:flex-row-reverse items-center gap-16">
            <div class="w-full lg:w-1/2" data-aos="fade-left">
                <h2 class="text-3xl font-bold mb-4">มาตรฐานความปลอดภัยระดับโลก (Safety)</h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    โครงสร้างแข็งแกร่งพิเศษ ออกแบบมาเพื่อปกป้องผู้โดยสารในทุกสถานการณ์ จุดศูนย์ถ่วงต่ำช่วยลดความเสี่ยงในการพลิกคว่ำ พร้อมโครงสร้างแบตเตอรี่ที่ช่วยซับแรงกระแทก
                </p>
            </div>
            <div class="w-full lg:w-1/2" data-aos="fade-right">
                <div class="bg-gray-200 h-64 md:h-96 rounded-3xl w-full shadow-lg overflow-hidden flex items-center justify-center bg-gradient-to-tl from-gray-100 to-gray-200">
                    <span class="text-gray-400">ภาพประกอบ Safety & Battery</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // เริ่มต้นการทำงานของ AOS Animation
        AOS.init({ duration: 800, once: true });

        // ฟังก์ชันเมื่อกดปุ่มซื้อทันที
        function buyNow() {
            var isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
            
            if (isAuthenticated) {
                // สร้างฟอร์มซ่อนขึ้นมาเพื่อส่ง POST request ไปสร้าง Order
                var form = document.createElement('form');
                form.method = 'POST';
                // ใส่ route checkout พร้อมแนบ id สินค้าคันปัจจุบันไป
                form.action = "{{ route('checkout.store', $product->id ?? 0) }}"; 
                
                // เพิ่ม CSRF Token ป้องกันความปลอดภัย (สำคัญมากใน Laravel)
                var csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = "{{ csrf_token() }}";
                
                form.appendChild(csrfInput);
                document.body.appendChild(form);
                form.submit(); // สั่ง Submit ฟอร์มทันที
            } else {
                // ถ้ายังไม่ล็อกอิน ให้แสดง SweetAlert2
                Swal.fire({
                    title: 'กรุณาเข้าสู่ระบบ',
                    text: 'คุณต้องเข้าสู่ระบบสมาชิกก่อนทำรายการสั่งซื้อรถยนต์',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#1a1a1a',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'เข้าสู่ระบบ',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('login') }}";
                    }
                });
            }
        }
    </script>
</body>
</html>