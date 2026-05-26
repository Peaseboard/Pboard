<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected  = ['ticket_id', 'user_id', 'message'];

    public function ticket() {
        return ->belongsTo(Ticket::class);
    }

    public function user() {
        return ->belongsTo(User::class);
    }
}
