<template>
    <div class="flex">
      <!-- Sidebar -->
      <Sidebar />
  
      <!-- Main Content -->
      <div class="flex-1 bg-gray-100 min-h-screen">
        <!-- Topbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
          <h1 class="text-lg font-bold">{{ title }}</h1>
        </header>
  
        <!-- Page Content -->
        <main class="p-6">
          <slot />
        </main>
      </div>
    </div>
  </template>
  
  <script setup>
  import Sidebar from '@/Components/Sidebar.vue'
  
  defineProps({
    title: String
  })
  </script>
  