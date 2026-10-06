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
        // ค้นหาสินค้าจาก ID ถ้าไม่เจอให้แสดงหน้า 404
        $product = Product::findOrFail($id);
        
        return view('frontend.product-detail', compact('product'));
    }
}