<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการสั่งจองและทดลองขับ - SCI EV Hub</title>
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
            <div class="mt-10">
                <div class="mb-12">
                    <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase mb-3">Your Appointments</p>
                    <h2 class="text-3xl font-extrabold tracking-tight">นัดหมายทดลองขับ</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($testDrives as $drive)
                        <div class="border border-gray-200 rounded-2xl p-8 hover:border-gray-900 transition-colors bg-white relative overflow-hidden group">
                            
                            <!-- แถบสีสถานะด้านบน -->
                            <div class="absolute top-0 left-0 right-0 h-1 {{ $drive->status == 'confirmed' ? 'bg-blue-500' : ($drive->status == 'completed' ? 'bg-green-500' : ($drive->status == 'cancelled' ? 'bg-red-500' : 'bg-yellow-400')) }}"></div>

                            <div class="flex justify-between items-start mb-8">
                                <div>
                                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-1">Vehicle Model</p>
                                    <h4 class="text-2xl font-bold text-gray-900">{{ $drive->product->name }}</h4>
                                </div>
                                <span class="px-4 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase border 
                                    {{ $drive->status == 'confirmed' ? 'border-blue-200 text-blue-700 bg-blue-50' : 
                                      ($drive->status == 'completed' ? 'border-green-200 text-green-700 bg-green-50' : 
                                      ($drive->status == 'cancelled' ? 'border-red-200 text-red-700 bg-red-50' : 'border-yellow-200 text-yellow-700 bg-yellow-50')) }}">
                                    {{ $drive->status }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-6 bg-gray-50 p-6 rounded-xl">
                                <div>
                                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-2">Date</p>
                                    <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($drive->booking_date)->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-2">Time</p>
                                    <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($drive->booking_time)->format('H:i') }} น.</p>
                                </div>
                            </div>

                            @if($drive->notes)
                                <div class="mt-6 pt-6 border-t border-gray-100">
                                    <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-2">Notes</p>
                                    <p class="text-sm text-gray-600">{{ $drive->notes }}</p>
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