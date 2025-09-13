<template>
  <div class="flex flex-col w-64 bg-gray-900 text-white min-h-screen">
    <!-- Logo -->
    <div class="p-4 text-xl font-bold border-b border-gray-700">
      SCM System
    </div>

    <!-- Menu -->
    <nav class="flex-1 p-4 space-y-2">
      <!-- Semua role -->
      <Link href="/dashboard" class="block p-2 rounded hover:bg-gray-700">
      Dashboard
      </Link>

      <!-- Master Data (khusus admin) -->
      <div v-if="user?.role === 'admin'" class="mt-4">
        <p class="text-xs uppercase text-gray-400">Master Data</p>
        <Link href="/suppliers" class="block p-2 rounded hover:bg-gray-700">
        Supplier
        </Link>
        <Link href="/items" class="block p-2 rounded hover:bg-gray-700">
        Barang
        </Link>
      </div>

      <!-- Transaksi (admin + karyawan) -->
      <div class="mt-4">
        <p class="text-xs uppercase text-gray-400">Transaksi</p>
        <Link href="/incoming-goods" class="block p-2 rounded hover:bg-gray-700">
        Barang Masuk
        </Link>
        <Link href="/outgoing-goods" class="block p-2 rounded hover:bg-gray-700">
        Barang Keluar
        </Link>
      </div>

      <!-- Laporan (khusus admin) -->
      <div v-if="user?.role === 'admin'" class="mt-4">
        <p class="text-xs uppercase text-gray-400">Laporan</p>
        <Link href="/reports" class="block p-2 rounded hover:bg-gray-700">
        Laporan
        </Link>
      </div>
    </nav>

    <!-- Footer / User Info -->
    <div class="p-4 border-t border-gray-700">
      <p class="text-sm">👤 {{ user?.name }}</p>
      <p class="text-xs text-gray-400">{{ user?.role }}</p>
      <button @click="logout" class="mt-2 w-full text-center py-2 bg-red-600 rounded hover:bg-red-700">
        Logout
      </button>
    </div>
  </div>
</template>

<script setup>
import { Link, router, usePage } from '@inertiajs/vue3'

const page = usePage()
const user = page.props.auth.user

const logout = () => {
  router.post('/logout')
}
</script>
