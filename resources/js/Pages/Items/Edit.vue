<template>
    <AppLayout title="Edit Barang">
      <div class="max-w-lg mx-auto bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Edit Barang</h2>
  
        <form @submit.prevent="submit">
          <!-- Nama -->
          <div class="mb-4">
            <label class="block text-gray-700">Nama Barang</label>
            <input v-model="form.name" type="text" class="w-full border rounded p-2" />
            <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>
          </div>
  
          <!-- Kategori -->
          <div class="mb-4">
            <label class="block text-gray-700">Kategori</label>
            <input v-model="form.category" type="text" class="w-full border rounded p-2" />
          </div>
  
          <!-- Stok -->
          <div class="mb-4">
            <label class="block text-gray-700">Stok</label>
            <input v-model="form.stock" type="number" class="w-full border rounded p-2" />
          </div>
  
          <!-- Harga -->
          <div class="mb-4">
            <label class="block text-gray-700">Harga</label>
            <input v-model="form.price" type="number" class="w-full border rounded p-2" />
          </div>
  
          <!-- Tanggal Kadaluarsa -->
          <div class="mb-4">
            <label class="block text-gray-700">Kadaluarsa</label>
            <input v-model="form.expired_at" type="date" class="w-full border rounded p-2" />
          </div>
  
          <!-- Tombol -->
          <div class="flex justify-end space-x-2">
            <Link href="/items" class="px-4 py-2 bg-gray-500 text-white rounded">Batal</Link>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
          </div>
        </form>
      </div>
    </AppLayout>
  </template>
  
  <script setup>
  import { Link, useForm } from '@inertiajs/vue3'
  import AppLayout from '@/Layouts/AppLayout.vue'
  import { Toast } from '@/Plugins/toast'
  
  const props = defineProps({
    item: Object
  })
  
  const form = useForm({
    name: props.item.name,
    category: props.item.category,
    stock: props.item.stock,
    price: props.item.price,
    expired_at: props.item.expired_at
  })
  
  const submit = () => {
    form.put(`/items/${props.item.id}`, {
      onSuccess: () => {
        Toast.fire({ icon: 'success', title: 'Barang berhasil diperbarui' })
      }
    })
  }
  </script>
  