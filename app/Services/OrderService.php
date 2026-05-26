<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\Plan;
use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public static function createOrder(int $userId, int $planId, string $type, ?string $couponCode = null): Order
    {
        $user = User::findOrFail($userId);
        $plan = Plan::findOrFail($planId);

        $totalAmount = $plan->price;
        $discountAmount = 0;

        if ($couponCode) {
            $coupon = Coupon::where("code", $couponCode)->first();
            if ($coupon && $coupon->checkValid()) {
                if ($coupon->type == "percentage") {
                    $discountAmount = $totalAmount * ($coupon->value / 100);
                } else {
                    $discountAmount = $coupon->value;
                }
            }
        }

        $finalAmount = max(0, $totalAmount - $discountAmount);

        return DB::transaction(function () use ($userId, $planId, $couponCode, $type, $totalAmount, $discountAmount, $finalAmount, $coupon) {
            $order = Order::create([
                "trade_no" => "PB" . date("YmdHis") . Str::random(6),
                "user_id" => $userId,
                "plan_id" => $planId,
                "coupon_id" => $coupon?->id,
                "total_amount" => $totalAmount,
                "discount_amount" => $discountAmount,
                "handling_amount" => 0, // Placeholder for fees
                "type" => $type,
                "status" => "pending",
            ]);

            if (isset($coupon)) {
                $coupon->increment("used_count");
            }

            return $order;
        });
    }

    public static function payOrder(string $tradeNo, string $method): bool
    {
        $order = Order::where("trade_no", $tradeNo)->where("status", "pending")->first();
        if (!$order) return false;

        // In real world, this happens after payment callback
        return self::handlePaid($order);
    }

    public static function handlePaid(Order $order): bool
    {
        return DB::transaction(function () use ($order) {
            if ($order->status == "paid") return true;

            $order->update([
                "status" => "paid",
                "paid_at" => now(),
                "payment_method" => "balance", // Simplified
            ]);

            $user = $order->user;

            // Activate Plan
            $plan = $order->plan;
            $user->plan_id = $plan->id;
            
            // Expiry Logic
            if ($user->expired_at && $user->expired_at > now()) {
                $user->expired_at = $user->expired_at->addMonth(); // Simplified
            } else {
                $user->expired_at = now()->addMonth();
            }

            // Traffic Reset (if configured)
            if ($order->type == "reset_traffic") {
                $user->u = 0;
                $user->d = 0;
            }

            $user->transfer_enable = $plan->transfer_enable;
            $user->save();

            // Commission Logic (Simplified)
            if ($user->invite_user_id) {
                $inviter = User::find($user->invite_user_id);
                if ($inviter) {
                    $commissionRate = 10; // From Config
                    $amount = $order->total_amount * ($commissionRate / 100);
                    $inviter->balance += $amount;
                    $inviter->save();
                }
            }

            return true;
        });
    }
}
