<template>
  <div class="min-h-screen bg-slate-100 p-6 md:p-10">
    <div class="max-w-6xl mx-auto space-y-6">
      <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
          <h1 class="text-3xl font-bold text-slate-900">Data Barang</h1>
          <p class="text-slate-600 mt-2">Kelola daftar barang yang tersedia di inventaris Anda dengan tampilan lebih modern.</p>
        </div>
        <router-link to="/dashboard" class="inline-flex items-center text-slate-600 transition hover:text-slate-900">
          ← Kembali ke Dashboard
        </router-link>
      </div>

      <div class="rounded-3xl bg-white p-6 shadow-2xl ring-1 ring-slate-200">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
          <div>
            <h2 class="text-xl font-semibold text-slate-900 mb-2">Tambah Barang</h2>
            <p class="text-slate-600">Isi detail berikut untuk menambah barang baru ke inventaris.</p>
          </div>
          <button
            @click="tambahBarang"
            class="rounded-xl bg-sky-600 px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-sky-700"
          >
            Tambah Barang
          </button>
        </div>

        <div class="mt-6 grid gap-4 lg:grid-cols-2">
          <input
            v-model="namaBarang"
            placeholder="Nama Barang"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm outline-none transition duration-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-200"
          />
          <select
            v-model="kategoriId"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition duration-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-200"
          >
            <option value="">Pilih Kategori</option>
            <option v-for="item in kategori" :key="item.id" :value="item.id">{{ item.nama_kategori }}</option>
          </select>
          <select
            v-model="supplierId"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 shadow-sm outline-none transition duration-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-200"
          >
            <option value="">Pilih Supplier</option>
            <option v-for="item in supplier" :key="item.id" :value="item.id">{{ item.nama_supplier }}</option>
          </select>
          <input
            v-model="stok"
            type="number"
            placeholder="Stok"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm outline-none transition duration-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-200"
          />
          <input
            v-model="harga"
            type="number"
            placeholder="Harga"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm outline-none transition duration-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-200"
          />
        </div>
      </div>

      <div class="rounded-3xl bg-white p-6 shadow-2xl ring-1 ring-slate-200 overflow-hidden">
        <h2 class="text-xl font-semibold text-slate-900 mb-4">Daftar Barang</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
              <tr class="text-left text-sm uppercase tracking-[0.08em] text-slate-500">
                <th class="sticky top-0 px-4 py-4">ID</th>
                <th class="sticky top-0 px-4 py-4">Nama Barang</th>
                <th class="sticky top-0 px-4 py-4">Kategori</th>
                <th class="sticky top-0 px-4 py-4">Supplier</th>
                <th class="sticky top-0 px-4 py-4">Stok</th>
                <th class="sticky top-0 px-4 py-4">Harga</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
              <tr
                v-for="item in barang"
                :key="item.id"
                class="odd:bg-white even:bg-slate-50 hover:bg-slate-100 transition"
              >
                <td class="px-4 py-4 text-slate-700">{{ item.id }}</td>
                <td class="px-4 py-4 text-slate-900">{{ item.nama_barang }}</td>
                <td class="px-4 py-4 text-slate-700">{{ item.kategori ? item.kategori.nama_kategori : item.kategori_id }}</td>
                <td class="px-4 py-4 text-slate-700">{{ item.supplier ? item.supplier.nama_supplier : item.supplier_id }}</td>
                <td class="px-4 py-4 text-slate-700">{{ item.stok }}</td>
                <td class="px-4 py-4 text-slate-700">{{ item.harga }}</td>
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

const barang = ref([])
const kategori = ref([])
const supplier = ref([])
const namaBarang = ref('')
const kategoriId = ref('')
const supplierId = ref('')
const stok = ref('')
const harga = ref('')

const loadBarang = async () => {
  const response = await api.get('/barang')
  barang.value = response.data
}

const loadKategori = async () => {
  const response = await api.get('/categories')
  console.log('Kategori:', response.data)
  kategori.value = response.data
}

const loadSupplier = async () => {
  const response = await api.get('/supplier')
  console.log('Supplier:', response.data)
  supplier.value = response.data
}

const tambahBarang = async () => {
  if (!namaBarang.value.trim() || !kategoriId.value || !supplierId.value || !stok.value || !harga.value) {
    alert('Semua field wajib diisi')
    return
  }

  await api.post('/barang', {
    nama_barang: namaBarang.value,
    kategori_id: kategoriId.value,
    supplier_id: supplierId.value,
    stok: stok.value,
    harga: harga.value,
  })

  namaBarang.value = ''
  kategoriId.value = ''
  supplierId.value = ''
  stok.value = ''
  harga.value = ''
  loadBarang()
}

onMounted(() => {
  loadBarang()
  loadKategori()
  loadSupplier()
})
</script>
