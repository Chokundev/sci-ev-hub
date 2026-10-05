<!DOCTYPE html>
<html lang="th">
<head>
    <title>แผงควบคุมของฉัน - SCI EV Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="w-full glass-panel shadow-sm bg-white/70">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold tracking-tighter text-primary flex items-center gap-2">
                <span class="text-accent text-xl">⚡</span> SCI EV Hub
            </a>
            <div class="flex items-center gap-4">
                <span class="text-gray-600 font-medium">คุณ {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm transition">ออกจากระบบ</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 py-12 w-full">
        <h2 class="text-3xl font-bold mb-8 text-gray-900">ประวัติการสั่งซื้อของคุณ</h2>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-100">
                        <th class="p-4 font-medium">หมายเลขคำสั่งซื้อ</th>
                        <th class="p-4 font-medium">รุ่นรถยนต์</th>
                        <th class="p-4 font-medium">ราคา (บาท)</th>
                        <th class="p-4 font-medium">วันที่สั่งซื้อ</th>
                        <th class="p-4 font-medium">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="p-4 font-semibold text-primary">{{ $order->order_number }}</td>
                        <td class="p-4 text-gray-800">{{ $order->product->name }}</td>
                        <td class="p-4 text-gray-600">{{ number_format($order->total_price, 0) }}</td>
                        <td class="p-4 text-gray-500 text-sm">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="p-4">
                            @if($order->status == 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">รอดำเนินการ</span>
                            @elseif($order->status == 'processing')
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">กำลังจัดเตรียมรถ</span>
                            @elseif($order->status == 'completed')
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">ส่งมอบแล้ว</span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">ยกเลิก</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400">คุณยังไม่มีประวัติการสั่งซื้อรถยนต์</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- SweetAlert2 สำหรับแจ้งเตือนเมื่อสั่งซื้อสำเร็จ -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#1CAAD9',
            });
        });
    </script>
    @endif

</body>
</html>