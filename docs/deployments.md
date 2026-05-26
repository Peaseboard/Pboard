# Pboard 部署指南

Pboard 支持多种主流部署方式，请根据您的服务器环境选择。

## 1. Docker 部署 (推荐)
适用于：所有环境，包括 1Panel、原生 Docker 环境。
```bash
docker-compose up -d
```

## 2. 宝塔面板 / aaPanel
适用于：习惯使用可视化面板管理站点的用户。
1. **环境要求**: Nginx 1.24+, PHP 8.2, MySQL 8.0+, Redis 7.0.
2. **PHP 扩展**: 必须安装 `fileinfo`, `redis`, `exif`, `bcmath`。
3. **站点设置**:
   - 运行目录：`/public`
   - 伪静态：选择 `Laravel`
   - **重要**: 在“配置文件”中注释或删除 `open_basedir` 相关行。
4. **安装命令**:
   ```bash
   cd /www/wwwroot/your-domain
   composer install --no-dev
   php artisan pboard:install
   ```

## 3. 独立部署 (手动)
适用于：高级用户，需要极致性能优化。
1. 安装 PHP 8.2, Nginx, MySQL, Redis。
2. 配置 Nginx 指向 `/public` 目录。
3. 配置 Supervisor 运行 `queue:work`。
4. 执行 `composer install` 和 `php artisan migrate`。

## 4. 一键脚本 (Beta)
我们提供了 `install.sh` 脚本，尝试自动配置环境。
```bash
bash install.sh
```
