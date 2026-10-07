<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charging - SCI EV Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- เพิ่ม AOS CSS สำหรับแอนิเมชัน -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-900 font-sans antialiased selection:bg-black selection:text-white overflow-x-hidden">

    <!-- Navbar แบบ Responsive (มือถือ 2 บรรทัด / คอม 1 บรรทัด) -->
<nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 md:px-6 h-20 flex items-center justify-between relative">

        <!-- ฝั่งซ้าย: ปุ่มย้อนกลับ -->
        <a href="/" class="flex items-center gap-2 md:gap-3 text-gray-500 hover:text-black transition-colors relative z-10">
            <!-- ไอคอนลูกศร -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            <!-- ข้อความ: มือถือขึ้นบรรทัดใหม่ / คอมบรรทัดเดียว -->
            <span class="text-[13px] font-bold leading-tight tracking-wide text-left">
                กลับสู่หน้า<br class="block md:hidden">หลัก
            </span>
        </a>

        <!-- ตรงกลาง: โลโก้ -->
        <div class="absolute left-1/2 transform -translate-x-1/2 text-center pointer-events-auto w-max">
            <a href="/" class="block">
                <!-- ข้อความ: มือถือขึ้นบรรทัดใหม่ / คอมบรรทัดเดียวและเว้นวรรค -->
                <h1 class="text-[17px] md:text-[20px] font-extrabold text-[#0f172a] tracking-[0.15em] leading-tight uppercase text-center">
                    SCI EV<br class="block md:hidden"><span class="hidden md:inline"> </span>HUB
                </h1>
            </a>
        </div>

        <!-- ฝั่งขวา: กล่องเปล่าเพื่อดันให้โลโก้อยู่ตรงกลางสมบูรณ์ -->
        <div class="w-16 md:w-24"></div>

    </div>
