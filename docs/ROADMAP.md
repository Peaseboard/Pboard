# Pboard 开发路线图

## Phase 1: 核心基础 (当前阶段)
- [ ] 搭建 Laravel 11 + Filament 骨架
- [ ] 设计数据库 Schema (Users, Plans, Nodes, Orders, Tickets)
- [ ] 实现用户认证 (Auth) 和 权限管理 (RBAC)
- [ ] 实现 Filament Admin 后台基础 CRUD

## Phase 2: 节点与网关 (Gate Integration)
- [ ] 实现 UniProxy API 控制器 (GetConfig, GetUserList, PushStats)
- [ ] 节点状态监控与心跳检测
- [ ] 动态配置下发逻辑

## Phase 3: 业务与财务
- [ ] 订单系统与支付接口对接
- [ ] 用户订阅管理 (Plans)
- [ ] 佣金与返利系统
- [ ] 邮件通知系统 (异步队列)
