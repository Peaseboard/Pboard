# Pboard 架构设计文档

## 核心理念
**Modern, Fast, Clean.**
Pboard 旨在解决 Xboard/V2Board 存在的性能瓶颈、代码耦合、UI 体验差等问题，提供一个现代化的代理网关管理面板。

## 技术栈

### 后端核心
- **Framework**: Laravel 11 (PHP 8.3+)
- **Database**: **MySQL 8.0+ / PostgreSQL 12+** (通过 Eloquent ORM 自动适配)
- **Cache/Queue**: Redis (强制依赖，用于高性能统计和异步任务)
- **Admin Panel**: FilamentPHP 3.x (现代化、响应式、零 JS 报错)

### 数据库策略 (Dual-DB Support)
为了兼顾虚拟主机用户和追求极致性能的 VPS 用户，Pboard 采用 **"Write Once, Run Everywhere"** 的策略：

1.  **基础兼容模式 (MySQL 8.0+)**
    *   支持所有主流虚拟主机。
    *   利用 MySQL 8.0 的 JSON 特性处理节点配置。
    *   保证核心功能 100% 可用。

2.  **高性能模式 (PostgreSQL 12+)**
    *   针对 VPS/Dedicated Server 优化。
    *   利用 PG 的 JSONB 和 GIN Index 加速节点配置查询。
    *   利用 PG 的并发处理能力优化流量统计写入。
    *   系统会自动检测驱动并开启对应的高级优化。

## 节点通信 (Gate Integration)
原生集成 Gate 网关：
- 标准 UniProxy API 接口。
- 支持动态配置下发 (端口/协议/用户)。
- 节点状态实时心跳检测。
