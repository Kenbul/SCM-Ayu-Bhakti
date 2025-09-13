<template>
    <AppLayout title="Supplier">
      <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">Daftar Supplier</h2>
        <Link href="/suppliers/create" class="bg-blue-600 text-white px-4 py-2 rounded">
          + Tambah Supplier
        </Link>
      </div>
  
      <table class="min-w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2 text-left">Nama</th>
            <th class="p-2 text-left">Kontak</th>
            <th class="p-2 text-left">Alamat</th>
            <th class="p-2 text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="supplier in suppliers" :key="supplier.id" class="border-b">
            <td class="p-2">{{ supplier.name }}</td>
            <td class="p-2">{{ supplier.contact }}</td>
            <td class="p-2">{{ supplier.address }}</td>
            <td class="p-2 text-center space-x-2">
              <Link :href="`/suppliers/${supplier.id}/edit`" class="text-blue-600">Edit</Link>
              <button @click="confirmDelete(supplier.id)" class="text-red-600">
              Hapus
            </button>
            </td>
          </tr>
        </tbody>
      </table>
    </AppLayout>
  </template>
  
  <script setup>
import { Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import Swal from 'sweetalert2'
import { Toast } from '@/Plugins/toast'

defineProps({
  suppliers: Array
})

const confirmDelete = (id) => {
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: 'Data supplier yang dihapus tidak bisa dikembalikan!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#e3342f',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`/suppliers/${id}`, {
        onSuccess: () => {
          Swal.fire('Terhapus!', 'Supplier berhasil dihapus.', 'success')
        }
      })
    }
  })
}
</script>
