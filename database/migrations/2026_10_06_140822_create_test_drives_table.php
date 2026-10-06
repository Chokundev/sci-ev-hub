<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_drives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->date('booking_date'); // วันที่ต้องการทดลองขับ
            $table->time('booking_time'); // เวลาที่ต้องการ
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending'); // สถานะการจอง
            $table->text('notes')->nullable(); // ข้อความเพิ่มเติม
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_drives');
    }
};
