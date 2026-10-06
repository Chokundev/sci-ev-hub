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
        // 1. ตรวจสอบความถูกต้องของข้อมูล (Validation) เพิ่มฟิลด์ใหม่ๆ เข้าไป
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'accel_0_100' => 'required|string|max:255',
            'max_range' => 'required|string|max:255',
            'top_speed' => 'required|string|max:255',
            'embed_code' => 'nullable|string',
            'description' => 'nullable|string',
            
            // --- ส่วนที่ต้องเพิ่มใหม่ เพื่อให้โชว์การ์ดได้สวยงาม ---
            'energy_type' => 'nullable|string|max:100', // เช่น Electric, Hybrid
            'short_description' => 'nullable|string|max:255', // คำอธิบายสั้นๆ ใต้การ์ด
            'status_badge' => 'nullable|string|max:50', // ป้ายสถานะ เช่น Available, Pre-order

            'card_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // รูปหน้าการ์ด
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',      // รูปหน้าดีเทลหลัก
        ]);
        
        // 1. จัดการอัปโหลดรูปหน้าการ์ด
    if ($request->hasFile('card_image')) {
        $validatedData['card_image_url'] = $request->file('card_image')->store('products', 'public');
    }

    // 2. จัดการอัปโหลดรูปรถหน้าดีเทล
    if ($request->hasFile('image')) {
        $validatedData['image_url'] = $request->file('image')->store('products', 'public');
    }

    // ลบตัวแปรไฟล์ชั่วคราวก่อนบันทึก
    unset($validatedData['card_image'], $validatedData['image']);
        // 2. บันทึกข้อมูลลงฐานข้อมูล (ใช้ Mass Assignment)
        Product::create($validatedData);

        // 3. ส่งผู้ใช้กลับไปหน้าแสดงรายการสินค้า พร้อมส่งข้อความแจ้งเตือน
        return redirect()->route('admin.products.index')->with('success', 'บันทึกข้อมูลรถยนต์รุ่นใหม่สำเร็จเรียบร้อยแล้ว!');
    }
}