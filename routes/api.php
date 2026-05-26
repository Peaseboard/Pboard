<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UniProxyController;
use App\Http\Controllers\Api\Legacy\GuestController;
use App\Http\Controllers\Api\Legacy\PassportController;
use App\Ttp\Controllers\Api\Legacy\UserController;

// ==============================================
// Gate Gateway Standard API (UniProxy)
// ==============================================
Route::get("/api/v1/server/UniProxy/config", [UniProxyController::class, "config"]);
Route::get("/api/v1/server/UniProxy/user", [UniProxyController::class, "user"]);

// ===============================================
// Legacy API Compatibility (Xboard/V2board)
// ===============================================
Route::prefix("api/v1")->group(function () {
    // Guest Public Info
    Route::get("/guest/comm/config", [GuestController::class, "config"]);
    
    // Auth
    Route::post("/passport/auth/login", [PassportController::class, "login"]);
    Route::post("/passport/auth/register", [PassportController::class, "register"]);

    // User & Subscribe
    Route::get("/user/getSubscribe", [UserController::class, "getSubscribe"]);
});
