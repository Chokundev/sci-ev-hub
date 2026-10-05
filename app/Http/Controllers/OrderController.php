<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // แสดงหน้า Dashboard ของลูกค้า (รายการสั่งซื้อของตัวเอง)
    public function userDashboard()
    {
        // ดึงข้อมูลการสั่งซื้อเฉพาะของ User ที่ล็อกอินอยู่ พร้อมข้อมูล Product ที่เกี่ยวข้อง
        $orders = Order::where('user_id', Auth::id())->with('product')->latest()->get();
        return view('dashboard', compact('orders'));
    }

    // ฟังก์ชันสร้างคำสั่งซื้อใหม่
    public function store(Request $request, Product $product)
    {
        // สร้างหมายเลขคำสั่งซื้อแบบสุ่ม (เช่น ORD-64A1B2C)
        $orderNumber = 'ORD-' . strtoupper(substr(uniqid(), -6));

        // บันทึกข้อมูลลงตาราง orders
        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'order_number' => $orderNumber,
            'total_price' => $product->price,
            'status' => 'pending', // สถานะเริ่มต้นคือ รอดำเนินการ
        ]);

        // ส่งกลับไปหน้า Dashboard ลูกค้า พร้อมแจ้งเตือน
        return redirect()->route('dashboard')->with('success', 'สั่งซื้อรถยนต์รุ่น ' . $product->name . ' สำเร็จ! กรุณารอการติดต่อกลับ');
    }
}