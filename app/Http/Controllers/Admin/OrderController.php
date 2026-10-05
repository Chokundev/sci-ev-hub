<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // แสดงหน้ารายการสั่งซื้อทั้งหมด
    public function index()
    {
        // ดึงข้อมูล Order ทั้งหมด พร้อมข้อมูล User และ Product ที่เกี่ยวข้อง เรียงจากใหม่ไปเก่า
        $orders = Order::with(['user', 'product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // ฟังก์ชันสำหรับอัปเดตสถานะคำสั่งซื้อ
    public function updateStatus(Request $request, Order $order)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        // อัปเดตสถานะลงฐานข้อมูล
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'อัปเดตสถานะคำสั่งซื้อหมายเลข ' . $order->order_number . ' สำเร็จแล้ว!');
    }
}