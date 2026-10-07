<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการสั่งจองและทดลองขับ - SCI EV Hub</title>
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

    <!-- เนื้อหาหลัก -->
    <main class="max-w-[1440px] mx-auto px-6 py-12 md:py-20">
        
        <!-- ============================================== -->
        <!-- ส่วนที่ 1: สถานะการสั่งจองรถยนต์ -->
        <!-- ============================================== -->
        @if(isset($orders) && $orders->count() > 0)
            @foreach($orders as $order)
                @php
                    $product = $order->product;
                    
                    $carImg = $product->image_url ?? '';
                    if ($carImg && !str_starts_with($carImg, 'http')) {
                        $carImg = asset('storage/' . $carImg);
                    } elseif (!$carImg) {
                        $carImg = 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
                    }

                    $totalPrice = $order->total_price ?? $product->price ?? 0;
                    $basePrice = $totalPrice / 1.07;
                    $vatAmount = $totalPrice - $basePrice; 
                @endphp

                <div class="mb-24 last:mb-0 border-b-2 border-black/5 pb-24"> 
                    
                    <!-- Header: Order ID & Status -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 border-b border-gray-200 pb-10">
                        <div>
                            <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase mb-3">Reservation Number</p>
                            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">{{ $order->order_number ?? 'ORD-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
                        </div>
                        
                        <div class="mt-6 md:mt-0 text-left md:text-right">
                            <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase mb-3">Current Status</p>
                            <div class="inline-flex items-center gap-3">
                                <span class="relative flex h-3 w-3">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $order->status == 'completed' ? 'bg-green-400' : ($order->status == 'cancelled' ? 'bg-red-400' : 'bg-yellow-400') }} opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 {{ $order->status == 'completed' ? 'bg-green-500' : ($order->status == 'cancelled' ? 'bg-red-500' : 'bg-yellow-500') }}"></span>
                                </span>
                                <span class="text-lg font-medium">{{ strtoupper($order->status ?? 'pending') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Details Split Layout -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24">
                        
                        <!-- ฝั่งซ้าย: รูปภาพรถจริงจาก DB -->
                        <div class="lg:col-span-7">
                            
                            <div class="relative w-full flex items-center justify-center pb-8">
                                <img src="{{ $carImg }}" 
                                     alt="{{ $product->name ?? 'EV Car' }}" 
                                     class="w-full h-auto object-contain drop-shadow-2xl hover:scale-[1.03] transition-transform duration-1000">
                            </div>
                            
                            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-8 border-t border-gray-200 pt-10">
                                <div>
                                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-2">Model</p>
                                    <p class="font-medium text-lg">{{ $product->name ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-2">Energy</p>
                                    <p class="font-medium text-lg">{{ $product->energy_type ?? 'Electric' }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-2">Date</p>
                                    <p class="font-medium text-lg">{{ $order->created_at ? $order->created_at->format('d M Y') : '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-2">Time</p>
                                    <p class="font-medium text-lg">{{ $order->created_at ? $order->created_at->format('H:i') : '-' }} น.</p>
                                </div>
                            </div>
                        </div>

                        <!-- ฝั่งขวา: รายละเอียดราคาจริง -->
                        <div class="lg:col-span-5 flex flex-col justify-between">
                            
                            <div>
                                <h3 class="text-3xl md:text-4xl font-extrabold tracking-tight text-black mb-2 uppercase">{{ $product->name ?? 'ไม่ระบุรุ่น' }}</h3>
                                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-8">Summary of Charges</p>
                                
                                <ul class="space-y-5 text-[15px]">
                                    <li class="flex justify-between items-center border-b border-gray-100 pb-5">
                                        <span class="text-gray-600">Base Price</span>
                                        <span class="font-medium">฿ {{ number_format($basePrice, 2) }}</span>
                                    </li>
                                    <li class="flex justify-between items-center border-b border-gray-100 pb-5">
                                        <span class="text-gray-600">VAT (7%)</span>
                                        <span class="font-medium">฿ {{ number_format($vatAmount, 2) }}</span>
                                    </li>
                                </ul>

                                <div class="mt-8 pt-8 border-t-2 border-black flex justify-between items-end">
                                    <div>
                                        <p class="text-xs font-bold tracking-widest text-gray-500 uppercase mb-1">Total Amount</p>
                                        <p class="text-[11px] text-gray-400">Net Payable</p>
                                    </div>
                                    <span class="text-4xl font-extrabold tracking-tight">฿ {{ number_format($totalPrice, 2) }}</span>
                                </div>
                            </div>

                            <!-- ข้อมูลลูกค้า -->
                            <div class="mt-16 bg-gray-50 p-8 rounded-xl">
                                <h4 class="text-[13px] font-bold tracking-widest uppercase mb-6">Delivery Information</h4>
                                <div class="space-y-4 text-sm text-gray-600">
                                    <p><strong class="text-black">Customer:</strong> {{ Auth::user()->name }}</p>
                                    <p><strong class="text-black">Email:</strong> {{ Auth::user()->email }}</p>
                                    <p><strong class="text-black">Estimated Delivery:</strong> TBD (รอการยืนยัน)</p>
                                    <p><strong class="text-black">Pickup Location:</strong> SCI EV Hub, Main Showroom</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- ============================================== -->
        <!-- ส่วนที่ 2: สถานะการนัดหมายทดลองขับ (Test Drives) -->
        <!-- ============================================== -->
        @if(isset($testDrives) && $testDrives->count() > 0)
            <div class="mt-20">
                <div class="mb-12 border-b border-gray-200 pb-6 flex justify-between items-end">
                    <div>
                        <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase mb-3">Your Appointments</p>
                        <h2 class="text-3xl font-extrabold tracking-tight">นัดหมายทดลองขับ</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    @foreach($testDrives as $drive)
                        <!-- Card Design ไร้กรอบ เน้นเงาบางๆ และ Background สีอ่อน -->
                        <div class="bg-[#fafafa] rounded-2xl p-8 hover:bg-[#f0f0f0] transition-colors relative overflow-hidden group">
                            
                            <!-- ไฟสถานะ (Status Indicator) รูปแบบใหม่ -->
                            <div class="flex justify-between items-center mb-8">
                                <div class="inline-flex items-center gap-2">
                                     <span class="relative flex h-2.5 w-2.5">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 
                                            {{ strtolower($drive->status) == 'confirmed' || strtolower($drive->status) == 'completed' ? 'bg-green-400' : (strtolower($drive->status) == 'cancelled' ? 'bg-red-400' : 'bg-yellow-400') }}">
                                        </span>
                                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 
                                            {{ strtolower($drive->status) == 'confirmed' || strtolower($drive->status) == 'completed' ? 'bg-green-500' : (strtolower($drive->status) == 'cancelled' ? 'bg-red-500' : 'bg-yellow-500') }}">
                                        </span>
                                    </span>
                                    <span class="text-xs font-bold tracking-widest uppercase 
                                        {{ strtolower($drive->status) == 'confirmed' || strtolower($drive->status) == 'completed' ? 'text-green-700' : (strtolower($drive->status) == 'cancelled' ? 'text-red-700' : 'text-yellow-600') }}">
                                        {{ $drive->status }}
                                    </span>
                                </div>
                                <span class="text-[10px] font-bold tracking-widest text-gray-400 uppercase">Test Drive</span>
                            </div>
                            
                            <div class="mb-8">
                                <h4 class="text-3xl font-extrabold text-gray-900 tracking-tight uppercase">{{ $drive->product->name }}</h4>
                            </div>
                            
                            <!-- วันที่และเวลา (ไม่มีพื้นหลังทึบ แยกเป็นบรรทัดชัดเจน) -->
                            <div class="flex flex-row justify-start gap-12 border-t border-gray-200 pt-6">
                                <div>
                                    <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Date</p>
                                    <p class="font-bold text-lg text-gray-900">{{ \Carbon\Carbon::parse($drive->booking_date)->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Time</p>
                                    <p class="font-bold text-lg text-gray-900">{{ \Carbon\Carbon::parse($drive->booking_time)->format('H:i') }} น.</p>
                                </div>
                            </div>

                            @if($drive->notes)
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-2">Notes</p>
                                    <p class="text-sm text-gray-600 leading-relaxed">{{ $drive->notes }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- ============================================== -->
        <!-- ส่วนที่ 3: กรณีไม่มีข้อมูลใดๆ เลย (Empty State) -->
        <!-- ============================================== -->
        @if((!isset($orders) || $orders->count() == 0) && (!isset($testDrives) || $testDrives->count() == 0))
            <div class="py-32 text-center flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold mb-4">ยังไม่มีประวัติการทำรายการ</h2>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">คุณยังไม่ได้ทำรายการสั่งจองรถยนต์ หรือจองคิวทดลองขับใดๆ ในขณะนี้</p>
                <div class="flex gap-4">
                    <a href="/" class="px-8 py-3 bg-black text-white font-medium rounded-full hover:bg-gray-800 transition-colors shadow-lg hover:shadow-xl">
                        เลือกรถยนต์ไฟฟ้า
                    </a>
                    <a href="{{ route('test-drive.index') }}" class="px-8 py-3 bg-white text-black border border-gray-200 font-medium rounded-full hover:border-black transition-colors">
                        นัดหมายทดลองขับ
                    </a>
                </div>
            </div>
        @endif

    </main>

</body>
</html>