</nav>

    <main>
        <!-- Hero Section แบบเต็มจอ (Full Screen) -->
        <section class="relative w-full h-screen flex items-center justify-center overflow-hidden bg-gray-900">
            <!-- รูปภาพแบคกราวด์แบบเต็มจอ ขยายเต็มพื้นที่ -->
            <img src="https://www.brandbuffet.in.th/wp-content/uploads/2022/02/shutterstock_home-ev-charging.jpg" 
                 alt="EV Charging" 
                 class="absolute inset-0 w-full h-full object-cover object-center"
                 data-aos="zoom-out" data-aos-duration="2000">
            
            <!-- ไล่ระดับความมืดของเงาเพื่อให้ตัวหนังสืออ่านง่ายและดูมีมิติ -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
            
            <!-- ข้อความกึ่งกลางจอแบบสมมาตร -->
            <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-6 drop-shadow-lg" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    พลังงานที่ไปกับคุณทุกที่
                </h1>
                <p class="text-lg md:text-xl text-gray-200 font-light max-w-2xl mx-auto drop-shadow-md leading-relaxed" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    ไร้กังวลเรื่องแบตเตอรี่ ด้วยโซลูชันการชาร์จที่ออกแบบมาเพื่อไลฟ์สไตล์ของคุณโดยเฉพาะ ทั้งที่บ้านและบนท้องถนน
                </p>
            </div>
        </section>


        <!-- โซนเนื้อหา -->
        <section class="max-w-6xl mx-auto px-6 py-32 md:py-48">
            
            <!-- บล็อกที่ 1: ชาร์จไฟบ้าน -->
            <div class="flex flex-col md:flex-row items-center gap-16 md:gap-24 mb-40 overflow-hidden">
                <div class="w-full md:w-1/2 flex flex-col justify-center" data-aos="fade-right" data-aos-duration="1000">
                    <p class="text-xs font-bold tracking-widest text-gray-400 uppercase mb-3">At Home</p>
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-6">ชาร์จง่ายๆ เหมือนสมาร์ทโฟน</h2>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        เริ่มต้นเช้าวันใหม่ด้วยแบตเตอรี่เต็ม 100% เสมอ เครื่องชาร์จ SCI Wallbox ติดตั้งง่าย ดีไซน์มินิมอลเข้ากับตัวบ้าน และมีระบบตัดไฟอัตโนมัติเพื่อความปลอดภัยสูงสุด
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="mt-1 w-1.5 h-1.5 rounded-full bg-black flex-shrink-0"></div>
                            <p class="text-sm text-gray-700">ติดตั้งฟรี! โดยทีมวิศวกรไฟฟ้ามืออาชีพ</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="mt-1 w-1.5 h-1.5 rounded-full bg-black flex-shrink-0"></div>
                            <p class="text-sm text-gray-700">ชาร์จเร็วทันใจด้วยกำลังไฟสูงสุด 22kW</p>
                        </div>
                    </div>
                </div>
                
                <div class="w-full md:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="rounded-2xl overflow-hidden aspect-[4/3] bg-gray-100 shadow-xl">
                        <img src="https://phithangreen.com/wp-content/uploads/2024/04/%E0%B8%A3%E0%B8%96%E0%B8%A2%E0%B8%99%E0%B8%95%E0%B9%8C%E0%B9%84%E0%B8%9F%E0%B8%9F%E0%B9%89%E0%B8%B2%E0%B9%84%E0%B8%AE%E0%B8%9A%E0%B8%A3%E0%B8%B4%E0%B8%94-EV-%E0%B8%81%E0%B8%B3%E0%B8%A5%E0%B8%B1%E0%B8%87%E0%B8%8A%E0%B8%B2%E0%B8%A3%E0%B9%8C%E0%B8%88%E0%B9%84%E0%B8%9F%E0%B8%88%E0%B8%B2%E0%B8%81-Wallbox-%E0%B9%83%E0%B8%99%E0%B8%9A%E0%B9%89%E0%B8%B2%E0%B8%99.jpg" 
                             alt="Home Wallbox" 
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                    </div>
                </div>
            </div>

            <!-- บล็อกที่ 2: ชาร์จสาธารณะ -->
            <div class="flex flex-col md:flex-row-reverse items-center gap-16 md:gap-24 overflow-hidden">
                <div class="w-full md:w-1/2 flex flex-col justify-center" data-aos="fade-left" data-aos-duration="1000">
                    <p class="text-xs font-bold tracking-widest text-gray-400 uppercase mb-3">On the Go</p>
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-6">เครือข่ายชาร์จไวทั่วประเทศ</h2>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        เดินทางไกลแค่ไหนก็อุ่นใจ ด้วยสถานีชาร์จแบบ DC Fast Charge แวะจิบกาแฟไม่ถึง 20 นาที แบตเตอรี่ก็พร้อมลุยต่อได้อีกหลายร้อยกิโลเมตร
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="mt-1 w-1.5 h-1.5 rounded-full bg-black flex-shrink-0"></div>
                            <p class="text-sm text-gray-700">รองรับระบบ Plug & Charge เสียบปุ๊บชาร์จปั๊บ</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="mt-1 w-1.5 h-1.5 rounded-full bg-black flex-shrink-0"></div>
                            <p class="text-sm text-gray-700">ค้นหาสถานีและจองคิวล่วงหน้าผ่านจอรถยนต์ได้เลย</p>
                        </div>
                    </div>
                </div>
                
                <div class="w-full md:w-1/2" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
                    <div class="rounded-2xl overflow-hidden aspect-[4/3] bg-gray-100 shadow-xl">
                        <img src="https://static.thairath.co.th/media/PZnhTOtr5D3rd9oc9L1vyXJ9uQX57Q15sssJEQqxdh9zUMG.jpg" 
                             alt="Public Charging Station" 
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                    </div>
                </div>
            </div>

        </section>

        <!-- CTA Section -->
        <section class="w-full bg-[#f8f9fa] py-32 border-t border-gray-100">
            <div class="max-w-3xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-6 text-black">ต้องการติดตั้งเครื่องชาร์จที่บ้าน?</h2>
                <p class="text-gray-500 mb-10 leading-relaxed">
                    ให้ผู้เชี่ยวชาญของเราช่วยประเมินระบบไฟที่บ้านคุณฟรี ไม่มีค่าใช้จ่ายแอบแฝง พร้อมให้คำแนะนำเพื่อความปลอดภัยของครอบครัวคุณ
                </p>
                <a href="/contact" class="inline-block px-10 py-4 bg-black text-white text-sm font-bold tracking-wide uppercase rounded-full hover:bg-gray-800 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                    ติดต่อนัดหมายวิศวกร
                </a>
            </div>
        </section>
    </main>

    <!-- เพิ่ม AOS JS สคริปต์ -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // เริ่มต้นการทำงานของแอนิเมชัน
        AOS.init({
            once: true, // กำหนดให้เล่นแอนิเมชันแค่ครั้งเดียวตอนเลื่อนลงมาเจอ (ไม่เล่นซ้ำตอนเลื่อนกลับ)
            offset: 100, // เลื่อนลงมาให้เห็นองค์ประกอบ 100px ก่อนค่อยเล่นแอนิเมชัน
            easing: 'ease-out-cubic', // รูปแบบความสมูทของการเคลื่อนไหว
        });
    </script>
</body>
</html>