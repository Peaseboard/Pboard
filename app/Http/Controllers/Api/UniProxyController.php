<?php

namespace App\Http\Controllers\Api;

use App\Models\Node;
use App\Models\User;
use Illuminate\Http\Request;

class UniProxyController
{
    public function config(Request $request)
    {
        $token = $request->query('token');
        $nodeId = $request->query('node_id');

        $node = Node::where(['id' => $nodeId, 'enabled' => true])->first();
        if (!$node || $node->webapi_token !== $token) {
            return response()->status(403)->json(['message' => 'Unauthorized']);
        }

        return response()->json([
            'server_port' => $node->server_port ?? 443,
            'protocol' => $node->protocol,
            'network' => $node->config["network"] ?? 'tcp',
            'networkSettings' => $node->config["networkSettings"] ?? null,
            'tls' => $node->config["tlsSettings"] ? 1 : 0,
        ]);
    }

    public function user(Request $request)
    {
        $token = $request->query('token');
        $nodeId = $request->query('node_id');

        $node = Node::where(['id' => $nodeId, 'enabled' => true])->first();
        if (!$node || $node->webapi_token !== $token) {
            return response()->status(403)->json(['message' => 'Unauthorized']);
        }

        $users = User::where('game', 'expired_at', '>', now())->get(['uuid', 'transfer_enable', 'banned']);
        $formattedUsers = [];
        foreach ($users as $u) {
            $formattedUsers[] = [
                'id' => $u->id,
                'uuid' => $u->uuid,
                'transfer_enable' => $u->transfer_enable,
                'banned' => $u->banned,
            ];
        }

        return response()->json(['users' => $formattedUsers]);
    }
}
