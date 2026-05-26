
<template>
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-6">全部节点</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="node in nodes" :key="node.id" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
        <div class="flex justify-between items-start mb-4">
          <div>
            <h3 class="text-lg font-bold text-gray-900">{{ node.name }}</h3>
            <p class="text-sm text-gray-500">{{ node.host }}:{{ node.port }}</p>
          </div>
          <span :class="node.is_online ? bg-green-100 text-green-700 : bg-gray-100 text-gray-700" class="px-2 py-1 rounded text-xs font-medium">
            {{ node.is_online ? 在线 : 离线 }}
          </span>
        </div>
        
        <div class="flex items-center justify-between mt-6">
          <span class="text-xs text-gray-400 bg-gray-50 px-2 py-1 rounded">{{ node.protocol }}</span>
          <button class="text-primary-600 text-sm font-medium hover:text-primary-700">
            复制订阅
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
definePageMeta({ layout: "dashboard" });

const nodes = ref([
  { id: 1, name: "香港 01 - 高速专线", host: "hk1.51.com", port: 37819, protocol: "vmess", is_online: true },
  { id: 2, name: "日本 01 - 东京优化", host: "jp1.51.com", port: 443, protocol: "trojan", is_online: true },
  { id: 3, name: "美国 01 - 洛杉矶", host: "us1.51.com", port: 443, protocol: "vless", is_online: false },
]);
</script>
