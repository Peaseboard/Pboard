<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = ["user_id", "code", "status", "invitee_id", "commission_amount"];

    public function user() { return $this->belongsTo(User::class); }
    public function invitee() { return $this->belongsTo(User::class, "invitee_id"); }
    public function commission() { return $this->hasOne(Commission::class); }
}
