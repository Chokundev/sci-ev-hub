<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'order_number', 'total_price', 'status', 'notes'
    ];

    // ความสัมพันธ์: คำสั่งซื้อนี้ เป็นของ User คนไหน
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ความสัมพันธ์: คำสั่งซื้อนี้ คือการซื้อรถรุ่นไหน
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}