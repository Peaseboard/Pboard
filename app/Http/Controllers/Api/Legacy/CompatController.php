<?php

namespace App\Http\Controllers\Api\Legacy;

use App\Models\Node;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Http\Request;

/**
 * Legacy API 兼容层
 * 用于无缝对接 Xboard/V2board 的旧版前端模板和 App
 */
class GuestController
{
    public function config(Request )
    {
        // 模拟 Xboard 的 /api/v1/guest/comm/config 响应
         = env("APP_NAME", "Pboard");
         = Plan::where("renew", 1)->get(["id", "name", "price"])->toArray();
        
        return response()->json([
            "title" => ,
            "description" => "Modern, Fast, Clean.",
            "plans" => ,
        ]);
    }
}

class PassportController
{
    public function login(Request )
    {
        // 模拟 Xboard 登录接口
         = ->input("email");
         = ->input("password");

         = User::where("email", )->first();
        
        if (! || !password_verify(, ->password)) {
            return response()->json(["ret" => 0, "msg" => "邮箱或密码错误"])->setStatusCode(422);
        }

        // 简单生成 Token (实际项目应使用 Sanctum/Passport)
         = md5(->id . time());
        ->update(["token" => ]);

        return response()->json([
            "ret" => 1,
            "data" => [
                "token" => ,
                "auth_data" => ,
                "user_id" => ->id,
            ]
        ]);
    }
}

class UserController
{
    public function getSubscribe(Request )
    {
         = ->input("token");
         = User::where("token", )->first();
        
        if (!) {
            return response("User not found", 404);
        }

        // 生成标准的订阅链接内容 (Base64 编码)
         = Node::where("enabled", 1)->get();
         = [];
        foreach ( as ) {
            // 这里将根据节点协议生成 URI
            // 示例: vmess://...
            [] = "vmess://base64_placeholder_{->id}";
        }

         = implode("\r\n", );
        
        // 设置流量 Header (Xboard 标准)
         = ->transfer_enable;
         = ->u;
         = ->d;
         =  + ;

         = response(base64_encode(), 200)
            ->header("subscription-userinfo", "upload=; download=; total=; expire=253392422400")
            ->header("profile-update-interval", "24");
            
        return ;
    }
}
