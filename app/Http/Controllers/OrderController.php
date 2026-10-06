<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\TestDrive;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function userDashboard()
    {
        // ดึงรายการสั่งจองรถของ User คนนี้
        $orders = Order::where('user_id', Auth::id())->with('product')->latest()->get();
        
        // ดึงรายการคิวทดลองขับของ User คนนี้
        $testDrives = TestDrive::where('user_id', Auth::id())->with('product')->latest()->get();

        // ส่งตัวแปรทั้งสองไปที่หน้า View
        return view('dashboard', compact('orders', 'testDrives'));
    }

    public function checkout(Product $product)
    {
        return view('frontend.checkout', compact('product'));
    }

    // 1. ปรับปรุงฟังก์ชัน store ให้ Redirect ไปหน้า success พร้อมส่ง ID ของ Order ไปด้วย
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000'
        ]);

        $orderNumber = 'ORD-' . strtoupper(substr(uniqid(), -6));

        // สร้างและเก็บค่าตัวแปร $order ไว้
        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'order_number' => $orderNumber,
            'total_price' => $product->price,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        // เปลี่ยนเป้าหมายการ Redirect จาก dashboard เป็นหน้า order.success
        return redirect()->route('order.success', $order->id)->with('success', 'สั่งจองรถยนต์สำเร็จ!');
    }

    // 2. เพิ่มฟังก์ชันสำหรับแสดงหน้าสรุปคำสั่งจอง
    public function success(Order $order)
    {
        // ตรวจสอบความปลอดภัย: ป้องกันไม่ให้ User คนอื่นเอา ID Order มาเปิดดู
        if ($order->user_id !== Auth::id()) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงข้อมูลคำสั่งจองนี้');
        }

        // ดึงข้อมูล Product ที่เชื่อมโยงกับ Order นี้มาด้วย
        $order->load('product');

        return view('frontend.order-success', compact('order'));
    }
}