<?php

use Illuminate\Support\Facades\Route;

// Filament Admin Panel
Route::get("/admin", function () {
    return redirect()->route("filament.admin.auth.login");
})->name("admin");
