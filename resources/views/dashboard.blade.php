<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการสั่งจอง - SCI EV Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black font-sans antialiased selection:bg-black selection:text-white">

    <!-- Navbar แผงควบคุม (เรียบหรู ไม่มีกรอบล่าง) -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md">
        <div class="max-w-[1440px] mx-auto px-6 py-6 flex justify-between items-center">
            <div class="flex items-center gap-6">
                <!-- ปุ่มกลับหน้าหลัก -->
                <a href="/" class="flex items-center gap-2 text-gray-500 hover:text-black transition-colors text-sm font-medium tracking-wide group uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transform transition-transform group-hover:-translate-x-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    Back to Hub
                </a>
            </div>
            
            <!-- โลโก้ -->
            <span class="text-xl md:text-2xl font-bold tracking-[0.2em] uppercase absolute left-1/2 transform -translate-x-1/2">
                SCI EV Hub
            </span>

            <!-- เมนูผู้ใช้ -->
            <div class="flex items-center gap-6 text-sm">
                <span class="hidden md:block font-medium tracking-wide">คุณ {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors uppercase tracking-widest text-xs font-bold">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- เนื้อหาหลัก -->
    <main class="max-w-[1440px] mx-auto px-6 py-12 md:py-20">
        
        @if(isset($orders) && $orders->count() > 0)
            @foreach($orders as $order)
                @php
                    // ดึงข้อมูลรถยนต์ที่เชื่อมกับออเดอร์นี้
                    $product = $order->product;
                    
                    // ดึงรูปภาพจากหน้าดีเทล (image_url) มาแสดง
                    $carImg = $product->image_url ?? '';
                    if ($carImg && !str_starts_with($carImg, 'http')) {
                        $carImg = asset('storage/' . $carImg);
                    } elseif (!$carImg) {
                        $carImg = 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
                    }

                    // คำนวณราคา (สมมติว่าใน DB คุณเก็บราคาสุทธิไว้ที่ $order->total_price หรือ $product->price)
                    $totalPrice = $order->total_price ?? $product->price ?? 0;
                    $basePrice = $totalPrice / 1.07; // ถอด VAT 7% ออกมาเป็นราคาต้นทุนรถ
                    $vatAmount = $totalPrice - $basePrice; // ยอด VAT
                @endphp

                <div class="mb-24 last:mb-0"> <!-- เว้นระยะห่างกรณีมีหลายออเดอร์ -->
                    
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
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                                <!-- ดึงสถานะจริงจาก DB -->
                                <span class="text-lg font-medium">{{ $order->status ?? 'รอดำเนินการ (Processing)' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Details Split Layout -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24">
                        
                        <!-- ฝั่งซ้าย: รูปภาพรถจริงจาก DB -->
                        <div class="lg:col-span-7">
                            
                            <!-- เอาพื้นหลังสีเทาและกรอบออก เปลี่ยนเป็นโปร่งใส และเพิ่ม drop-shadow ให้รถดูมีมิติ -->
                            <div class="relative w-full flex items-center justify-center pb-8">
                                <img src="{{ $carImg }}" 
                                     alt="{{ $product->name ?? 'EV Car' }}" 
                                     class="w-full h-auto object-contain drop-shadow-2xl hover:scale-[1.03] transition-transform duration-1000">
                            </div>
                            
                            <!-- ข้อมูลตัวรถเบื้องต้นจาก DB -->
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
                                <!-- ดันชื่อรถขึ้นมาเป็นหัวข้อหลักตัวใหญ่ -->
                                <h3 class="text-3xl md:text-4xl font-extrabold tracking-tight text-black mb-2 uppercase">{{ $product->name ?? 'ไม่ระบุรุ่น' }}</h3>
                                <!-- ลดขนาด Summary of Charges ให้เป็นแค่ซับไตเติ้ล -->
                                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-8">Summary of Charges</p>
                                
                                <ul class="space-y-5 text-[15px]">
                                    <li class="flex justify-between items-center border-b border-gray-100 pb-5">
                                        <!-- ลบชื่อรถตรงนี้ออก เพราะเราเอาไปไว้ข้างบนแล้ว -->
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
        @else
            <!-- กรณีที่ลูกค้ายังไม่มีประวัติการจองเลย -->
            <div class="py-20 text-center flex flex-col items-center justify-center">
                <h2 class="text-2xl font-bold mb-4">ยังไม่มีประวัติการสั่งจอง</h2>
                <p class="text-gray-500 mb-8">คุณยังไม่ได้ทำรายการสั่งจองรถยนต์ใดๆ ในขณะนี้</p>
                <a href="/" class="px-8 py-3 bg-black text-white font-medium rounded-full hover:bg-gray-800 transition-colors">
                    กลับไปเลือกรถยนต์
                </a>
            </div>
        @endif

    </main>

</body>
</html>