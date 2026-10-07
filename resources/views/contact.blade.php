<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดต่อเรา - SCI EV Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black font-sans antialiased selection:bg-black selection:text-white">

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

       <!-- แผนที่ Google Maps - แยกออกมาอยู่ด้านล่าง Grid และเพิ่ม margin-top ให้สมส่วน -->
       <div class="mt-16 md:mt-24 w-full h-[400px] md:h-[500px] bg-gray-100 rounded-3xl overflow-hidden shadow-sm relative group">
                
           <!-- โค้ด iframe ที่ซ่อมแซมแล้ว -->
           <iframe 
               src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.346193368016!2d100.50960337508586!3d13.818238695751905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29b9f54b53151%3A0x73d2b2a69752fd89!2z4Lio4Li54LiZ4Lii4LmM4Lie4Lij4Liw4LiZ4LiE4Lij4LmA4Lir4LiZ4Li34LitIOC4oeC4q-C4suC4p-C4tOC4l-C4ouC4suC4peC4seC4ouC5gOC4l-C4hOC5guC4meC5guC4peC4ouC4teC4o-C4suC4iuC4oeC4h-C4hOC4peC4nuC4o-C4sOC4meC4hOC4ow!5e0!3m2!1sth!2sth!4v1791389294076!5m2!1sth!2sth"
               class="absolute inset-0 w-full h-full object-cover grayscale opacity-80 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700 ease-in-out"
               style="border:0;" 
               allowfullscreen="" 
               loading="lazy" 
               referrerpolicy="no-referrer-when-downgrade">
           </iframe>
                
           <!-- ป้ายบอกพิกัดเล็กๆ -->
           <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-md px-5 py-3 rounded-2xl shadow-lg border border-gray-100 pointer-events-none transition-transform duration-500 group-hover:-translate-y-2 z-10">
               <p class="text-[10px] font-extrabold tracking-widest uppercase text-gray-500 mb-1">HQ Office</p>
               <p class="text-sm font-bold text-black">SCI EV Hub Center</p>
           </div>
       </div>
    </main>

    <!-- เรียกใช้ Footer ที่เราปรับปรุงไว้ (ถ้ามีไฟล์ partials/footer.blade.php) -->
    @include('partials.footer')

</body>
</html>