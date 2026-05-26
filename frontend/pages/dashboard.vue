
<template>
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">欢迎回来</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 mb-1">剩余流量</p>
        <div class="flex items-end justify-between">
          <h3 class="text-3xl font-bold text-gray-900">100 <span class="text-lg font-medium text-gray-500">GB</span></h3>
          <span class="text-green-500 text-sm font-medium">正常</span>
        </div>
        <div class="mt-4 w-full bg-gray-100 rounded-full h-2">
          <div class="bg-primary-500 h-2 rounded-full" style="width: 35%"></div>
        </div>
        <p class="text-xs text-gray-400 mt-2">已使用 35 GB</p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 mb-1">到期时间</p>
        <div class="flex items-end justify-between">
          <h3 class="text-3xl font-bold text-gray-900">2026 <span class="text-lg font-medium text-gray-500">年</span></h3>
        </div>
        <p class="text-xs text-gray-400 mt-2">距离到期还有 365 天</p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <p class="text-sm text-gray-500 mb-1">账户余额</p>
        <div class="flex items-end justify-between">
          <h3 class="text-3xl font-bold text-gray-900">0.00 <span class="text-lg font-medium text-gray-500">元</span></h3>
        </div>
        <NuxtLink to="/dashboard/orders" class="text-xs text-primary-600 mt-2 block hover:underline">充值记录 ></NuxtLink>
      </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
      <h2 class="text-lg font-bold text-gray-900 mb-4">快速操作</h2>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <button class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-primary-50 hover:text-primary-600 transition cursor-pointer">
          <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
          <span class="text-sm font-medium">复制订阅</span>
        </button>
        <button class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-primary-50 hover:text-primary-600 transition cursor-pointer">
          <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          <span class="text-sm font-medium">在线充值</span>
        </button>
        <button class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-primary-50 hover:text-primary-600 transition cursor-pointer">
          <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
          <span class="text-sm font-medium">重置流量</span>
        </button>
        <button class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-primary-50 hover:text-primary-600 transition cursor-pointer">
          <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
          <span class="text-sm font-medium">帮助中心</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
definePageMeta({ layout: "dashboard" });
</script>
