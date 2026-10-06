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
        // เช็คก่อนว่าในตาราง 'products' มีคอลัมน์ 'card_image_url' หรือยัง
        if (!Schema::hasColumn('products', 'card_image_url')) {
            Schema::table('products', function (Blueprint $table) {
                // ถ้ายังไม่มี ถึงจะทำการสร้างคอลัมน์ใหม่
                $table->string('card_image_url')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('products', 'card_image_url')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('card_image_url');
            });
        }
    }
};