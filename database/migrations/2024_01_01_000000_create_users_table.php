<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(users, function (Blueprint $table) {
            $table->id();
            $table->uuid(uuid)->unique(); // 兼容 Xboard uuid
            $table->string(email)->unique();
            $table->string(password);
            $table->integer(plan_id)->nullable();
            $table->timestamp(expired_at)->nullable();
            $table->bigInteger(transfer_enable)->default(0); // 流量上限 (Bytes)
            $table->bigInteger(u)->default(0); // 上传流量
            $table->bigInteger(d)->default(0); // 下载流量
            $table->integer(banned)->default(0);
            $table->integer(remind_expire)->default(1);
            $table->string(remarks)->nullable();
            $table->timestamps();
            
            // 索引优化
            $table->index([plan_id, expired_at]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(users);
    }
};
