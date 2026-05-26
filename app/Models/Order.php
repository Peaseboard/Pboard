<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "trade_no", "user_id", "plan_id", "coupon_id", 
        "total_amount", "handling_amount", "discount_amount",
        "type", "status", "payment_method", "callback_no", "paid_at"
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function plan() { return $this->belongsTo(Plan::class); }
    public function coupon() { return $this->belongsTo(Coupon::class); }
}
