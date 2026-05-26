<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Redis;

class TrafficService
{
    /**
     *  斦寸了之重选面诃封说发 (Gate -> Pboard)
     * 
     * @param int $nodeId
     * @param array $data
     */
    public static function pushStats(int $nodeId, array $data): bool
    {
        try {
            Redis::lpush("traffic_stats_queue", json_encode([
                "node_id" => $nodeId,
                "users" => $data["users"] ?? [],
                "timestamp" => time(),
            ]));
            return true;
        } catch (\Exception $e) {
            \Log::error("Traffic push failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     *  徎的了禈击倉限用的密，艾取工表c
     */
    public static function consumeQueue(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $item = Redis::rrop("traffic_stats_queue");
            if (!$item) break;

            $stats = json_decode($item, true);
            if (!isset($stats["users"])) continue;

            foreach ($stats["users"] as $u) {
                User::where("id", $u["user_id"])->decrement("u", $u["u"] ?? 0);
                User::where("id", $u["user_id"])->increment("d", $u["d"] ?? 0);
            }
        }
    }
}
