<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดต่อเรา - SCI EV Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black font-sans antialiased selection:bg-black selection:text-white">

    <!-- Navbar แบบมินิมอล -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-[1440px] mx-auto px-6 py-6 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-gray-500 hover:text-black transition-colors text-sm font-medium tracking-wide uppercase group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transform transition-transform group-hover:-translate-x-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                Back to Home
            </a>
            <span class="text-xl md:text-2xl font-bold tracking-[0.2em] uppercase absolute left-1/2 transform -translate-x-1/2">
                SCI EV Hub
            </span>
            <div class="w-20"></div> <!-- Placeholder รักษาสมดุล -->
        </div>
    </nav>

    <main class="max-w-[1440px] mx-auto px-6 py-16 md:py-24">
        
        <!-- Header Section -->
        <div class="text-center mb-16 md:mb-24">
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight mb-6 uppercase">Get in Touch</h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed">
                มีข้อสงสัยเกี่ยวกับการจองรถยนต์ไฟฟ้า หรือต้องการสอบถามข้อมูลเพิ่มเติม? <br class="hidden md:block">
                ทีมงาน SCI EV Hub ยินดีให้คำปรึกษาและบริการคุณอย่างเต็มที่
            </p>
        </div>

        <!-- Contact Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-start">
            
            <!-- ฝั่งซ้าย: ข้อมูลการติดต่อ -->
            <div>
                <h2 class="text-3xl font-extrabold mb-8 tracking-tight">Contact Information</h2>
                
                <div class="space-y-10">
                    <!-- ที่อยู่ -->
                    <div class="flex items-start gap-6">
                        <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center flex-shrink-0 text-black border border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-2">Visit Us</h3>
                            <p class="text-lg font-bold text-gray-900 mb-1">คณะวิทยาศาสตร์และเทคโนโลยี</p>
                            <p class="text-gray-600 leading-relaxed">มหาวิทยาลัยเทคโนโลยีราชมงคลพระนคร<br>ศูนย์พระนครเหนือ ถ.ประชาราษฎร์ สาย 1</p>
                        </div>
                    </div>

                    <!-- เบอร์โทร -->
                    <div class="flex items-start gap-6">
                        <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center flex-shrink-0 text-black border border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.864-1.048l-3.413-.55m-1.046-3.238l-3.414-.55a1.125 1.125 0 0 0-1.15.541l-1.04 1.815c-1.92-1.03-3.57-2.68-4.6-4.6l1.815-1.04a1.125 1.125 0 0 0 .541-1.15l-.55-3.413a1.125 1.125 0 0 0-1.048-.864l-1.372 0A2.25 2.25 0 0 0 2.25 6.75Z" /></svg>
                        </div>
                        <div>
                            <h3 class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-2">Call Us</h3>
                            <p class="text-lg font-bold text-gray-900">02-665-3777</p>
                            <p class="text-gray-500 text-sm mt-1">จันทร์ - ศุกร์, 08:30 - 16:30 น.</p>
                        </div>
                    </div>

                    <!-- อีเมล -->
                    <div class="flex items-start gap-6">
                        <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center flex-shrink-0 text-black border border-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                        </div>
                        <div>
                            <h3 class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-2">Email Us</h3>
                            <a href="mailto:info.sci@rmutp.ac.th" class="text-lg font-bold text-gray-900 hover:text-gray-600 transition-colors border-b-2 border-transparent hover:border-black">info.sci@rmutp.ac.th</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ฝั่งขวา: แบบฟอร์มติดต่อ -->
            <div class="bg-gray-50 rounded-3xl p-8 md:p-12 border border-gray-100">
                <h3 class="text-2xl font-extrabold mb-8 tracking-tight">Send a Message</h3>
                
                <form action="#" method="POST" class="space-y-6" onsubmit="event.preventDefault(); alert('ส่งข้อความสำเร็จ! ทีมงานจะรีบติดต่อกลับโดยเร็วที่สุด');">
                    <!-- ในอนาคตสามารถใส่ action ไปที่ Controller สำหรับส่งอีเมลได้ -->
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ชื่อ - นามสกุล</label>
                            <input type="text" required class="w-full px-5 py-4 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">อีเมลติดต่อ</label>
                            <input type="email" required class="w-full px-5 py-4 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">หัวข้อเรื่อง</label>
                        <select class="w-full px-5 py-4 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium appearance-none">
                            <option value="">โปรดเลือกหัวข้อ</option>
                            <option value="test-drive">สอบถามเรื่องการทดลองขับ</option>
                            <option value="order">สอบถามสถานะการสั่งจอง</option>
                            <option value="partnership">ติดต่อร่วมธุรกิจ / พาร์ทเนอร์</option>
                            <option value="other">เรื่องอื่นๆ</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold tracking-widest text-gray-500 uppercase mb-2">ข้อความ</label>
                        <textarea rows="4" required class="w-full px-5 py-4 bg-white border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition font-medium resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full px-8 py-4 bg-black text-white font-bold rounded-full hover:bg-gray-800 shadow-lg hover:shadow-xl transition-all uppercase tracking-widest text-sm mt-4">
                        Submit Message
                    </button>
                </form>
            </div>

        </div>

        <!-- แผนที่ Google Maps -->
        <div class="mt-24 rounded-3xl overflow-hidden border border-gray-200 shadow-sm h-[400px]">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1m2!1s0x30e29b71bc297371%3A0x6b86d63428d052fc!2z4LiE4LiT4Liw4Lin4Li04LiX4Lii4Liy4Lio4Liy4Liq4LiV4Lij4LmN4Lil4Liw4LmA4LiX4LiE4LmC4LiZ4LmC4Lil4Lii4Li1!5e0!3m2!1sth!2sth!4v1700000000000!5m2!1sth!2sth" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </main>

    <!-- เรียกใช้ Footer ที่เราปรับปรุงไว้ (ถ้ามีไฟล์ partials/footer.blade.php) -->
    @include('partials.footer')

</body>
</html>