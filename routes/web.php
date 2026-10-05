<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

// ==========================================
// หน้าหลักของเว็บไซต์ (Landing Page)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');



// ==========================================
// โซนของผู้ใช้ทั่วไป (User) - ดัดแปลงจาก Breeze
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // หน้า Dashboard ของลูกค้า (แสดงประวัติการสั่งซื้อ)
    Route::get('/dashboard', [OrderController::class, 'userDashboard'])->name('dashboard');

    // Route สำหรับกดสั่งซื้อสินค้า
    Route::post('/checkout/{product}', [OrderController::class, 'store'])->name('checkout.store');

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

});

// ดึงไฟล์ Route เกี่ยวกับการ Login/Register ของ Breeze เข้ามาทำงานร่วมด้วย
require __DIR__.'/auth.php';