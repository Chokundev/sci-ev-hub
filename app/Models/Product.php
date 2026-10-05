<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // กำหนดฟิลด์ที่อนุญาตให้บันทึกข้อมูลได้ (Mass Assignment)
    protected $fillable = [
        'name', 'price', 'status_badge', 'accel_0_100', 
        'max_range', 'top_speed', 'embed_code', 'description'
    ];

    // ความสัมพันธ์: รถ 1 รุ่น สามารถถูกสั่งซื้อได้หลายครั้ง (One-to-Many)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
