
<template>
  <div class="min-h-screen bg-white">
    <header class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <span class="text-2xl font-bold text-primary-600">Pboard</span>
        <nav class="hidden md:flex space-x-8">
          <a href="#features" class="text-gray-600 hover:text-primary-600">特性</a>
          <a href="#pricing" class="text-gray-600 hover:text-primary-600">价格</a>
        </nav>
        <div class="flex items-center space-x-4">
          <NuxtLink to="/login" class="text-gray-600 hover:text-primary-600">登录</NuxtLink>
          <NuxtLink to="/register" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">注册</NuxtLink>
        </div>
      </div>
    </header>

    <section class="pt-32 pb-20 bg-gradient-to-b from-primary-50 to-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
          新一代 <span class="text-primary-600">高速</span> 代理网络
        </h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-10">
          基于 Pboard 核心构建的全球加速服务。支持多协议、低延迟、无限流量。
          专为极速体验而设计。
        </p>
        <div class="flex justify-center space-x-4">
          <NuxtLink to="/register" class="bg-primary-600 text-white px-8 py-3 rounded-xl text-lg font-medium hover:bg-primary-700 shadow-lg shadow-primary-500/30 transition">
            立即开始
          </NuxtLink>
          <a href="#pricing" class="bg-white text-gray-700 px-8 py-3 rounded-xl text-lg font-medium border border-gray-200 hover:bg-gray-50 transition">
            查看价格
          </a>
        </div>
      </div>
    </section>

    <section id="features" class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
          <h2 class="text-3xl font-bold text-gray-900">核心优势</h2>
          <p class="mt-4 text-gray-500">为什么选择 Pboard？</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">极速内核</h3>
            <p class="text-gray-500">基于 Sing-box 深度优化，延迟降低 40%，支持最新协议。</p>
          </div>
          <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">隐私安全</h3>
            <p class="text-gray-500">严格的无日志政策，AES-256 加密传输，保护您的数据。</p>
          </div>
          <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">全球节点</h3>
            <p class="text-gray-500">覆盖 30+ 国家和地区，智能路由选择最佳路径。</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
