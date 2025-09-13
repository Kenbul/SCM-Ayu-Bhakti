<template>
    <AppLayout title="Barang Keluar">
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold">Daftar Barang Keluar</h2>
            <Link href="/outgoing-goods/create" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Barang Keluar
            </Link>
        </div>

        <table class="min-w-full bg-white shadow rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 text-left">Tanggal</th>
                    <th class="p-2 text-left">Barang</th>
                    <th class="p-2 text-center">Jumlah</th>
                    <th class="p-2 text-left">Tujuan</th>
                    <th class="p-2 text-left">Input Oleh</th>
                    <th class="p-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="good in goods.data" :key="good.id" class="border-b">
                    <td class="p-2">{{ good.date_out }}</td>
                    <td class="p-2">{{ good.item?.name }}</td>
                    <td class="p-2 text-center">{{ good.quantity }}</td>
                    <td class="p-2">{{ good.destination || '-' }}</td>
                    <td class="p-2">{{ good.user?.name || '-' }}</td>
                    <td class="p-2 text-center space-x-2">
                        <Link :href="`/outgoing-goods/${good.id}/edit`" class="text-blue-600">Edit</Link>
                        <button @click="confirmDelete(good.id)" class="text-red-600">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4 flex justify-center space-x-2">
            <button v-for="link in goods.links" :key="link.label" v-html="link.label" @click="goTo(link.url)"
                :disabled="!link.url" class="px-3 py-1 border rounded"
                :class="{ 'bg-blue-600 text-white': link.active, 'text-gray-600': !link.active }" />
        </div>
    </AppLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import Swal from 'sweetalert2'
import { Toast } from '@/Plugins/toast'

const props = defineProps({
    goods: Object
})

const goTo = (url) => {
    if (url) router.visit(url, { preserveState: true })
}

const confirmDelete = (id) => {
    Swal.fire({
        title: 'Hapus Data?',
        text: 'Data barang keluar akan mengembalikan stok!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/outgoing-goods/${id}`, {
                onSuccess: () => {
                    Toast.fire({ icon: 'success', title: 'Barang keluar berhasil dihapus' })
                }
            })
        }
    })
}
</script>