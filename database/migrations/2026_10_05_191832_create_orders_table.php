<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // เชื่อมโยงกับตาราง users (ผู้ซื้อ)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // เชื่อมโยงกับตาราง products (สินค้าที่ซื้อ)
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            
            $table->string('order_number')->unique(); // เลขที่ใบสั่งซื้อ
            $table->decimal('total_price', 15, 2); // ราคารวม
            
            // สถานะการสั่งซื้อ
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            
            $table->text('notes')->nullable(); // หมายเหตุเพิ่มเติม
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
