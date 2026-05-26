<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UniProxyController;

// Gate Gateway Standard API
Route::get("/api/v1/server/UniProxy/config", [UniProxyController::class, "config"]);
Route::get("/api/v1/server/UniProxy/user", [UniProxyController::class, "user"]);
// Future: Route::post("/api/v1/server/UniProxy/push", [UniProxyController::class, "push"]);
