<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        uuid, email, password, plan_id, expired_at,
        transfer_enable, u, d, banned, remarks,
    ];

    protected $hidden = [password];
    
    // 兼容 Xboard 的密码验证
    public function verifyPassword($password): bool {
        return password_verify($password, $this->password);
    }
}
