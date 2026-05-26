# Pboard 架构设计文档

## 核心理念
**Modern, Fast, Clean.**
Pboard 旨在解决 Xboard/V2Board 存在的性能瓶颈、代码耦合、UI 体验差等问题，提供一个现代化的代理网关管理面板。

## 技术栈
- **Backend**: Laravel 11 (PHP 8.3+)
- **Database**: **MySQL 8.0+ / PostgreSQL 12+**
- **Admin UI**: FilamentPHP 3.x
- **Queue**: Redis

## 关键设计

### 1. 一键迁移 (One-Click Migrator)
针对现有 Xboard/V2board 用户提供零成本迁移方案：
- **命令**: `php artisan pboard:migrate`
- **用户数据**: 直接同步，兼容旧版 Bcrypt 密码，用户无需重置。
- **节点转换**: 自动扫描 `v2_server_*` 旧表，转换为 Pboard 的 JSON 统一配置。
- **UUID 保持**: 确保用户订阅链接不变。

### 2. 前端兼容
- **API Simulation**: 兼容旧版 App/客户端请求格式。
- **View Fallback**: 支持直接复用 Xboard/V2board 主题。
