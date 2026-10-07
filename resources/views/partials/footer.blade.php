<!-- Footer Section -->
    <footer class="bg-white border-t border-gray-200 mt-24">
        <div class="max-w-[1440px] mx-auto px-6 pt-16 pb-8">
            
            <!-- Grid แบ่งเนื้อหาเป็น 4 ส่วนหลัก -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 mb-16">
                
                <!-- คอลัมน์ 1: Stay Connected (กินพื้นที่กว้างสุด) -->
                <div class="lg:col-span-4 pr-4">
                    <h2 class="text-[40px] font-extrabold text-black mb-4 leading-tight">Stay<br>Connected</h2>
                    <p class="text-gray-500 mb-6 text-[15px] leading-relaxed max-w-sm">
                        ติดตามข่าวสาร นวัตกรรมยานยนต์ไฟฟ้า และข้อเสนอสุดพิเศษก่อนใคร
                    </p>
                    <!-- ฟอร์มกรอกอีเมล (สามารถเชื่อมต่อระบบ Newsletter ในอนาคต) -->
                    <form action="#" method="POST" class="relative max-w-sm" onsubmit="event.preventDefault(); alert('ขอบคุณสำหรับการสมัครรับข่าวสาร!');">
                        <input type="email" placeholder="Enter your email" required class="w-full py-3.5 pl-4 pr-14 border border-gray-300 rounded-xl focus:outline-none focus:border-black transition-colors text-sm">
                        <button type="submit" class="absolute right-1.5 top-1.5 bottom-1.5 bg-[#1a1a1a] text-white w-10 h-10 rounded-lg flex items-center justify-center hover:bg-black transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 -rotate-45">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- คอลัมน์ 2: Quick Links (อัปเดตลิงก์จริง) -->
                <div class="lg:col-span-2 lg:col-start-6">
                    <h3 class="text-[17px] font-bold text-black mb-6">เมนูลัด</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-black transition-colors text-[15px]">หน้าหลัก (Home)</a></li>
                        <li><a href="/category/electric" class="text-gray-600 hover:text-black transition-colors text-[15px]">100% Electric</a></li>
                        <li><a href="/category/hybrid" class="text-gray-600 hover:text-black transition-colors text-[15px]">Hybrid Power</a></li>
                        <li><a href="/charging-solutions" class="text-gray-600 hover:text-black transition-colors text-[15px]">Charging Solutions</a></li>
                        <li><a href="{{ route('test-drive.index') }}" class="text-gray-600 hover:text-black transition-colors text-[15px]">จองทดลองขับ</a></li>
                    </ul>
                </div>

                <!-- คอลัมน์ 3: Contact Us (อัปเดตข้อมูลจริงตามบริบท) -->
                <div class="lg:col-span-3">
                    <h3 class="text-[17px] font-bold text-black mb-6">ติดต่อเรา</h3>
                    <ul class="space-y-4 text-gray-600 text-[15px]">
                        <li>คณะวิทยาศาสตร์และเทคโนโลยี</li>
                        <li>มหาวิทยาลัยเทคโนโลยีราชมงคลพระนคร</li>
                        <li>ศูนย์พระนครเหนือ ถ.ประชาราษฎร์ สาย 1</li>
                        <li>โทรศัพท์: 02-665-3777</li>
                        <li>อีเมล: <a href="mailto:info.sci@rmutp.ac.th" class="hover:text-black">info.sci@rmutp.ac.th</a></li>
                    </ul>
                </div>

                <!-- คอลัมน์ 4: Follow Us -->
                <div class="lg:col-span-3">
                    <h3 class="text-[17px] font-bold text-black mb-6">ติดตามเรา</h3>
                    
                    <!-- โซเชียลมีเดียไอคอน -->
                    <div class="flex gap-3 mb-8">
                        <a href="https://sci.rmutp.ac.th/" target="_blank" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-black hover:border-black transition-colors" title="Website">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" /></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-black hover:border-black transition-colors" title="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-black hover:border-black transition-colors" title="Twitter">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                    </div>
                    
                </div>
            </div>

            <!-- โซนลิขสิทธิ์ และ นโยบายต่างๆ ด้านล่าง -->
            <div class="pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-[15px]">
                    &copy; {{ date('Y') }} SCI EV Hub. All rights reserved.
                </p>
                <div class="flex flex-wrap justify-center gap-6 text-[15px] font-medium text-black">
                    <a href="#" class="hover:text-gray-500 transition-colors">นโยบายความเป็นส่วนตัว (Privacy Policy)</a>
                    <a href="#" class="hover:text-gray-500 transition-colors">เงื่อนไขการให้บริการ (Terms of Service)</a>
                </div>
            </div>
            
        </div>
    </footer>