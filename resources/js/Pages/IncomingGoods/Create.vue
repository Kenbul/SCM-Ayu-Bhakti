<template>
  <AppLayout title="Tambah Barang Masuk">
    <div class="max-w-lg mx-auto bg-white shadow rounded p-6">
      <h2 class="text-xl font-bold mb-4">Tambah Barang Masuk</h2>

      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block mb-1">Supplier</label>
          <select v-model="form.supplier_id" class="border rounded p-2 w-full">
            <option value="">-- Pilih Supplier --</option>
            <option v-for="s in suppliers" :key="s.id" :value="s.id">{{ s.name }}</option>
          </select>
          <span v-if="form.errors.supplier_id" class="text-red-500 text-sm">{{ form.errors.supplier_id }}</span>
        </div>

        <div class="mb-4">
          <label class="block mb-1">Barang</label>
          <select v-model="form.item_id" class="border rounded p-2 w-full">
            <option value="">-- Pilih Barang --</option>
            <option v-for="i in items" :key="i.id" :value="i.id">{{ i.name }}</option>
          </select>
          <span v-if="form.errors.item_id" class="text-red-500 text-sm">{{ form.errors.item_id }}</span>
        </div>

        <div class="mb-4">
          <label class="block mb-1">Jumlah</label>
          <input type="number" v-model="form.quantity" class="border rounded p-2 w-full" />
          <span v-if="form.errors.quantity" class="text-red-500 text-sm">{{ form.errors.quantity }}</span>
        </div>

        <div class="mb-4">
          <label class="block mb-1">Tanggal</label>
          <input type="date" v-model="form.date_in" class="border rounded p-2 w-full" />
          <span v-if="form.errors.date_in" class="text-red-500 text-sm">{{ form.errors.date_in }}</span>
        </div>

        <div class="flex justify-end space-x-2">
          <Link href="/incoming-goods" class="px-4 py-2 border rounded">Batal</Link>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
  suppliers: Array,
  items: Array
})

const form = useForm({
  supplier_id: '',
  item_id: '',
  quantity: '',
  date_in: ''
})

const submit = () => {
  form.post('/incoming-goods', {
    onSuccess: () => {
      Toast.fire({
        icon: 'success',
        title: 'Barang masuk berhasil ditambahkan'
      })
    }
  })

}
</script>