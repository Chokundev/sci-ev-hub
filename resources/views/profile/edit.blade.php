<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าโปรไฟล์ - SCI EV Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-black font-sans antialiased">

    <!-- Navbar สไตล์ Dashboard -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-[1440px] mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <a href="/" class="flex items-center gap-2 text-gray-500 hover:text-black transition-colors text-sm font-medium tracking-wide group uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transform transition-transform group-hover:-translate-x-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    BACK TO HUB
                </a>
            </div>
            <span class="text-xl md:text-2xl font-bold tracking-[0.2em] uppercase absolute left-1/2 transform -translate-x-1/2">
                Profile Setting
            </span>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12">
        
        <!-- แบบฟอร์มอัปเดตข้อมูลและรูปโปรไฟล์ -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12 mb-8">
            <div class="mb-8 border-b border-gray-100 pb-4">
                <h2 class="text-2xl font-extrabold text-gray-900">ข้อมูลส่วนตัว</h2>
                <p class="text-gray-500 text-sm mt-1">อัปเดตรูปโปรไฟล์ ชื่อ และอีเมลของบัญชีคุณ</p>
            </div>

            <!-- ต้องใส่ enctype="multipart/form-data" เพื่อให้อัปโหลดไฟล์ได้ -->
            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('patch')

                <!-- ส่วนอัปโหลดรูปโปรไฟล์ -->
                <div class="flex flex-col sm:flex-row items-center gap-8">
                    <div class="relative group">
                        @php
                            $avatarUrl = $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=FFFFFF&background=111827';
                        @endphp
                        <img id="avatarPreview" src="{{ $avatarUrl }}" alt="Profile" class="w-32 h-32 rounded-full object-cover border-4 border-gray-50 shadow-md">
                        
                        <!-- ปุ่ม Camera วางทับรูป -->
                        <label for="avatarInput" class="absolute bottom-0 right-0 bg-white p-2 rounded-full shadow-lg border border-gray-200 cursor-pointer hover:bg-gray-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                            </svg>
                        </label>
                        <!-- อินพุตไฟล์ถูกซ่อนไว้ -->
                        <input type="file" id="avatarInput" name="avatar" accept="image/*" class="hidden" onchange="previewImage(event)">
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">รูปโปรไฟล์</h3>
                        <p class="text-sm text-gray-500 mt-1">รองรับ JPG, PNG, WEBP ขนาดไม่เกิน 2MB</p>
                        @error('avatar')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- ส่วนกรอกชื่อและอีเมล -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">ชื่อ - นามสกุล</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition">
                        @error('name')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">อีเมลติดต่อ</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-black focus:ring-1 focus:ring-black outline-none transition">
                        @error('email')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="px-8 py-3 bg-black text-white font-bold rounded-full shadow-lg hover:bg-gray-800 transition-colors">
                        บันทึกการเปลี่ยนแปลง
                    </button>
                </div>
            </form>
        </div>

        <!-- สามารถเพิ่มส่วนเปลี่ยนรหัสผ่านได้ที่นี่ในอนาคต -->

    </main>

    <!-- Script สำหรับพรีวิวรูปภาพก่อนอัปโหลด -->
    <script>
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <!-- Script ตรวจสอบ Flash Message -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#000000',
                confirmButtonText: 'ตกลง'
            });
        });
    </script>
    @endif
</body>
</html>