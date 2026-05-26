<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ["code", "name", "type", "value", "limit_use", "used_count", "started_at", "ended_at", "enabled"];

    public function checkValid(): bool
    {
        if (!$this->enabled) return false;
        if ($this->limit_use && $this->used_count >= $this->limit_use) return false;
        $now = now();
        if ($this->started_at && $now < $this->started_at) return false;
        if ($this->ended_at && $now > $this->ended_at) return false;
        return true;
    }
}
