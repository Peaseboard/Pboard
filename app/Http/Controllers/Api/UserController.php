<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Invite;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController
{
    public function getProfile(Request $request)
    {
        $user = $request->user();
        return response()->json(["data" => $user]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $user->update($request->only(["remakes"])); // Only allow limited fields
        return response()->json(["data" => $user]);
    }

    public function changePassword(Request $request)
    {
        $user = $request->user();
        if (!Hash::check($request->input("old_password"), $user->password)) {
            return response()->json(["ret" => 0, "msg" => "Old password incorrect"], 422);
        }
        $user->update(["password" => Hash::make($request->input("new_password"))]);
        return response()->json(["ret" => 1, "msg" => "Password changed"]);
    }

    public function getSubscribe(Request $request)
    {
        $user = $request->user();
        $token = $user->token ?: Str::random(32);
        $user->update(["token" => $token]);
        
        $nodes = \App\Models\Node::where("enabled", 1)->get();
        $links = [];
        foreach ($nodes as $node) {
            $links[] = "vmess://" . base64_encode(json_encode([
                "v" => "2", "ps" => $node->name, "add" => $node->host,
                "port" => $node->port, "id" => $user->uuid, "aid" => "0", "net" => "tcp"
            ]));
        }
        
        $content = implode("\r\n", $links);
        $total = $user->transfer_enable;
        $used = $user->u + $user->d;
        
        return response(base64_encode($content), 200)
            ->header("subscription-userinfo", "upload={$user->u}; download={$user->d}; total={$total}; expire=253392422400");
    }

    public function getInviteCode(Request $request)
    {
        $user = $request->user();
        $invite = Invite::firstOrCreate(
            ["user_id" => $user->id],
            ["code" => Str::random(8)]
        );
        return response()->json(["data" => $invite]);
    }

    public function getCommissionLog(Request $request)
    {
        $user = $request->user();
        $logs = \App\Models\Commission::where("user_id", $user->id)->get();
        return response()->json(["data" => $logs]);
    }
}
