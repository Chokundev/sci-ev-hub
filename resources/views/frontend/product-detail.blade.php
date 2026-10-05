<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesla Model 3 - SCI EV Hub</title>
    <!-- SEO & Meta Tags ที่แยกไฟล์ไว้ สามารถ include เข้ามาได้ เช่น @include('partials.meta') -->
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased overflow-x-hidden">

    <!-- Navbar (จำลอง) -->
    <nav class="fixed w-full z-50 glass-panel shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold tracking-tighter text-primary">SCI EV Hub</h1>
            <div class="space-x-4">
                <a href="#" class="text-gray-600 hover:text-primary">เข้าสู่ระบบ</a>
                <a href="#" class="bg-primary text-white px-6 py-2 rounded-full hover:bg-gray-800 transition">สร้างบัญชี</a>
            </div>
        </div>
    </nav>

    <!-- Header & 3D Model Section -->
    <section class="pt-32 pb-16 px-4 max-w-7xl mx-auto">
        <div class="flex flex-col lg:flex-row gap-12 items-center">
            
            <!-- ข้อมูลหลักของสินค้า -->
            <div class="w-full lg:w-1/3 space-y-6" data-aos="fade-right">
                <span class="inline-block px-4 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-sm">
                    พร้อมส่งมอบ
                </span>
                <h1 class="text-5xl font-bold tracking-tight">Tesla Model 3</h1>
                <p class="text-3xl text-gray-500">฿ 1,599,000</p>

                <!-- ปุ่มดำเนินการ -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button class="bg-primary text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:shadow-xl hover:bg-gray-800 transition-all w-full sm:w-auto text-center" onclick="buyNow()">
                        ซื้อทันที
                    </button>
                    <button class="border-2 border-primary text-primary px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-all w-full sm:w-auto text-center">
                        ทดลองขับ
                    </button>
                </div>
            </div>

            <!-- 3D Model Embed (โชว์จาก Database) -->
            <div class="w-full lg:w-2/3 glass-panel rounded-3xl p-4 shadow-xl" data-aos="fade-left">
                <!-- ส่วนนี้จำลองการดึงโค้ดฝังมาจาก {!! $product->embed_code !!} -->
                <div class="aspect-w-16 aspect-h-9 w-full rounded-2xl overflow-hidden h-[400px] md:h-[500px]">
                    <div class="sketchfab-embed-wrapper h-full w-full">
                        <iframe title="Tesla Model 3" class="w-full h-full" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/facc3ebd1e904161b6fb60c10b5747c7/embed"> </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- สเปคเด่นแบบการ์ด (Grid) -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center" data-aos="fade-up">
                <div class="glass-panel p-8 rounded-3xl shadow-sm hover:shadow-md transition">
                    <h3 class="text-4xl font-bold text-primary mb-2">4.4 วินาที</h3>
                    <p class="text-gray-500">อัตราเร่ง 0-100 กม./ชม.</p>
                </div>
                <div class="glass-panel p-8 rounded-3xl shadow-sm hover:shadow-md transition">
                    <h3 class="text-4xl font-bold text-primary mb-2">629 กม.</h3>
                    <p class="text-gray-500">ระยะทางสูงสุดต่อการชาร์จ (WLTP)</p>
                </div>
                <div class="glass-panel p-8 rounded-3xl shadow-sm hover:shadow-md transition">
                    <h3 class="text-4xl font-bold text-primary mb-2">201 กม./ชม.</h3>
                    <p class="text-gray-500">ความเร็วสูงสุด</p>
                </div>
            </div>
        </div>
    </section>

    <!-- แถบข้อมูลไฮไลต์เพิ่มเติม (Zig-zag Layout) -->
    <section class="py-24 space-y-24 max-w-7xl mx-auto px-4 overflow-hidden">
        
        <!-- ระบบ Autopilot (รูปขวา ข้อความซ้าย) -->
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="w-full lg:w-1/2" data-aos="fade-right">
                <h2 class="text-3xl font-bold mb-4">ระบบ Autopilot อันชาญฉลาด</h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    ให้ทุกการเดินทางของคุณปลอดภัยและผ่อนคลายยิ่งขึ้นด้วยระบบประมวลผลวิชั่นที่ล้ำสมัย ตรวจจับสภาพแวดล้อมรอบคัน 360 องศา ช่วยควบคุมพวงมาลัย อัตราเร่ง และเบรกอัตโนมัติ
                </p>
            </div>
            <div class="w-full lg:w-1/2" data-aos="fade-left">
                <div class="bg-gray-200 h-64 md:h-96 rounded-3xl w-full object-cover">
                    <!-- ใส่รูปภาพ หรือวิดีโอตรงนี้ -->
                </div>
            </div>
        </div>

        <!-- ความปลอดภัย (รูปซ้าย ข้อความขวา) -->
        <div class="flex flex-col lg:flex-row-reverse items-center gap-16">
            <div class="w-full lg:w-1/2" data-aos="fade-left">
                <h2 class="text-3xl font-bold mb-4">มาตรฐานความปลอดภัยระดับโลก (Safety)</h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    โครงสร้างแข็งแกร่งพิเศษ ออกแบบมาเพื่อปกป้องผู้โดยสารในทุกสถานการณ์ จุดศูนย์ถ่วงต่ำช่วยลดความเสี่ยงในการพลิกคว่ำ พร้อมถุงลมนิรภัยรอบคัน
                </p>
            </div>
            <div class="w-full lg:w-1/2" data-aos="fade-right">
                <div class="bg-gray-200 h-64 md:h-96 rounded-3xl w-full object-cover">
                    <!-- ใส่รูปภาพ หรือวิดีโอตรงนี้ -->
                </div>
            </div>
        </div>

    </section>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // เริ่มต้นการทำงานของ AOS Animation
        AOS.init({
            duration: 800,
            once: true,
        });

        // ตัวอย่างการเรียกใช้ SweetAlert2 สำหรับปุ่มซื้อ
        function buyNow() {
            Swal.fire({
                title: 'กรุณาเข้าสู่ระบบ',
                text: 'คุณต้องเข้าสู่ระบบสมาชิกก่อนทำรายการสั่งซื้อ',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#1a1a1a',
                cancelButtonColor: '#d33',
                confirmButtonText: 'เข้าสู่ระบบ',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // เปลี่ยนหน้าไปยังหน้า Login
                    window.location.href = '/login'; 
                }
            })
        }
    </script>
</body>
</html>