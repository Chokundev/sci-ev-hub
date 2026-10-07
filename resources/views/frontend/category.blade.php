<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $energyType }} Vehicles - SCI EV Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f9f9f9] text-black font-sans antialiased selection:bg-black selection:text-white min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-[1440px] mx-auto px-6 py-6 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 text-gray-500 hover:text-black transition-colors text-sm font-medium tracking-wide group uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transform transition-transform group-hover:-translate-x-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                Back to Hub
            </a>
            
            <span class="text-xl md:text-2xl font-bold tracking-[0.2em] uppercase absolute left-1/2 transform -translate-x-1/2">
                SCI EV Hub
            </span>
            
            <div class="w-20"></div> <!-- เว้นที่ให้โลโก้อยู่ตรงกลางเป๊ะๆ -->
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-[1440px] mx-auto px-6 py-16 md:py-24 flex-grow w-full">
        
        <!-- Header Section -->
        <div class="text-center mb-16 md:mb-24">
            <p class="text-xs font-bold tracking-[0.2em] text-gray-500 uppercase mb-4">Explore Our Collection</p>
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-black uppercase">
                {{ $energyType }} <span class="text-gray-300">Vehicles</span>
            </h1>
        </div>

        <!-- Product Grid -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($products as $car)
                    @php
                        $carImg = $car->image_url ?? '';
                        if ($carImg && !str_starts_with($carImg, 'http')) {
                            $carImg = asset('storage/' . $carImg);
                        } elseif (!$carImg) {
                            $carImg = 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                        }
                    @endphp
                    
                    <!-- การ์ดรถยนต์ -->
                    <a href="{{ route('product.detail', $car->id) }}" class="group block bg-white rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-2xl transition-all duration-500 border border-gray-100 relative overflow-hidden">
                        
                        <!-- ชื่อรุ่น และ แท็กพลังงาน -->
                        <div class="flex justify-between items-start mb-8 relative z-10">
                            <h3 class="text-2xl font-bold text-black uppercase tracking-tight">{{ $car->name }}</h3>
                            <span class="px-4 py-1.5 bg-gray-50 border border-gray-100 text-[10px] text-gray-600 font-bold tracking-widest uppercase rounded-full">
                                {{ $car->energy_type ?? 'Electric' }}
                            </span>
                        </div>

                        <!-- รูปรถตรงกลาง (Hover แล้วรถจะใหญ่ขึ้นนิดนึง) -->
                        <div class="relative w-full h-48 md:h-56 flex items-center justify-center mb-8 z-10">
                            <img src="{{ $carImg }}" alt="{{ $car->name }}" class="w-full h-full object-contain drop-shadow-2xl group-hover:scale-110 transition-transform duration-700">
                        </div>
                        
                        <!-- ราคา และ ปุ่มลูกศร -->
                        <div class="flex justify-between items-end border-t border-gray-50 pt-6 relative z-10">
                            <div>
                                <p class="text-[10px] font-bold tracking-widest text-gray-400 uppercase mb-1">Starting at</p>
                                <p class="text-xl font-extrabold text-black">฿ {{ number_format($car->price ?? 0, 0) }}</p>
                            </div>
                            <div class="w-12 h-12 rounded-full bg-black text-white flex items-center justify-center group-hover:bg-gray-800 transform group-hover:translate-x-1 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <!-- กรณีที่หมวดหมู่นั้นยังไม่มีรถเพิ่มไว้ในฐานข้อมูล -->
            <div class="text-center py-32 flex flex-col items-center">
                <div class="w-20 h-20 bg-white rounded-full shadow-sm flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-300"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z" /></svg>
                </div>
                <h3 class="text-2xl font-bold text-black mb-2">Coming Soon</h3>
                <p class="text-gray-400 text-sm">เรากำลังเตรียมพร้อมสำหรับยานยนต์หมวด {{ $energyType }} ในเร็วๆ นี้</p>
            </div>
        @endif
        
    </main>
</body>
</html>