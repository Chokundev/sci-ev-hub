<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\TestDrive;
use Illuminate\Support\Facades\Auth;

class TestDriveController extends Controller
{
    // เพิ่มพารามิเตอร์ $product = null เพื่อให้รองรับกรณีที่ไม่มีการส่งรถมาด้วย
    public function index(Product $product = null)
    {
        $products = Product::all();
        
        // ถ้ามีข้อมูลรถส่งมา ให้เก็บ ID ไว้เพื่อตั้งค่าเริ่มต้นใน Dropdown
        $selectedProductId = $product ? $product->id : null;

        return view('frontend.test-drive', compact('products', 'selectedProductId'));
    }

    public function store(Request $request)
    {
        // ตรวจสอบความถูกต้องของฟอร์ม
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'notes' => 'nullable|string|max:1000',
        ]);

        // 1. ตรวจสอบว่าผู้ใช้มีคิวทดลองขับ "รถยนต์รุ่นนี้" ที่ยังไม่เสร็จสิ้นหรือไม่
        $activeTestDriveExists = TestDrive::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->whereIn('status', ['pending', 'confirmed']) // เช็คสถานะรอดำเนินการ หรือ ยืนยันคิวแล้ว
            ->exists();

        // 2. ถ้ามีคิวค้างอยู่ ให้ตีกลับพร้อมข้อความแจ้งเตือน
        if ($activeTestDriveExists) {
            return back()->with('error', 'คุณมีคิวทดลองขับสำหรับรถยนต์รุ่นนี้ที่กำลังดำเนินการอยู่ ไม่สามารถจองซ้ำได้ครับ');
        }

        // 3. ถ้าไม่มีคิวค้าง ให้สร้างการจองใหม่
        TestDrive::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'ระบบได้รับคำขอจองคิวทดลองขับของคุณแล้ว โปรดรอการยืนยันจากเจ้าหน้าที่');
    }
}