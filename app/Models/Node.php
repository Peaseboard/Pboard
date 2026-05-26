<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $casts = [
        config => array, // 自动将 JSON 转为数组
        enabled => boolean,
        is_online => boolean,
    ];

    protected $fillable = [
        name, group, host, port, server_port, 
        protocol, config, enabled, node_order, webapi_token
    ];
}
