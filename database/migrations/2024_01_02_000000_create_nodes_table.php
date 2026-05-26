<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(nodes, function (Blueprint $table) {
            $table->id();
            $table->string(name)->unique(); // 节点名称 (对应 Xboard show_name)
            $table->string(group)->nullable(); // 节点组 (对应 Xboard group)
            $table->string(host); // 域名/IP
            $table->integer(port); // 端口
            $table->integer(server_port)->nullable(); // 后端通信端口
            $table->string(protocol); // vmess, trojan, etc.
            $table->json(config)->nullable(); // 统一存储 JSON 配置 (TLS, Network, Rules)
            $table->boolean(enabled)->default(true);
            $table->integer(node_order)->default(0);
            $table->boolean(is_online)->default(false); // 实时在线状态
            $table->string(webapi_token)->nullable(); // 节点通信密钥
            $table->timestamps();
            
            // 针对虚拟主机的 JSON 搜索索引 (PG 会自动优化)
            $table->index(protocol);
            $table->index(group);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(nodes);
    }
};
