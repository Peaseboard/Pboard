<?php

namespace App\Services;

use App\Models\PaymentMethod;

class PaymentGateway
{
    public static function getInstance(string $driver)
    {
        // Factory pattern to return specific payment driver (Alipay, Stripe, etc.)
        $class = "App\\Services\\Payments\\\\u5C0F".ucfirst($driver);
        if (class_exists($class)) {
            return new $class();
        }
        throw new \Exception("Payment driver {$driver} not found");
    }

    public static function getEnabledMethods()
    {
        return PaymentMethod::where("enable", true)->orderBy("sort")->get();
    }
}
