<template>
  <div class="min-h-screen bg-slate-100 p-6 md:p-10">
    <div class="max-w-6xl mx-auto space-y-6">
      <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
          <h1 class="text-3xl font-bold text-slate-900">Data Supplier</h1>
          <p class="text-slate-600 mt-2">Kelola data supplier dan kontak dengan tampilan yang lebih bersih.</p>
        </div>
        <router-link to="/dashboard" class="inline-flex items-center text-slate-600 transition hover:text-slate-900">
          ← Kembali ke Dashboard
        </router-link>
      </div>

      <div class="rounded-3xl bg-white p-6 shadow-2xl ring-1 ring-slate-200">
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
          <div>
            <h2 class="text-xl font-semibold text-slate-900 mb-2">Tambah Supplier</h2>
            <p class="text-slate-600">Masukkan detail supplier untuk menyimpan kontak baru.</p>
          </div>
          <button
            @click="tambahSupplier"
            class="rounded-xl bg-sky-600 px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-sky-700"
          >
            Tambah Supplier
          </button>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-3">
          <input
            v-model="namaSupplier"
            placeholder="Nama Supplier"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm outline-none transition duration-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-200"
          />
          <input
            v-model="alamat"
            placeholder="Alamat"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm outline-none transition duration-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-200"
          />
          <input
            v-model="telepon"
            placeholder="Telepon"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm outline-none transition duration-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-200"
          />
        </div>
      </div>

      <div class="rounded-3xl bg-white p-6 shadow-2xl ring-1 ring-slate-200 overflow-hidden">
        <h2 class="text-xl font-semibold text-slate-900 mb-4">Daftar Supplier</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
              <tr class="text-left text-sm uppercase tracking-[0.08em] text-slate-500">
                <th class="sticky top-0 px-4 py-4">ID</th>
                <th class="sticky top-0 px-4 py-4">Nama Supplier</th>
                <th class="sticky top-0 px-4 py-4">Alamat</th>
                <th class="sticky top-0 px-4 py-4">Telepon</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
              <tr
                v-for="item in supplier"
                :key="item.id"
                class="odd:bg-white even:bg-slate-50 hover:bg-slate-100 transition"
              >
                <td class="px-4 py-4 text-slate-700">{{ item.id }}</td>
                <td class="px-4 py-4 text-slate-900">{{ item.nama_supplier }}</td>
                <td class="px-4 py-4 text-slate-700">{{ item.alamat }}</td>
                <td class="px-4 py-4 text-slate-700">{{ item.telepon }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import api from '@/services/api'
import { ref, onMounted } from 'vue'

const supplier = ref([])
const namaSupplier = ref('')
const alamat = ref('')
const telepon = ref('')

const loadSupplier = async () => {
  const response = await api.get('/supplier')
  supplier.value = response.data
}

const tambahSupplier = async () => {
  if (!namaSupplier.value.trim() || !alamat.value.trim() || !telepon.value.trim()) {
    alert('Semua field wajib diisi')
    return
  }

  await api.post('/supplier', {
    nama_supplier: namaSupplier.value,
    alamat: alamat.value,
    telepon: telepon.value,
  })

  namaSupplier.value = ''
  alamat.value = ''
  telepon.value = ''
  loadSupplier()
}

onMounted(() => {
  loadSupplier()
})
</script>
