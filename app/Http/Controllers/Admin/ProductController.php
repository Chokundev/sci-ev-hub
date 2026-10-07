<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

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
        // 1. ตรวจสอบข้อมูลพื้นฐาน
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'card_image' => 'nullable|file|max:5120',
            'image' => 'nullable|file|max:5120',
        ], [
            'card_image.max' => 'ขนาดไฟล์รูปการ์ดใหญ่เกินไป (ไม่เกิน 5MB)',
            'image.max' => 'ขนาดไฟล์รูปรถใหญ่เกินไป (ไม่เกิน 5MB)',
        ]);

        $data = $request->except(['card_image', 'image']);
        $destinationPath = public_path('storage/products');

        // สร้างโฟลเดอร์ปลายทางถ้ายังไม่มี
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // 2. จัดการอัปโหลด "รูปการ์ดหน้าแรก" (name="card_image")
        if ($request->hasFile('card_image')) {
            $file = $request->file('card_image');
            if ($file->isValid()) {
                $ext = strtolower($file->getClientOriginalExtension());
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($ext, $allowedExtensions)) {
                    $filename = 'card_' . uniqid() . '.' . $ext;
                    $file->move($destinationPath, $filename);
                    $data['card_image_url'] = 'products/' . $filename;
                }
            }
        }

        // 3. จัดการอัปโหลด "รูปรถคันใหญ่" (name="image")
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $ext = strtolower($file->getClientOriginalExtension());
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($ext, $allowedExtensions)) {
                    $filename = 'car_' . uniqid() . '.' . $ext;
                    $file->move($destinationPath, $filename);
                    $data['image_url'] = 'products/' . $filename;
                }
            }
        }

        // บันทึกข้อมูลลงฐานข้อมูล
        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'เพิ่มข้อมูลรถยนต์เรียบร้อยแล้ว');
    }

    // ดึงข้อมูลสินค้าเดิมมาแสดงในหน้าฟอร์มแก้ไข
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // บันทึกข้อมูลที่ถูกแก้ไข (Update)
    public function update(Request $request, Product $product)
    {
        // 1. ตรวจสอบข้อมูลพื้นฐาน
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'card_image' => 'nullable|file|max:5120',
            'image' => 'nullable|file|max:5120',
        ]);

        $data = $request->except(['card_image', 'image']);
        $destinationPath = public_path('storage/products');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // 2. อัปเดต "รูปการ์ดหน้าแรก" ใหม่ (ถ้ามีส่งมา)
        if ($request->hasFile('card_image')) {
            $file = $request->file('card_image');
            if ($file->isValid()) {
                $ext = strtolower($file->getClientOriginalExtension());
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($ext, $allowedExtensions)) {
                    $filename = 'card_' . uniqid() . '.' . $ext;
                    $file->move($destinationPath, $filename);

                    // ลบรูปการ์ดเก่าทิ้งเพื่อประหยัดพื้นที่
                    if ($product->card_image_url && file_exists(public_path('storage/' . $product->card_image_url))) {
                        @unlink(public_path('storage/' . $product->card_image_url));
                    }

                    $data['card_image_url'] = 'products/' . $filename;
                }
            }
        }

        // 3. อัปเดต "รูปรถคันใหญ่" ใหม่ (ถ้ามีส่งมา)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $ext = strtolower($file->getClientOriginalExtension());
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($ext, $allowedExtensions)) {
                    $filename = 'car_' . uniqid() . '.' . $ext;
                    $file->move($destinationPath, $filename);

                    // ลบรูปรถเก่าทิ้งเพื่อประหยัดพื้นที่
                    if ($product->image_url && file_exists(public_path('storage/' . $product->image_url))) {
                        @unlink(public_path('storage/' . $product->image_url));
                    }

                    $data['image_url'] = 'products/' . $filename;
                }
            }
        }

        // อัปเดตข้อมูลลงฐานข้อมูล
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'อัปเดตข้อมูลรถยนต์เรียบร้อยแล้ว');
    }

    // ลบสินค้าออกจากระบบ (Destroy)
    public function destroy(Product $product)
    {
        // 1. ลบไฟล์รูปการ์ดออกจากโฟลเดอร์
        if ($product->card_image_url && file_exists(public_path('storage/' . $product->card_image_url))) {
            @unlink(public_path('storage/' . $product->card_image_url));
        }
        
        // 2. ลบไฟล์รูปรถหลักออกจากโฟลเดอร์
        if ($product->image_url && file_exists(public_path('storage/' . $product->image_url))) {
            @unlink(public_path('storage/' . $product->image_url));
        }

        // 3. ลบข้อมูลออกจากฐานข้อมูล
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'ลบข้อมูลรถยนต์เรียบร้อยแล้ว!');
    }
}