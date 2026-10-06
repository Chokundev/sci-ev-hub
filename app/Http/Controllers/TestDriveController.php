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
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'notes' => 'nullable|string|max:1000'
        ]);

        TestDrive::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'notes' => $request->notes,
            'status' => 'pending'
        ]);

        return redirect()->route('dashboard')->with('success', 'ส่งคำขอจองคิวทดลองขับสำเร็จ! เจ้าหน้าที่จะติดต่อกลับเพื่อยืนยันคิว');
    }
}