<template>
  <AppLayout title="Dashboard">
    <!-- Grid Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
      <!-- Card Supplier -->
      <Link :href="route('suppliers.index')" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
      <h3 class="text-lg font-semibold text-gray-700">Total Supplier</h3>
      <p class="mt-2 text-3xl font-bold text-blue-600">{{ stats.suppliers }}</p>
      </Link>

      <!-- Card Barang -->
      <Link :href="route('items.index')" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
      <h3 class="text-lg font-semibold text-gray-700">Total Barang</h3>
      <p class="mt-2 text-3xl font-bold text-green-600">{{ stats.items }}</p>
      </Link>

      <!-- Card Barang Masuk -->
      <Link :href="route('incoming-goods.index')" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
      <h3 class="text-lg font-semibold text-gray-700">Barang Masuk Bulan Ini</h3>
      <p class="mt-2 text-3xl font-bold text-yellow-600">{{ stats.incoming }}</p>
      </Link>

      <!-- Card Barang Keluar -->
      <Link :href="route('outgoing-goods.index')" class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
      <h3 class="text-lg font-semibold text-gray-700">Barang Keluar Bulan Ini</h3>
      <p class="mt-2 text-3xl font-bold text-red-600">{{ stats.outgoing }}</p>
      </Link>
    </div>

    <!-- Section lain tetap -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Barang Stok Menipis -->
      <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">📉 Barang dengan Stok Menipis</h3>
        <table class="w-full text-sm">
          <thead class="bg-gray-100 text-gray-600">
            <tr>
              <th class="p-2 text-left">Nama</th>
              <th class="p-2 text-center">Stok</th>
              <th class="p-2 text-center">Min. Stok</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in lowStockItems" :key="item.id" class="border-b">
              <td class="p-2">{{ item.name }}</td>
              <td class="p-2 text-center text-red-600 font-bold">{{ item.stock }}</td>
              <td class="p-2 text-center">{{ item.min_stock }}</td>
            </tr>
            <tr v-if="lowStockItems.length === 0">
              <td colspan="3" class="p-2 text-center text-gray-500">Tidak ada barang dengan stok menipis</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Barang Hampir Kadaluarsa -->
      <div class="bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">⏳ Barang Hampir Kedaluwarsa</h3>
        <table class="w-full text-sm">
          <thead class="bg-gray-100 text-gray-600">
            <tr>
              <th class="p-2 text-left">Nama</th>
              <th class="p-2 text-center">Kadaluarsa</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in expiringItems" :key="item.id" class="border-b">
              <td class="p-2">{{ item.name }}</td>
              <td class="p-2 text-center text-orange-600">
                {{ new Date(item.expired_at).toLocaleDateString() }}
              </td>
            </tr>
            <tr v-if="expiringItems.length === 0">
              <td colspan="2" class="p-2 text-center text-gray-500">Tidak ada barang mendekati kadaluarsa</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'


// ambil props yang dikirim Inertia
const { stats, lowStockItems = [], expiringItems = [] } = defineProps({
  stats: Object,
  lowStockItems: { type: Array, default: () => [] },
  expiringItems: { type: Array, default: () => [] },
})

// format tanggal kecil
const formatDate = (d) => {
  if (!d) return '-'
  try {
    return new Date(d).toLocaleDateString()
  } catch {
    return d
  }
}

// Alert stok menipis
if (lowStockItems.length > 0) {
  Swal.fire({
    title: '⚠️ Stok Menipis!',
    html: `Ada <b>${lowStockItems.length}</b> barang dengan stok di bawah minimum.<br>
           Contoh: ${lowStockItems.slice(0, 3).map(i => i.name).join(', ')}...`,
    icon: 'warning',
    confirmButtonText: 'Cek Barang'
  }).then((result) => {
    if (result.isConfirmed) {
      router.visit(route('items.index'))
    }
  })
}

// Alert barang hampir kadaluarsa
if (expiringItems.length > 0) {
  Swal.fire({
    title: '⏳ Barang Hampir Kedaluwarsa!',
    html: `Ada <b>${expiringItems.length}</b> barang yang akan kedaluwarsa dalam 7 hari.<br>
           Contoh: ${expiringItems.slice(0, 3).map(i => i.name).join(', ')}...`,
    icon: 'error',
    confirmButtonText: 'Cek Barang'
  }).then((result) => {
    if (result.isConfirmed) {
      router.visit(route('items.index'))
    }
  })
}
</script>
