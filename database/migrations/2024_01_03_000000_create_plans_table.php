<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(plans, function (Blueprint $table) {
            $table->id();
            $table->string(name);
            $table->decimal(price, 10, 2);
            $table->integer(capacity)->default(0); // 容量限制 (0 为无限)
            $table->bigInteger(transfer_enable)->default(0); // 流量 (Bytes)
            $table->integer(speed_limit)->default(0); // 限速 (Mbps, 0 不限)
            $table->integer(renew)->default(1); // 是否允许续费
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(plans);
    }
};
