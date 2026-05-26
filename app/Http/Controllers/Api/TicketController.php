<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;

class TicketController
{
    public function fetch(Request $request)
    {
        $user = $request->user();
        $tickets = Ticket::where("user_id", $user->id)->with("messages.user")->get();
        return response()->json(["data" => $tickets]);
    }

    public function save(Request $request)
    {
        $user = $request->user();
        
        if ($request->has("id")) {
            $ticket = Ticket::where("user_id", $user->id)->findOrFail($request->input("id"));
        } else {
            $ticket = Ticket::create([
                "user_id" => $user->id,
                "subject" => $request->input("subject"),
                "status" => "open",
            ]);
        }

        TicketMessage::create([
            "ticket_id" => $ticket->id,
            "user_id" => $user->id,
            "message" => $request->input("message"),
        ]);

        return response()->json(["ret" => 1, "msg" => "Saved"]);
    }
    
    public function close(Request $request)
    {
        $user = $request->user();
        Ticket::where("user_id", $user->id)
            ->where("id", $request->input("id"))
            ->update(["status" => "closed"]);
            
        return response()->json(["ret" => 1, "msg" => "Closed"]);
    }
}
