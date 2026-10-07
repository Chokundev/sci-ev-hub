<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// นำเข้า Controllers ฝั่ง User
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestDriveController;

// นำเข้า Controllers ฝั่ง Admin (ใช้ as เพื่อป้องกันชื่อคลาสซ้ำกัน)
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\TestDriveController as AdminTestDriveController;

// ==========================================
// หน้าหลักของเว็บไซต์ (Landing Page)
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.detail');

Route::get('/contact', function () { 
    return view('contact'); 
})->name('contact.index');

// Route เตรียมไว้สำหรับหน้าอื่นๆ ที่จะพัฒนาต่อ

Route::get('/charging-solutions', function () { return 'หน้า EV Charging Solutions (กำลังพัฒนา)'; })->name('charging.index');
Route::get('/motorsport', function () { return 'หน้า Future of Motorsport (กำลังพัฒนา)'; })->name('motorsport.index');
Route::get('/electric-suv', function () { return 'หน้า New Electric SUV (กำลังพัฒนา)'; })->name('suv.index');


// ==========================================
// โซนของผู้ใช้ทั่วไป (User) - ต้องเข้าสู่ระบบก่อน
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // แผงควบคุมลูกค้า
    Route::get('/dashboard', [OrderController::class, 'userDashboard'])->name('dashboard');

    // โซนสั่งจองรถยนต์ (Checkout)
    Route::get('/checkout/{product}', [OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/{product}', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/order/{order}/success', [OrderController::class, 'success'])->name('order.success');

    // ระบบจองคิวทดลองขับ
    Route::get('/test-drive/{product?}', [TestDriveController::class, 'index'])->name('test-drive.index');
    Route::post('/test-drive', [TestDriveController::class, 'store'])->name('test-drive.store');

    // จัดการโปรไฟล์ (Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==========================================
// โซนของผู้ดูแลระบบ (Admin & Superadmin)
// ==========================================
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    
    // แดชบอร์ดภาพรวมของ Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // ระบบจัดการสินค้า (Products)
    Route::resource('products', AdminProductController::class)->names([
        'index'   => 'admin.products.index',
        'create'  => 'admin.products.create',
        'store'   => 'admin.products.store',
        'show'    => 'admin.products.show',
        'edit'    => 'admin.products.edit',
        'update'  => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
    
    // ระบบจัดการคำสั่งซื้อ (Orders)
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // ระบบจัดการจองทดลองขับ (Test Drives)
    Route::get('/test-drives', [AdminTestDriveController::class, 'index'])->name('admin.test-drives.index');
    Route::put('/test-drives/{testDrive}/status', [AdminTestDriveController::class, 'updateStatus'])->name('admin.test-drives.updateStatus');

    // ระบบจัดการผู้ใช้งาน (Users)
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::put('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
});

// ดึงไฟล์ Route เกี่ยวกับการ Login/Register ของ Breeze เข้ามาทำงานร่วมด้วย
require __DIR__.'/auth.php';

Route::get('/category/{type}', [\App\Http\Controllers\HomeController::class, 'category'])->name('category.show');

// Route สำหรับหน้า EV Charging Solutions
Route::get('/charging-solutions', function () {
    return view('frontend.charging');
})->name('charging.index');

// Route ชั่วคราวสำหรับสร้าง Storage Link บน Shared Hosting (ไม่มี SSH)
Route::get('/create-symlink', function () {
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    
    // ตรวจสอบและรันคำสั่ง Artisan
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return 'สร้าง Storage Link สำเร็จ! รูปภาพสามารถใช้งานได้แล้ว <a href="/">กลับหน้าหลัก</a>';
    } catch (\Exception $e) {
        return 'เกิดข้อผิดพลาด: ' . $e->getMessage();
    }
});

Route::get('/setup-storage', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return '✅ สร้าง Storage Link สำเร็จ! <a href="/">กลับหน้าหลัก</a>';
    } catch (\Exception $e) {
        return '❌ เกิดข้อผิดพลาด: ' . $e->getMessage();
    }
});