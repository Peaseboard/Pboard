# Pboard 安装与部署指南

## 1. 环境要求
- PHP >= 8.2
- Composer
- MySQL 8.0+ 或 PostgreSQL 12+
- Redis
- Node.js (仅用于前端构建)

## 2. 快速安装

### 2.1 克隆项目
```bash
git clone https://github.com/Peaseboard/Pboard.git
cd Pboard
```

### 2.2 安装依赖
```bash
composer install
```

### 2.3 配置环境
复制  为  并填写数据库信息：
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=pboard
DB_USERNAME=root
DB_PASSWORD=your_password

REDIS_HOST=127.0.0.1
```

### 2.4 初始化数据库
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### 2.5 启动服务
**开发模式:**
```bash
php artisan serve
```

**生产模式 (推荐):**
使用 Nginx + PHP-FPM 部署  目录。

## 3. 迁移旧版 Xboard/V2board 数据
如果你是从旧版面板迁移，请执行以下命令：
```bash
php artisan pboard:migrate --db-host=127.0.0.1 --db-name=old_xboard_db --db-user=root --db-pass=123456
```
*系统会自动同步用户、节点、计划，且**不需要用户重置密码**。*

## 4. 对接 Gate 网关
1. 在 Pboard 后台创建节点，获取 。
2. 在 Gate 配置文件 () 中填入:
   ```ini
   webapi_url=http://your-pboard-domain
   webapi_key=your_webapi_token
   ```
3. 运行 [0;34m[Gate][0m 拉取最新面板配置...
[0;34m[Gate][0m 重启节点 41...
[0;32m[Gate][0m 节点已重启 即可。
