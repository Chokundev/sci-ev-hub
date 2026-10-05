<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get(); 
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    // ฟังก์ชันสำหรับรับข้อมูลจากฟอร์มและบันทึกลงฐานข้อมูล
    public function store(Request $request)
    {
        // 1. ตรวจสอบความถูกต้องของข้อมูล (Validation)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'accel_0_100' => 'required|string|max:255',
            'max_range' => 'required|string|max:255',
            'top_speed' => 'required|string|max:255',
            'embed_code' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        // 2. บันทึกข้อมูลลงฐานข้อมูล (ใช้ Mass Assignment)
        Product::create($validatedData);

        // 3. ส่งผู้ใช้กลับไปหน้าแสดงรายการสินค้า พร้อมส่งข้อความแจ้งเตือน (Flash Session)
        return redirect()->route('admin.products.index')->with('success', 'บันทึกข้อมูลรถยนต์รุ่นใหม่สำเร็จเรียบร้อยแล้ว!');
    }
}