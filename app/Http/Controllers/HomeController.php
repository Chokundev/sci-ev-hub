<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Product; // ดึงโมเดล Product มาใช้

class HomeController extends Controller
{
    public function index()
    {
        // 1. ดึงข้อมูลรถยนต์ทั้งหมดไปโชว์ในเมนู
        $products = Product::all();

        // 2. เช็คว่าลูกค้าล็อกอินหรือยัง ถ้าล็อกอินแล้วให้ดึงประวัติการจองมาด้วย
        if (\Illuminate\Support\Facades\Auth::check()) {
            $testDrives = \App\Models\TestDrive::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->orderBy('booking_date', 'desc') // เรียงจากวันที่จองล่าสุด
                ->get();
        } else {
            // ถ้ายังไม่ล็อกอิน ให้ส่งข้อมูลว่างๆ ไป เพื่อกัน Error
            $testDrives = collect(); 
        }

        // 3. ส่งข้อมูลทั้งหมดไปให้หน้าเว็บแสดงผล (ต้องมี 'testDrives' ด้วย)
        return view('frontend.home', compact('products', 'testDrives'));
    }

    // เพิ่มฟังก์ชัน show ลงไปใหม่ตรงนี้
    public function show($id)
{
    // ดึงข้อมูลรถยนต์คันที่ระบุเพื่อไปแสดงหน้า detail
    $product = Product::findOrFail($id);

    // ดึงข้อมูลรถยนต์ทั้งหมดเผื่อใช้แสดงในเมนู (ถ้า View หน้า detail ใช้)
    $products = Product::all(); 

    $testDrives = \App\Models\TestDrive::where('user_id', Auth::id())
        ->orderBy('booking_date', 'desc')
        ->get();

    // ส่งไปทั้ง $product (คันที่เลือก) และ $products (ทั้งหมด)
    return view('frontend.product-detail', compact('product', 'products', 'testDrives')); 
}
}