<template>
    <AppLayout title="Tambah Barang Keluar">
        <div class="max-w-lg mx-auto bg-white shadow rounded p-6">
            <h2 class="text-xl font-bold mb-4">Tambah Barang Keluar</h2>

            <form @submit.prevent="submit">
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
                    <input type="date" v-model="form.date_out" class="border rounded p-2 w-full" />
                    <span v-if="form.errors.date_out" class="text-red-500 text-sm">{{ form.errors.date_out }}</span>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Tujuan</label>
                    <input type="text" v-model="form.destination" class="border rounded p-2 w-full" />
                </div>

                <div class="flex justify-end space-x-2">
                    <Link href="/outgoing-goods" class="px-4 py-2 border rounded">Batal</Link>
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
    items: Array
})

const form = useForm({
    item_id: '',
    quantity: '',
    date_out: '',
    destination: ''
})

const submit = () => {
    form.post('/outgoing-goods')
}
</script>