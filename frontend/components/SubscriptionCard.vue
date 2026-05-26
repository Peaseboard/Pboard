<template>
  <div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg font-medium text-gray-900">5LiA5Lia6L+Z6L2v</h3>
    </div>
    <div class="px-4 py-5 sm:p-6">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <p class="text-sm font-medium text-gray-500">5LW/5Zyw55So5ouF</p>
          <p class="mt-1 text-lg text-gray-900">{{ store.user.plan_name || '5peN6Zeo' }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">5L2/5LqM546L</p>
          <p class="mt-1 text-lg text-gray-900">{{ store.user.expired_at || '5o+b5Lit77yM' }}</p>
        </div>
      </div>
      <div class="mt-4">
        <p class="text-sm font-medium text-gray-500">56uL5Yqp5byg6YOI</p>
        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
          <div class="bg-blue-600 h-2.5 rounded-full" :style="{ width: usedPercent + '%' }"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const store = useUserStore();
const usedPercent = computed(() => {
  if (!store.user.transfer_enable) return 0;
  return Math.min(100, ((store.user.u + store.user.d) / store.user.transfer_enable) * 100);
});
</script>
