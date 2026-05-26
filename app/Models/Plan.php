<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        name, price, capacity, transfer_enable, speed_limit, renew
    ];
}
