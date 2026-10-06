<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. ข้อมูลสถิติแบบการ์ด (Card Stats)
        $totalProducts = Product::count();
        $newOrders = Order::where('status', 'pending')->count();
        $totalUsers = User::count();
        $totalSales = Order::where('status', 'completed')->sum('total_price');

        // 2. ข้อมูลสำหรับ "กราฟเส้น" (ยอดขาย 7 วันย้อนหลัง)
        $salesData = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total')
            )
            ->where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // เตรียมชุดข้อมูลให้ครบ 7 วัน (แม้วันนั้นจะไม่มียอดขายก็ตาม)
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $dateString = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = Carbon::now()->subDays($i)->format('d M'); // ป้ายกำกับแกน X เช่น '05 Oct'
            
            $sale = $salesData->firstWhere('date', $dateString);
            $chartData[] = $sale ? $sale->total : 0; // ยอดขายแกน Y
        }

        // 3. ข้อมูลสำหรับ "กราฟวงกลม" (สัดส่วนสถานะคำสั่งซื้อ)
        $orderStatuses = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')->toArray();

        $pieLabels = ['รอดำเนินการ', 'กำลังจัดเตรียม', 'ส่งมอบแล้ว', 'ยกเลิก'];
        $pieData = [
            $orderStatuses['pending'] ?? 0,
            $orderStatuses['processing'] ?? 0,
            $orderStatuses['completed'] ?? 0,
            $orderStatuses['cancelled'] ?? 0,
        ];

        return view('admin.dashboard', compact(
            'totalProducts', 'newOrders', 'totalUsers', 'totalSales',
            'chartLabels', 'chartData', 'pieLabels', 'pieData'
        ));
    }
}