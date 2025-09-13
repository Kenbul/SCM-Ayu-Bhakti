<template>
    <AppLayout title="Tambah Supplier">
      <div class="max-w-lg mx-auto bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Tambah Supplier Baru</h2>
  
        <form @submit.prevent="submit">
          <!-- Nama -->
          <div class="mb-4">
            <label class="block text-gray-700">Nama Supplier</label>
            <input
              v-model="form.name"
              type="text"
              class="w-full border rounded p-2"
              placeholder="Nama Supplier"
            />
            <div v-if="form.errors.name" class="text-red-500 text-sm">
              {{ form.errors.name }}
            </div>
          </div>
  
          <!-- Kontak -->
          <div class="mb-4">
            <label class="block text-gray-700">Kontak</label>
            <input
              v-model="form.contact"
              type="text"
              class="w-full border rounded p-2"
              placeholder="Nomor Telepon"
            />
            <div v-if="form.errors.contact" class="text-red-500 text-sm">
              {{ form.errors.contact }}
            </div>
          </div>
  
          <!-- Alamat -->
          <div class="mb-4">
            <label class="block text-gray-700">Alamat</label>
            <textarea
              v-model="form.address"
              class="w-full border rounded p-2"
              placeholder="Alamat Supplier"
            ></textarea>
            <div v-if="form.errors.address" class="text-red-500 text-sm">
              {{ form.errors.address }}
            </div>
          </div>
  
          <!-- Tombol -->
          <div class="flex justify-end space-x-2">
            <Link href="/suppliers" class="px-4 py-2 bg-gray-500 text-white rounded">
              Batal
            </Link>
            <button
              type="submit"
              class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </AppLayout>
  </template>
  
  <script setup>
  import { Link, useForm } from '@inertiajs/vue3'
  import AppLayout from '@/Layouts/AppLayout.vue'
  import { Toast } from '@/Plugins/toast'
  
  const form = useForm({
    name: '',
    contact: '',
    address: ''
  })
  
  const submit = () => {
  form.post('/suppliers', {
    onSuccess: () => {
      Toast.fire({
        icon: 'success',
        title: 'Supplier berhasil ditambahkan'
      })
    }
  })
}
  </script>
  