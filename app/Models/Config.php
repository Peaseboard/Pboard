<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = ["key", "value"];

    public static function get($key, $default = null)
    {
        $val = self::where("key", $key)->first();
        return $val ? $val->value : $default;
    }
}
