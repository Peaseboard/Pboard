<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected  = ['user_id', 'subject', 'status', 'last_reply_user_id'];

    public function user() {
        return ->belongsTo(User::class);
    }

    public function messages() {
        return ->hasMany(TicketMessage::class);
    }
}
