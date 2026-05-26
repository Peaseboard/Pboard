<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Services\OrderService;
use App\Services\PaymentGateway;
use Illuminate\Http\Request;

class OrderController
{
    public function fetch(Request $request)
    {
        $user = $request->user();
        $orders = Order::where("user_id", $user->id)
            ->with("plan")
            ->orderByDesc("created_at")
            ->get();
        return response()->json(["data" => $orders]);
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $order = OrderService::createOrder(
            $user->id,
            $request->input("plan_id"),
            $request->input("type", "new"),
            $request->input("coupon_code")
        );

        return response()->json(["data" => $order]);
    }

    public function checkout(Request $request)
    {
        $user = $request->user();
        $tradeNo = $request->input("trade_no");
        $method = $request->input("method", "balance");

        // Check balance
        if ($method == "balance") {
            $order = Order::where("trade_no", $tradeNo)->where("user_id", $user->id)->first();
            if (!$order) return response()->json(["ret" => 0, "msg" => "Order not found"], 404);

            if ($user->balance >= $order->total_amount) {
                $user->decrement("balance", $order->total_amount);
                OrderService::handlePaid($order);
                return response()->json(["ret" => 1, "msg" => "Paid successfully"]);
            } else {
                return response()->json(["ret" => 0, "msg" => "Insufficient balance"]);
            }
        } else {
            // Redirect to third-party payment
            $gateway = PaymentGateway::getInstance($method);
            $payUrl = $gateway->createPayUrl($tradeNo, $request->all());
            return response()->json(["data" => ["redirect_url" => $payUrl]]);
        }
    }

    public function check(Request $request)
    {
        $tradeNo = $request->input("trade_no");
        $order = Order::where("trade_no", $tradeNo)->first();
        return response()->json(["data" => $order]);
    }
}
