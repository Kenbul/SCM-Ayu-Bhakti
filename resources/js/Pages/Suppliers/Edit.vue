<template>
  <AppLayout title="Edit Supplier">
    <div class="max-w-lg mx-auto bg-white shadow rounded p-6">
      <h2 class="text-xl font-bold mb-4">Edit Supplier</h2>

      <form @submit.prevent="submit">
        <!-- Nama -->
        <div class="mb-4">
          <label class="block text-gray-700">Nama Supplier</label>
          <input
            v-model="form.name"
            type="text"
            class="w-full border rounded p-2"
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
            Update
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

// Ambil props supplier dari controller
const props = defineProps({
  supplier: Object
})

const form = useForm({
  name: props.supplier.name,
  contact: props.supplier.contact,
  address: props.supplier.address
})

const submit = () => {
    form.put(`/suppliers/${props.supplier.id}`, {
  onSuccess: () => {
    Toast.fire({
      icon: 'success',
      title: 'Supplier berhasil diperbarui'
    })
  }
})
}
</script>
