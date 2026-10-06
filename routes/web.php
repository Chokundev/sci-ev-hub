<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

// ==========================================
// หน้าหลักของเว็บไซต์ (Landing Page)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.detail');

// Route เตรียมไว้สำหรับหน้าอื่นๆ ที่จะพัฒนาต่อ
Route::get('/test-drive', function () { return 'หน้าจองคิวทดลองขับ (กำลังพัฒนา)'; })->name('test-drive.index');
Route::get('/contact', function () { return 'หน้าติดต่อเรา (กำลังพัฒนา)'; })->name('contact.index');
Route::get('/charging-solutions', function () { return 'หน้า EV Charging Solutions (กำลังพัฒนา)'; })->name('charging.index');
Route::get('/motorsport', function () { return 'หน้า Future of Motorsport (กำลังพัฒนา)'; })->name('motorsport.index');
Route::get('/electric-suv', function () { return 'หน้า New Electric SUV (กำลังพัฒนา)'; })->name('suv.index');



// ==========================================
// โซนของผู้ใช้ทั่วไป (User) - ดัดแปลงจาก Breeze
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // หน้า Dashboard ของลูกค้า (แสดงประวัติการสั่งซื้อ)
    Route::get('/dashboard', [OrderController::class, 'userDashboard'])->name('dashboard');

    // โซนสั่งจองรถยนต์ (Checkout)
    Route::get('/checkout/{product}', [\App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/{product}', [\App\Http\Controllers\OrderController::class, 'store'])->name('checkout.store');
    
    // เพิ่ม Route สำหรับหน้าสรุปคำสั่งจอง (Success)
    Route::get('/order/{order}/success', [\App\Http\Controllers\OrderController::class, 'success'])->name('order.success');

    // จัดการโปรไฟล์ (ของเดิมจาก Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==========================================
// โซนของผู้ดูแลระบบ (Admin & Superadmin)
// ==========================================
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    
    // หน้าแดชบอร์ดหลังบ้าน
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('admin.dashboard');
    
    // ระบบจัดการสินค้า (เพิ่ม, ลบ, แก้ไข, แสดงผล)
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
    // ระบบจัดการคำสั่งซื้อ (Orders)
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::put('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // ระบบจัดการคำสั่งซื้อ (ของเดิมที่มีอยู่แล้ว)
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::put('/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // ระบบจัดการผู้ใช้งาน (Users)
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::put('/users/{user}/role', [\App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
});

// ดึงไฟล์ Route เกี่ยวกับการ Login/Register ของ Breeze เข้ามาทำงานร่วมด้วย
require __DIR__.'/auth.php';