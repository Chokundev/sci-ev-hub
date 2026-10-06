<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // เพิ่มคอลัมน์ card_image_url เข้าไปหลัง image_url
            $table->text('card_image_url')->nullable()->after('image_url');
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // ลบคอลัมน์ออกหากมีการย้อนกลับ
            $table->dropColumn('card_image_url');
        });
    }
};
