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
        // 1. ตรวจสอบว่าผู้ใช้มีออเดอร์ของ "รถยนต์รุ่นนี้" ที่ยังค้างอยู่หรือไม่
        $activeOrderExists = Order::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->whereIn('status', ['pending', 'processing']) // เช็คเฉพาะสถานะที่ยังไม่เสร็จสิ้น
            ->exists();

        // 2. ถ้ามีออเดอร์ค้างอยู่ ให้ตีกลับพร้อมข้อความแจ้งเตือน
        if ($activeOrderExists) {
            return back()->with('error', 'คุณมีรายการสั่งซื้อรถยนต์รุ่นนี้ที่กำลังดำเนินการอยู่ ไม่สามารถสั่งซื้อซ้ำได้จนกว่ารายการเดิมจะเสร็จสิ้นหรือถูกยกเลิกครับ');
        }

        // 3. ถ้าไม่มีออเดอร์ค้าง ให้สร้างคำสั่งซื้อใหม่ได้ตามปกติ
        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'total_price' => $product->price,
            'status' => 'pending',
        ]);

        return redirect()->route('order.success', $order->id)->with('success', 'สั่งซื้อรถยนต์สำเร็จ!');
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