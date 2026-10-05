<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ชื่อรุ่นรถ
            $table->decimal('price', 15, 2); // ราคา
            $table->string('status_badge')->default('Available'); // ป้ายสถานะ
            $table->string('accel_0_100'); // อัตราเร่ง
            $table->string('max_range'); // ระยะทางสูงสุด
            $table->string('top_speed'); // ความเร็วสูงสุด
            $table->text('embed_code')->nullable(); // โค้ดฝัง 3D Model
            $table->text('description')->nullable(); // รายละเอียดเพิ่มเติม
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};