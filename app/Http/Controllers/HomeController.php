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
        $product = Product::latest()->first(); 
        
        return view('frontend.home', compact('product'));
    }
}