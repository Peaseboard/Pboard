<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = ["name", "driver", "config", "enable", "sort", "notify_url", "return_url"];

    protected $casts = ["config" => "array"];
}
