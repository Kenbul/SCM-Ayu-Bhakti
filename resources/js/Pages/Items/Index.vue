<template>
    <AppLayout title="Barang">
      <!-- Header + Filter -->
      <div class="flex justify-between mb-4 items-center">
        <h2 class="text-2xl font-bold">Daftar Barang</h2>
        <Link href="/items/create" class="bg-blue-600 text-white px-4 py-2 rounded">
          + Tambah Barang
        </Link>
      </div>
  
      <!-- Filter -->
      <div class="flex space-x-2 mb-4">
        <input
          v-model="form.search"
          @input="filter"
          type="text"
          placeholder="Cari barang..."
          class="border rounded p-2 w-1/3"
        />
  
        <select v-model="form.category" @change="filter" class="border rounded p-2">
          <option value="">Semua Kategori</option>
          <option v-for="cat in categories" :key="cat" :value="cat">{{ cat }}</option>
        </select>
      </div>
  
      <!-- Tabel -->
      <table class="min-w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2 text-left">Nama</th>
            <th class="p-2 text-left">Kategori</th>
            <th class="p-2 text-center">Stok</th>
            <th class="p-2 text-center">Harga</th>
            <th class="p-2 text-center">Kadaluarsa</th>
            <th class="p-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items.data" :key="item.id" class="border-b">
            <td class="p-2">{{ item.name }}</td>
            <td class="p-2">{{ item.category }}</td>
            <td class="p-2 text-center">{{ item.stock }}</td>
            <td class="p-2 text-center">Rp {{ new Intl.NumberFormat().format(item.price) }}</td>
            <td class="p-2 text-center">{{ item.expired_at ?? '-' }}</td>
            <td class="p-2 text-center space-x-2">
              <Link :href="`/items/${item.id}/edit`" class="text-blue-600">Edit</Link>
              <button @click="confirmDelete(item.id)" class="text-red-600">Hapus</button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <!-- Pagination -->
      <div class="mt-4 flex justify-center space-x-2">
        <button
          v-for="link in items.links"
          :key="link.label"
          v-html="link.label"
          @click="goTo(link.url)"
          :disabled="!link.url"
          class="px-3 py-1 border rounded"
          :class="{'bg-blue-600 text-white': link.active, 'text-gray-600': !link.active}"
        />
      </div>
    </AppLayout>
  </template>
  
  <script setup>
  import { Link, router } from '@inertiajs/vue3'
  import AppLayout from '@/Layouts/AppLayout.vue'
  import Swal from 'sweetalert2'
  import { Toast } from '@/Plugins/toast'
  import { reactive } from 'vue'
  
  const props = defineProps({
    items: Object,
    filters: Object,
    categories: Array
  })
  
  const form = reactive({
    search: props.filters.search || '',
    category: props.filters.category || ''
  })
  
  const filter = () => {
    router.get('/items', { search: form.search, category: form.category }, { preserveState: true })
  }
  
  const goTo = (url) => {
    if (url) router.visit(url, { preserveState: true })
  }
  
  const confirmDelete = (id) => {
    Swal.fire({
      title: 'Hapus Barang?',
      text: 'Data barang yang dihapus tidak bisa dikembalikan!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#e3342f',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        router.delete(`/items/${id}`, {
          onSuccess: () => {
            Toast.fire({ icon: 'success', title: 'Barang berhasil dihapus' })
          }
        })
      }
    })
  }
  </script>
  
  