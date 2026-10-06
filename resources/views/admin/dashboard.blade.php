@extends('layouts.admin')

@section('title', 'Overview')

@section('content')

    <!-- 1. ส่วนข้อความต้อนรับ (Premium Dark Style) -->
    <div class="bg-gray-900 rounded-3xl shadow-2xl border border-gray-800 p-10 md:p-12 mb-10 relative overflow-hidden text-white">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-gray-800 to-transparent opacity-40"></div>
        <div class="absolute -bottom-24 -right-24 w-64 h-64 border-[1rem] border-white/5 rounded-full"></div>

        <div class="relative z-10">
            <p class="text-[11px] font-bold tracking-[0.2em] text-gray-400 uppercase mb-3">Welcome Back</p>
            <h2 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">Hello, {{ Auth::user()->name }}.</h2>
            <p class="text-gray-400 leading-relaxed max-w-2xl text-sm md:text-base mb-10">
                ศูนย์กลางการควบคุม SCI EV Hub ของคุณ ตรวจสอบภาพรวมธุรกิจ ยอดสั่งจอง คิวทดลองขับ และการบริหารจัดการโมเดลรถยนต์ไฟฟ้าแห่งอนาคต ได้จากแผงควบคุมนี้
            </p>
            
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center bg-white text-gray-900 px-8 py-3.5 rounded-full text-sm font-bold hover:bg-gray-200 transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                + เพิ่มสินค้ารถยนต์ใหม่
            </a>
        </div>
    </div>

    <!-- 2. การ์ดสรุปสถิติ (Stat Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Card 1: สินค้าทั้งหมด -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-gray-900 hover:shadow-lg transition-all duration-300 flex flex-col justify-between h-full relative group">
            <div class="flex justify-between items-start mb-8">
                <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center text-gray-900 group-hover:bg-gray-900 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                </div>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-1">Total Products</p>
                <h3 class="text-5xl font-extrabold text-gray-900 tracking-tight">{{ number_format($totalProducts) }}</h3>
            </div>
        </div>

        <!-- Card 2: คำสั่งซื้อใหม่ -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-gray-900 hover:shadow-lg transition-all duration-300 flex flex-col justify-between h-full relative group">
            <div class="flex justify-between items-start mb-8">
                <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center text-gray-900 group-hover:bg-gray-900 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                </div>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-1">New Orders</p>
                <h3 class="text-5xl font-extrabold text-gray-900 tracking-tight">{{ number_format($newOrders) }}</h3>
            </div>
        </div>

        <!-- Card 3: ผู้ใช้งาน -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-gray-900 hover:shadow-lg transition-all duration-300 flex flex-col justify-between h-full relative group">
            <div class="flex justify-between items-start mb-8">
                <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center text-gray-900 group-hover:bg-gray-900 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-1">Total Users</p>
                <h3 class="text-5xl font-extrabold text-gray-900 tracking-tight">{{ number_format($totalUsers) }}</h3>
            </div>
        </div>

        <!-- Card 4: ยอดขายรวม -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-gray-900 hover:shadow-lg transition-all duration-300 flex flex-col justify-between h-full relative group">
            <div class="flex justify-between items-start mb-8">
                <div class="w-14 h-14 bg-gray-50 rounded-full flex items-center justify-center text-gray-900 group-hover:bg-gray-900 group-hover:text-white transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-1">Net Sales</p>
                <h3 class="text-3xl lg:text-4xl font-extrabold text-gray-900 tracking-tight">฿{{ number_format($totalSales, 0) }}</h3>
            </div>
        </div>
    </div>

    <!-- 3. เมนูลัด (Quick Actions) -->
    <div class="mb-10">
        <h3 class="text-lg font-extrabold text-gray-900 mb-4 tracking-tight">Quick Actions</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <!-- จัดการรถยนต์ -->
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-900 transition-all duration-300 group">
                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center text-gray-500 group-hover:bg-gray-900 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 text-sm">จัดการรถยนต์</h4>
                    <p class="text-xs text-gray-500">แคตตาล็อกสินค้า</p>
                </div>
            </a>

            <!-- จัดการคำสั่งซื้อ -->
            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-900 transition-all duration-300 group">
                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center text-gray-500 group-hover:bg-gray-900 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 text-sm">จัดการคำสั่งซื้อ</h4>
                    <p class="text-xs text-gray-500">อัปเดตสถานะออเดอร์</p>
                </div>
            </a>

            <!-- คิวทดลองขับ -->
            <a href="{{ route('admin.test-drives.index') }}" class="flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-900 transition-all duration-300 group">
                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center text-gray-500 group-hover:bg-gray-900 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 text-sm">คิวทดลองขับ</h4>
                    <p class="text-xs text-gray-500">ยืนยันเวลานัดหมาย</p>
                </div>
            </a>

            <!-- จัดการผู้ใช้งาน -->
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-4 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-900 transition-all duration-300 group">
                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center text-gray-500 group-hover:bg-gray-900 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 text-sm">ผู้ใช้งาน</h4>
                    <p class="text-xs text-gray-500">จัดการสิทธิ์ระบบ</p>
                </div>
            </a>
        </div>
    </div>

    <!-- 4. พื้นที่แสดงกราฟสถิติ (Charts Section) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- กราฟเส้น (Line Chart) -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 lg:col-span-2 relative">
            <div class="mb-4">
                <h3 class="text-lg font-extrabold text-gray-900 tracking-tight">แนวโน้มยอดขาย (7 วันย้อนหลัง)</h3>
                <p class="text-sm text-gray-500">มูลค่ายอดขายรวมจากการส่งมอบรถยนต์สำเร็จ</p>
            </div>
            <div class="relative h-72 w-full">
                <canvas id="salesLineChart"></canvas>
            </div>
        </div>

        <!-- กราฟวงกลม (Doughnut Chart) -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 relative">
            <div class="mb-4">
                <h3 class="text-lg font-extrabold text-gray-900 tracking-tight">สถานะคำสั่งซื้อ</h3>
                <p class="text-sm text-gray-500">สัดส่วนของออเดอร์ทั้งหมด</p>
            </div>
            <div class="relative h-64 w-full flex justify-center mt-6">
                <canvas id="statusPieChart"></canvas>
            </div>
        </div>

    </div>

    <!-- นำเข้าไลบรารี Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- สคริปต์สำหรับวาดกราฟ (เหมือนเดิม) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // กราฟเส้น (Line Chart)
            const lineCtx = document.getElementById('salesLineChart').getContext('2d');
            let gradientFill = lineCtx.createLinearGradient(0, 0, 0, 300);
            gradientFill.addColorStop(0, 'rgba(17, 24, 39, 0.2)');
            gradientFill.addColorStop(1, 'rgba(17, 24, 39, 0)');

            new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'ยอดขาย (บาท)',
                        data: {!! json_encode($chartData) !!},
                        borderColor: '#111827',
                        backgroundColor: gradientFill,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#111827',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#111827',
                            padding: 12,
                            titleFont: { size: 13, family: 'sans-serif' },
                            bodyFont: { size: 14, weight: 'bold', family: 'sans-serif' },
                            callbacks: {
                                label: function(context) {
                                    return ' ฿ ' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [4, 4], color: '#f3f4f6', drawBorder: false },
                            ticks: { color: '#9ca3af', font: { family: 'sans-serif' } }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: '#6b7280', font: { family: 'sans-serif' } }
                        }
                    }
                }
            });

            // กราฟวงกลม (Doughnut Chart)
            const pieCtx = document.getElementById('statusPieChart').getContext('2d');
            new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($pieLabels) !!},
                    datasets: [{
                        data: {!! json_encode($pieData) !!},
                        backgroundColor: ['#fbbf24', '#60a5fa', '#34d399', '#f87171'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { usePointStyle: true, padding: 20, color: '#4b5563', font: { family: 'sans-serif' } }
                        }
                    }
                }
            });
        });
    </script>
@endsection