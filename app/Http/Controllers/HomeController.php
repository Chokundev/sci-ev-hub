<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // ดึงโมเดล Product มาใช้

class HomeController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลรถยนต์คันล่าสุดมาแสดงเป็นไฮไลต์บนหน้า Landing Page
        // (ถ้ามีรถหลายคันในอนาคต อาจจะปรับเป็นดึงคันที่ถูกตั้งค่าเป็น 'featured' ได้ครับ)
        $products = Product::all(); 
        
        return view('frontend.home', compact('products'));
    }

    // เพิ่มฟังก์ชัน show ลงไปใหม่ตรงนี้
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // เพิ่มบรรทัดนี้: ดึงรถทั้งหมดมาด้วย เพื่อเอาไปสร้างรูปในเมนูเบอร์เกอร์
        $products = Product::latest()->get(); 
        
        // ส่งตัวแปร $products แนบไปด้วย
        return view('frontend.product-detail', compact('product', 'products')); 
    }
}