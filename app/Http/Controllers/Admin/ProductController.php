<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // แสดงรายการสินค้าทั้งหมด
    public function index()
    {
        $products = Product::latest()->get(); 
        return view('admin.products.index', compact('products'));
    }

    // แสดงหน้าฟอร์มสร้างสินค้าใหม่
    public function create()
    {
        return view('admin.products.create');
    }

    // รับข้อมูลจากฟอร์มและบันทึกลงฐานข้อมูล
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'accel_0_100' => 'required|string|max:255',
            'max_range' => 'required|string|max:255',
            'top_speed' => 'required|string|max:255',
            'embed_code' => 'nullable|string',
            'description' => 'nullable|string',
            
            // ฟิลด์ส่วนเสริมสำหรับการ์ด
            'energy_type' => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:255',
            'status_badge' => 'nullable|string|max:50',

            // ฟิลด์รูปภาพ
            'card_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);
        
        // จัดการอัปโหลดรูปหน้าการ์ด
        if ($request->hasFile('card_image')) {
            $validatedData['card_image_url'] = $request->file('card_image')->store('products', 'public');
        }

        // จัดการอัปโหลดรูปรถหน้าดีเทลหลัก
        if ($request->hasFile('image')) {
            $validatedData['image_url'] = $request->file('image')->store('products', 'public');
        }

        // ลบตัวแปรไฟล์ออกจาก Array ก่อนบันทึกลง Database
        unset($validatedData['card_image'], $validatedData['image']);
        
        Product::create($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'บันทึกข้อมูลรถยนต์รุ่นใหม่สำเร็จเรียบร้อยแล้ว!');
    }

    // ดึงข้อมูลสินค้าเดิมมาแสดงในหน้าฟอร์มแก้ไข
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // บันทึกข้อมูลที่ถูกแก้ไข (Update)
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'accel_0_100' => 'required|string|max:255',
            'max_range' => 'required|string|max:255',
            'top_speed' => 'required|string|max:255',
            'embed_code' => 'nullable|string',
            'description' => 'nullable|string',
            
            'energy_type' => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:255',
            'status_badge' => 'nullable|string|max:50',

            'card_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // จัดการอัปเดตรูปหน้าการ์ด
        if ($request->hasFile('card_image')) {
            // ลบรูปเก่าทิ้งก่อน (ถ้ามี) เพื่อประหยัดพื้นที่เซิร์ฟเวอร์
            if ($product->card_image_url) {
                Storage::disk('public')->delete($product->card_image_url);
            }
            // อัปโหลดรูปใหม่
            $validatedData['card_image_url'] = $request->file('card_image')->store('products', 'public');
        }

        // จัดการอัปเดตรูปรถหน้าดีเทลหลัก
        if ($request->hasFile('image')) {
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $validatedData['image_url'] = $request->file('image')->store('products', 'public');
        }

        // ลบตัวแปรไฟล์ออกจาก Array ก่อนอัปเดต
        unset($validatedData['card_image'], $validatedData['image']);

        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'อัปเดตข้อมูลรถยนต์รุ่น ' . $product->name . ' เรียบร้อยแล้ว!');
    }

    // ลบสินค้าออกจากระบบ (Destroy)
    public function destroy(Product $product)
    {
        // 1. ลบไฟล์รูปภาพออกจากโฟลเดอร์ public/storage/products ก่อน
        if ($product->card_image_url) {
            Storage::disk('public')->delete($product->card_image_url);
        }
        
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        // 2. ลบข้อมูลออกจากฐานข้อมูล
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'ลบข้อมูลรถยนต์เรียบร้อยแล้ว!');
    }
}