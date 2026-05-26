<template>
  <div class="min-h-screen bg-gray-50">
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
        <h1 class="text-3xl font-bold text-gray-900">Pboard</h1>
        <nav>
          <a href="/" class="text-gray-600 hover:text-gray-900 px-3 py-2">首页</a>
          <a href="/dashboard" class="text-gray-600 hover:text-gray-900 px-3 py-2">控制台</a>
        </nav>
      </div>
    </header>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <slot />
    </main>
  </div>
</template>
