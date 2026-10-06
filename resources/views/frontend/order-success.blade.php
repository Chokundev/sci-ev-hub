<!DOCTYPE html>
<html lang="th">
<head>
    <title>สั่งจองสำเร็จ - SCI EV Hub</title>
    @include('partials.meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">

    <div class="sm:mx-auto sm:w-full sm:max-w-2xl">
        
        <!-- โลโก้แบรนด์ -->
        <div class="text-center mb-8">
            <a href="/" class="text-2xl font-bold tracking-[0.2em] uppercase text-gray-900">SCI EV Hub</a>
        </div>

        <div class="bg-white py-10 px-8 shadow-xl border border-gray-100 rounded-3xl sm:px-12 text-center">
            
            <!-- ไอคอนเครื่องหมายถูกสีเขียว -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                <svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">ทำรายการสั่งจองสำเร็จ!</h2>
            <p class="text-gray-500 mb-8">ขอบคุณที่เลือก SCI EV Hub ทีมงานจะติดต่อกลับไปยังข้อมูลติดต่อของท่านโดยเร็วที่สุดเพื่อยืนยันรายละเอียด</p>

            <!-- กล่องสรุปข้อมูล (Order Details) -->
            <div class="bg-gray-50 rounded-2xl p-6 text-left space-y-4 mb-8 border border-gray-100">
                <h3 class="text-lg font-bold border-b border-gray-200 pb-3">รายละเอียดคำสั่งจอง</h3>
                
                <div class="flex justify-between items-center pt-2">
                    <span class="text-gray-500 text-sm">หมายเลขการจอง (Order No.)</span>
                    <span class="font-bold text-primary">{{ $order->order_number }}</span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-sm">วันที่สั่งจอง</span>
                    <span class="font-medium text-gray-900">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-sm">รุ่นรถยนต์</span>
                    <span class="font-medium text-gray-900">{{ $order->product->name }}</span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-500 text-sm">สถานะปัจจุบัน</span>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">รอดำเนินการ (Pending)</span>
                </div>

                @if($order->notes)
                <div class="flex justify-between items-start pt-2 border-t border-gray-200 mt-2">
                    <span class="text-gray-500 text-sm whitespace-nowrap mr-4">ข้อความเพิ่มเติม</span>
                    <span class="font-medium text-gray-900 text-sm text-right">{{ $order->notes }}</span>
                </div>
                @endif
            </div>

            <!-- ปุ่มดำเนินการ -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-3 bg-gray-900 text-white rounded-xl font-semibold shadow-md hover:bg-black transition-colors">
                    ไปที่แผงควบคุมของฉัน
                </a>
                <a href="{{ route('home') }}" class="w-full sm:w-auto px-8 py-3 bg-white border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                    กลับสู่หน้าหลัก
                </a>
            </div>

        </div>
    </div>
</body>
</html>