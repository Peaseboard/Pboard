#!/bin/bash
# Pboard 宝塔面板/aaPanel 一键部署脚本

echo "正在安装 Pboard 依赖..."
# Install required PHP extensions via Baota CLI if available, or suggest manual steps
echo "请确保已在宝塔面板安装: PHP 8.2, MySQL 8.0, Redis, Nginx"
echo "请在 PHP 设置中安装扩展: fileinfo, exif, redis, mbstring, bcmath, zip"
echo "请禁用函数: putenv, proc_open, pcntl_alarm, pcntl_signal (如果存在)"

# Setup steps
echo "1. 创建站点，设置运行目录为 /public"
echo "2. 关闭 open_basedir"
echo "3. 设置伪静态为 Laravel"
echo "
location / {
    try_files \$uri \$uri/ /index.php?\$query_string;
}
"
echo "4. 执行安装命令:"
echo "cd /www/wwwroot/your-domain"
echo "composer install --no-dev"
echo "cp .env.example .env"
echo "php artisan key:generate"
echo "php artisan migrate"
