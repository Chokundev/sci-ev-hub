<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestDrive extends Model
{
    protected $fillable = ['user_id', 'product_id', 'booking_date', 'booking_time', 'status', 'notes'];

    // ความสัมพันธ์: การจอง 1 ครั้ง เป็นของ User 1 คน
    public function user() {
        return $this->belongsTo(User::class);
    }

    // ความสัมพันธ์: การจอง 1 ครั้ง เลือกรถยนต์ 1 รุ่น
    public function product() {
        return $this->belongsTo(Product::class);
    }
}